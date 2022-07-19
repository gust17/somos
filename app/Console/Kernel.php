<?php

namespace App\Console;

use App\Models\Assinatura;
use App\Models\Caixa;
use App\Models\Credito;
use App\Models\Extrato;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $faturas = Assinatura::where('buscador', "!=", 'NULL')->get();



            foreach ($faturas as $fatura) {
                $asaas = new \CodePhix\Asaas\Asaas('41891bad9d2d17a3ba2af9f77ec179751010bd79e9439e919194925827aba3d1', 'homologacao');
                $cobranca = $asaas->Cobranca()->getById($fatura->buscador);


                if (($cobranca->status == 'CONFIRMED' || $cobranca->status == 'RECEIVED') && $fatura->status == 0) {

                    if ($fatura->status == 0) {
                        $fatura->fill(['tipo' => $cobranca->billingType, 'status' => 1]);
                        $fatura->save();
                        if ($fatura->unico == 1) {
                            $grava = [
                                'descricao' => 'Recebido do Pagamento Unico ' . $fatura->user->name,
                                'valor' => $fatura->valor,
                                'tipo' => 1,
                                'user_id' => $fatura->user->id,
                            ];
                        } else {
                            $grava = [
                                'descricao' => 'Recebido da mensalidade do ' . $fatura->user->name,
                                'valor' => $fatura->plano->valor,
                                'tipo' => 1,
                                'user_id' => $fatura->user->id,
                            ];
                        }
                        Caixa::create($grava);
                    }

                    if (!empty($fatura->user->quem)) {
                        $plano = Plano::find($fatura->plano->id);

                        $user = User::where('link', $fatura->user->quem)->first();

                        $planolast = $user->assinaturas->where('status', 1)->last();

                        if (!empty($planolast)) {

                            if ($fatura->user->assinaturas->where("status", 1)->count() == 1) {
                                $extrato = [
                                    'user_id' => $user->id,
                                    'indicado_id' => $fatura->user->id,
                                    'pontos' => $plano->pontos,
                                    'saldo' => ($plano->valor - ($plano->valor * 0.3))
                                ];


                                Extrato::create($extrato);
                                $pontuacao = $user->pontos + $plano->pontos;
                                $dados = [
                                    'tipo' => 0,
                                    'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Direto ' . $plano->name,
                                    'valor' => ($plano->valor - ($plano->valor * 0.3)),
                                    'user_id' => $user->id
                                ];
                            } else {
                                $extrato = [
                                    'user_id' => $user->id,
                                    'indicado_id' => $fatura->user->id,
                                    'pontos' => $plano->pontos,
                                    'saldo' => ($plano->valor - ($plano->valor * ((100 - $plano->direto) / 100)))
                                ];


                                Extrato::create($extrato);
                                $pontuacao = $user->pontos + $plano->pontos;
                                $dados = [
                                    'tipo' => 0,
                                    'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Direto ' . $plano->name,
                                    'valor' => ($plano->valor - ($plano->valor * ((100 - $plano->direto) / 100))),
                                    'user_id' => $user->id
                                ];
                            }

                            \App\Models\Movimento::create($dados);
                            $user->fill(['pontos' => $pontuacao]);
                            $user->save();
                        }


                        $primeiro = User::where('link', $user->quem)->first();

                        if (!empty($primeiro)) {

                            $planolast1 = $primeiro->assinaturas->last();

                            //dd($planolast->plano->direto);



                            if (!empty($planolast1)) {

                                if (count($fatura->user->assinaturas->where("status", 1)) > 1) {
                                    $extrato1 = [
                                        'user_id' => $primeiro->id,
                                        'indicado_id' => $fatura->user->id,
                                        'pontos' => $plano->pontos,
                                        'saldo' => ($plano->valor - ($plano->valor * ((100 - $plano->primeiro) / 100)))
                                    ];
                                    $dados1 = [
                                        'tipo' => 0,
                                        'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Primeiro Nivel ' . $plano->name,
                                        'valor' => ($plano->valor - ($plano->valor * ((100 - $plano->primeiro) / 100))),
                                        'user_id' => $primeiro->id
                                    ];
                                } else {
                                    $extrato1 = [
                                        'user_id' => $primeiro->id,
                                        'indicado_id' => $fatura->user->id,
                                        'pontos' => $plano->pontos,
                                        'saldo' => 0
                                    ];
                                    $dados1 = [
                                        'tipo' => 0,
                                        'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Primeiro Nivel ' . $plano->name,
                                        'valor' => 0,
                                        'user_id' => $primeiro->id
                                    ];
                                }


                                // dd($extrato);
                                \App\Models\Movimento::create($dados1);

                                Extrato::create($extrato1);
                                $pontuacao = $primeiro->pontos + $plano->pontos;

                                //dd($pontuacao);
                                $primeiro->fill(['pontos' => $pontuacao]);
                                $primeiro->save();
                            }


                            $segundo = User::where('link', $primeiro->quem)->first();

                            if (!empty($segundo)) {

                                $planolast2 = $segundo->assinaturas->last();

                                if (!empty($planolast2)) {
                                    if (count($fatura->user->assinaturas->where("status", 1)) > 1) {
                                        $extrato2 = [
                                            'user_id' => $segundo->id,
                                            'indicado_id' => $fatura->user->id,
                                            'pontos' => $plano->pontos,
                                            'saldo' => ($plano->valor - ($plano->valor * ((100 - $plano->segundo) / 100)))
                                        ];

                                        $dados2 = [
                                            'tipo' => 0,
                                            'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Segundo Nivel ' . $plano->name,
                                            'valor' => ($plano->valor - ($plano->valor * ((100 - $plano->segundo) / 100))),
                                            'user_id' => $segundo->id
                                        ];
                                    } else {
                                        $extrato2 = [
                                            'user_id' => $segundo->id,
                                            'indicado_id' => $fatura->user->id,
                                            'pontos' => $plano->pontos,
                                            'saldo' => 0
                                        ];
                                        $dados2 = [
                                            'tipo' => 0,
                                            'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Segundo Nivel ' . $plano->name,
                                            'valor' => 0,
                                            'user_id' => $segundo->id
                                        ];
                                    }


                                    \App\Models\Movimento::create($dados2);

                                    Extrato::create($extrato2);
                                    $pontuacao = $segundo->pontos + $plano->pontos;

                                    $segundo->fill(['pontos' => $pontuacao]);
                                    $segundo->save();
                                }


                                $terceiro = User::where('link', $segundo->quem)->first();

                                if (!empty($terceiro)) {

                                    $planolast3 = $terceiro->assinaturas->last();

                                    if (!empty($planolast3)) {
                                        if (count($fatura->user->assinaturas->where("status", 1)) > 1) {
                                            $extrato3 = [
                                                'user_id' => $terceiro->id,
                                                'indicado_id' => $fatura->user->id,
                                                'pontos' => $plano->pontos,
                                                'saldo' => ($plano->valor - ($plano->valor * ((100 - $plano->terceiro) / 100)))
                                            ];
                                            $dados3 = [
                                                'tipo' => 0,
                                                'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Terceiro Nivel ' . $plano->name,
                                                'valor' => ($plano->valor - ($plano->valor * ((100 - $plano->terceiro) / 100))),
                                                'user_id' => $terceiro->id
                                            ];
                                        } else {
                                            $extrato3 = [
                                                'user_id' => $terceiro->id,
                                                'indicado_id' => $fatura->user->id,
                                                'pontos' => $plano->pontos,
                                                'saldo' => 0
                                            ];
                                            $dados3 = [
                                                'tipo' => 0,
                                                'descricao' => 'bonus ref. login ' . $fatura->user->name . ' Terceiro Nivel ' . $plano->name,
                                                'valor' => 0,
                                                'user_id' => $terceiro->id
                                            ];
                                        }



                                        \App\Models\Movimento::create($dados3);
                                        Extrato::create($extrato3);
                                        $pontuacao = $terceiro->pontos + $plano->pontos;

                                        //dd($pontuacao);
                                        $terceiro->fill(['pontos' => $pontuacao]);
                                        $terceiro->save();
                                    }
                                }
                            }
                        }
                    } else {
                    }
                }
            }
        })->everyMinute();





        $schedule->call(function () {
            $creditos = Credito::where('buscador', "!=", 'NULL')->get();
            $asaas = new \CodePhix\Asaas\Asaas('d48b8d7d12855aea3a7b81f89b861dbb61ed78813c746f785a847151bb746878', 'producao');
            foreach ($creditos as $credito) {

                $cobranca = $asaas->Cobranca()->getById($credito->buscador);


                if (($cobranca->status == 'CONFIRMED' || $cobranca->status == 'RECEIVED') && $credito->status == 0) {
                    //$cobranca->fill(['status' => 1]);

                    $credito->fill(['tipo' => $cobranca->billingType, 'status' => 1]);
                    $credito->save();
                    $abertas = Assinatura::where('user_id', $credito->user->id)->where("status", 0)->get();
                    foreach ($abertas as $aberta) {

                        $aberta->fill(['status' => 1, 'unico' => 1, 'tipo' => $cobranca->billingType]);
                        $aberta->save();

                        $grava = [
                            'descricao' => 'Recebido da mensalidade do ' . $aberta->user->name,
                            'valor' => $aberta->plano->valor,
                            'tipo' => 1,
                            'user_id' => $aberta->user->id,
                        ];
                        Caixa::create($grava);
                        if (!empty($aberta->user->quem)) {
                            $plano = Plano::find($aberta->plano->id);

                            $user = User::where('link', $aberta->user->quem)->first();

                            $planolast = $user->assinaturas->last();

                            if (!empty($planolast)) {

                                if ($aberta->user->assinaturas->where("status", 1)->count() == 1) {
                                    $extrato = [
                                        'user_id' => $user->id,
                                        'indicado_id' => $aberta->user->id,
                                        'pontos' => $plano->pontos,
                                        'saldo' => ($plano->valor - ($plano->valor * 0.3))
                                    ];


                                    Extrato::create($extrato);
                                    $pontuacao = $user->pontos + $plano->pontos;
                                    $dados = [
                                        'tipo' => 0,
                                        'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Direto ' . $plano->name,
                                        'valor' => ($plano->valor - ($plano->valor * 0.3)),
                                        'user_id' => $user->id
                                    ];
                                } else {
                                    $extrato = [
                                        'user_id' => $user->id,
                                        'indicado_id' => $aberta->user->id,
                                        'pontos' => $plano->pontos,
                                        'saldo' => ($plano->valor - ($plano->valor * ((100 - $planolast->plano->direto) / 100)))
                                    ];


                                    Extrato::create($extrato);
                                    $pontuacao = $user->pontos + $plano->pontos;
                                    $dados = [
                                        'tipo' => 0,
                                        'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Direto ' . $plano->name,
                                        'valor' => ($plano->valor - ($plano->valor * ((100 - $planolast->plano->direto) / 100))),
                                        'user_id' => $user->id
                                    ];
                                }

                                \App\Models\Movimento::create($dados);
                                $user->fill(['pontos' => $pontuacao]);
                                $user->save();
                            }


                            $primeiro = User::where('link', $user->quem)->first();

                            if (!empty($primeiro)) {

                                $planolast1 = $primeiro->assinaturas->last();

                                //dd($planolast->plano->direto);



                                if (!empty($planolast1)) {

                                    if (count($aberta->user->assinaturas->where("status", 1)) > 1) {
                                        $extrato1 = [
                                            'user_id' => $primeiro->id,
                                            'indicado_id' => $aberta->user->id,
                                            'pontos' => $plano->pontos,
                                            'saldo' => ($plano->valor - ($plano->valor * ((100 -  $planolast1->plano->primeiro) / 100)))
                                        ];
                                        $dados1 = [
                                            'tipo' => 0,
                                            'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Primeiro Nivel ' . $plano->name,
                                            'valor' => ($plano->valor - ($plano->valor * ((100 -  $planolast1->plano->primeiro) / 100))),
                                            'user_id' => $primeiro->id
                                        ];
                                    } else {
                                        $extrato1 = [
                                            'user_id' => $primeiro->id,
                                            'indicado_id' => $aberta->user->id,
                                            'pontos' => $plano->pontos,
                                            'saldo' => 0
                                        ];
                                        $dados1 = [
                                            'tipo' => 0,
                                            'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Primeiro Nivel ' . $plano->name,
                                            'valor' => 0,
                                            'user_id' => $primeiro->id
                                        ];
                                    }


                                    // dd($extrato);
                                    \App\Models\Movimento::create($dados1);

                                    Extrato::create($extrato1);
                                    $pontuacao = $primeiro->pontos + $plano->pontos;

                                    //dd($pontuacao);
                                    $primeiro->fill(['pontos' => $pontuacao]);
                                    $primeiro->save();
                                }


                                $segundo = User::where('link', $primeiro->quem)->first();

                                if (!empty($segundo)) {

                                    $planolast2 = $segundo->assinaturas->last();

                                    if (!empty($planolast2)) {
                                        if (count($aberta->user->assinaturas->where("status", 1)) > 1) {
                                            $extrato2 = [
                                                'user_id' => $segundo->id,
                                                'indicado_id' => $aberta->user->id,
                                                'pontos' => $plano->pontos,
                                                'saldo' => ($plano->valor - ($plano->valor * ((100 -  $planolast2->plano->segundo) / 100)))
                                            ];

                                            $dados2 = [
                                                'tipo' => 0,
                                                'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Segundo Nivel ' . $plano->name,
                                                'valor' => ($plano->valor - ($plano->valor * ((100 -  $planolast2->plano->segundo) / 100))),
                                                'user_id' => $segundo->id
                                            ];
                                        } else {
                                            $extrato2 = [
                                                'user_id' => $segundo->id,
                                                'indicado_id' => $aberta->user->id,
                                                'pontos' => $plano->pontos,
                                                'saldo' => 0
                                            ];
                                            $dados2 = [
                                                'tipo' => 0,
                                                'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Segundo Nivel ' . $plano->name,
                                                'valor' => 0,
                                                'user_id' => $segundo->id
                                            ];
                                        }


                                        \App\Models\Movimento::create($dados2);

                                        Extrato::create($extrato2);
                                        $pontuacao = $segundo->pontos + $plano->pontos;

                                        $segundo->fill(['pontos' => $pontuacao]);
                                        $segundo->save();
                                    }


                                    $terceiro = User::where('link', $segundo->quem)->first();

                                    if (!empty($terceiro)) {

                                        $planolast3 = $terceiro->assinaturas->last();

                                        if (!empty($planolast3)) {
                                            if (count($aberta->user->assinaturas->where("status", 1)) > 1) {
                                                $extrato3 = [
                                                    'user_id' => $terceiro->id,
                                                    'indicado_id' => $aberta->user->id,
                                                    'pontos' => $plano->pontos,
                                                    'saldo' => ($plano->valor - ($plano->valor * ((100 -  $planolast3->plano->terceiro) / 100)))
                                                ];
                                                $dados3 = [
                                                    'tipo' => 0,
                                                    'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Terceiro Nivel ' . $plano->name,
                                                    'valor' => ($plano->valor - ($plano->valor * ((100 -  $planolast3->plano->terceiro) / 100))),
                                                    'user_id' => $terceiro->id
                                                ];
                                            } else {
                                                $extrato3 = [
                                                    'user_id' => $terceiro->id,
                                                    'indicado_id' => $aberta->user->id,
                                                    'pontos' => $plano->pontos,
                                                    'saldo' => 0
                                                ];
                                                $dados3 = [
                                                    'tipo' => 0,
                                                    'descricao' => 'bonus ref. login ' . $aberta->user->name . ' Terceiro Nivel ' . $plano->name,
                                                    'valor' => 0,
                                                    'user_id' => $terceiro->id
                                                ];
                                            }



                                            \App\Models\Movimento::create($dados3);
                                            Extrato::create($extrato3);
                                            $pontuacao = $terceiro->pontos + $plano->pontos;

                                            //dd($pontuacao);
                                            $terceiro->fill(['pontos' => $pontuacao]);
                                            $terceiro->save();
                                        }
                                    }
                                }
                            }
                        } else {
                        }
                    };
                }
            }
        });
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
