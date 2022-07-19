<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Bus;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Null_;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'telefone',
        'link',
        'contador',
        'quem',
        'pontos',
        'ordem',
        'nascimento',
        'tipo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assinaturas()
    {
        return $this->hasMany(Assinatura::class);
    }


    public function indicados()
    {


        return $this->hasMany(User::class, 'quem', 'link');
    }

    public function meindica()
    {
        # code...

        return $this->belongsTo(User::class, 'quem', 'link');
    }


    public function getPercAttribute()
    {
        if ($this->attributes['ordem'] == 12) {
            $nivel = $this->attributes['ordem'];
            $pin = Meta::where("ordem", $nivel)->first();
        } else {
            $nivel = $this->attributes['ordem'] + 1;
            $pin = Meta::where("ordem", $nivel)->first();
        }

        $por = $this->attributes['pontos'] * 100 / $pin->pontuacao;

        return $por;
    }


    public function extratos()
    {
        return $this->hasMany(Extrato::class);
    }


    public function direto()
    {
        if (isset($this->attributes['quem'])) {
            $user = User::where('link', $this->attributes['quem'])->first();

            if (isset($user)) {
                return $user;
            }

            return NULL;
        }
        return NULL;
    }

    public function primeiro()
    {
        $busca = $this->direto();
        if (!empty($busca)) {

            if (isset($busca->quem)) {
                $user = User::where('link', $busca->quem)->first();

                if (isset($user)) {
                    return $user;
                }

                return NULL;
            }
            return NULL;
        }
    }

    public function segundo()
    {
        $busca = $this->primeiro();
        if (!empty($busca)) {

            if (isset($busca->quem)) {
                $user = User::where('link', $busca->quem)->first();

                if (isset($user)) {
                    return $user;
                }

                return NULL;
            }
            return NULL;
        }
    }

    public function terceiro()
    {
        $busca = $this->segundo();
        if (!empty($busca)) {

            if (isset($busca->quem)) {
                $user = User::where('link', $busca->quem)->first();

                if (isset($user)) {
                    return $user;
                }

                return NULL;
            }
            return NULL;
        }
    }


    public function getSaldoAttribute()
    {
        $soma = 0;
        $diminui = 0;
        $extratos = Extrato::where('user_id', $this->attributes['id'])->get();
        foreach ($extratos as $estrato) {
            $soma += $estrato->saldo;
        }
        return $soma;
    }

    public function getSobraAttribute()
    {

        $total = 0;

        $total += $this->getSaldoAttribute();
        $total -= $this->getTotalSaqueAttribute();

        //dd(is_numeric($this->getTotalSaqueAttribute()));
        //$total = bcsub(8, 9);
        return $total;
        //return bcsub($this->getSaldoAttribute(), $this->getTotalSaqueAttribute());
    }

    public function getStatusAttribute()
    {


        if (!empty($this->assinaturas->last())) {
            return 'ativo';
        } else {

            return 'inativo';
        }
    }

    public function getTotalAttribute()
    {
        $total = 0;
        $total += $this->getSaldoAttribute();
        foreach ($this->indicados as $indicado) {
            $total += $indicado->saldo;
            foreach ($indicado->indicados as $primeiro) {
                // dd($primeiro->saldo);
                $total += $primeiro->saldo;
                foreach ($primeiro->indicados as $segundo) {
                    $total += $segundo->saldo;
                    foreach ($segundo->indicados as $terceiro) {
                        $total += $terceiro->saldo;
                    }
                }
            }
        }

        return $total;
    }

    public function movimentos()
    {
        return $this->hasMany(Movimento::class);
    }

    public function saques()
    {
        return $this->hasMany(Saque::class);
    }


    public function getTotalSaqueAttribute()
    {
        $total = 0;
        foreach ($this->saques as $saque) {
            $total += $saque->valor;
        }

        return $total;
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function contas()
    {
        return $this->hasMany(Conta::class);
    }


    public function getAtivoAttribute()
    {
        if (count($this->assinaturas) > 0) {
            $busca = Assinatura::where('unico', 1)->where('user_id', $this->attributes['id'])->first();
            if ($busca) {
                return 1;
            }
            if ($this->assinaturas->first()->status == 1 && $this->getMesAtivoAttribute() == 1) {
                return 1;
            }
        } else {
            return 0;
        }

        return 0;
    }

    public function interesses()
    {
        return $this->hasMany(Interesse::class);
    }


    public function getMesAtivoAttribute()
    {
        $hoje = Carbon::now();

        //dd($hoje);

        #
        // $assinaturas = Assinatura::where("user_id", $this->attributes['id'])->whereMonth('inicio',$hoje)->get();
        $assinaturas = Assinatura::where('user_id', $this->attributes['id'])->where(function ($query) use ($hoje) {
            $query->whereMonth('inicio', $hoje)->orWhere('fim', $hoje);
        })->get();
        //dd($assinaturas);

        if (count($assinaturas) > 0) {

            foreach ($assinaturas as $assinatura) {
                //  dd($assinatura);
                if (($assinatura->inicio <= $hoje->format('Y-m-d')) && ($assinatura->fim >= $hoje) && ($assinatura->status == 1)) {
                    // dd($assinatura);
                    return 1;
                } else {
                    return 0;
                }
            }
            return 1;
        } else {
            return 0;
        }



        if (isset($this->assinaturas)) {

            //   $busca =  $this->assinaturas()->where('status', 1)->whereBetween($hoje,[])->first();
            //return 1;


            // dd($busca);
            /*
            foreach ($this->assinaturas as $assinatura) {
                if ($hoje > $assinatura->inicio) {
                    //dd($assinatura
                    if ($hoje <= Carbon::create($assinatura->fim)) {
                        dd('oi');
                    }
                };
                if (($assinatura->inicio < $hoje) && ($assinatura->fim >= $hoje) && ($assinatura->status == 1)) {
                    return 1;
                } else {
                    return 0;
                }
            } */
        }
    }

    public function getAtividadeAttribute()
    {
        if ($this->attributes['tipo'] == 1) {
            return "Adminstrador";
        }
        if ($this->attributes['tipo'] == 2) {
            return "Financeiro";
        }
        if ($this->attributes['suporte'] == 3) {
            return "Suporte";
        }
    }

    public function historicos()
    {
        return $this->hasMany(Historico::class);
    }

    public function getVerificaFaturaAttribute()
    {
        $assinaturas = Assinatura::where("user_id", $this->attributes['id'])->get();
        if (count($assinaturas) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function anexos()
    {

        return $this->hasMany(Anexo::class);
    }


    public function creditos()
    {

        return $this->hasMany(Credito::class);
    }



    public function abertas()
    {
        return ($this->assinaturas()->where('status', 0)->get());
    }

    public function getStatusPremioAttribute($meta)
    {
        $premio = Premio::where('user_id', $this->attributes['id'])->where('meta_id', $meta)->first();
//dd($premio);
        if (!empty($premio)) {
            return 1;
        }
        return 0;
    }
}
