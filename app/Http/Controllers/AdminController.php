<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\Extrato;
use App\Models\Plano;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogActivity;

class AdminController extends Controller
{
    //

    public function users()
    {
        $users = User::all();
        LogActivity::addToLog('Acessou aba Todos Usuarios');
        return view('painel.usuario.index', compact('users'));
    }

    public function ativos()
    {

        $usuarios = User::whereHas('assinaturas')->get();
        $controle = [];
        foreach ($usuarios as $user) {
            foreach ($user->assinaturas as $assinatura) {
                if ($assinatura->status == 1) {
                    $controle[] = $user->id;
                }
            }
        }
        //dd($controle);
        LogActivity::addToLog('Acessou aba Usuarios Ativos');
        $users = User::whereIn('id', $controle)->get();
        // dd($users);

        return view('painel.usuario.ativos', compact('users'));
    }

    public function pendentes()
    {
        // $users = User::with(['assinaturas', function ($q) {
        //  $q->whereNotNull('inicio');
        //}])->get();
        $users = User::doesnthave('assinaturas')->get();
        //dd($users);
        LogActivity::addToLog('Acessou aba Usuarios Pendentes');
        return view('painel.usuario.pendentes', compact('users'));
    }


    public function faturas($id)
    {
        $plano = Plano::find($id);

        //dd(count(Auth::user()->assinaturas));

        if (count(Auth::user()->assinaturas) > 0) {
            return redirect(url('upgrade', $plano->id));
        }



        //dd($plano);

        $hoje = Carbon::now();

        $controle = [];
        $data = Carbon::now();
        $fim = Carbon::now()->addDays(30);
        $dados = [
            'inicio' => $data,
            'fim' => $fim,
            'status' => 0,
            'plano_id' => $id,
            'user_id' => Auth::user()->id,
            'valor' => $plano->valor
        ];

        $salva = Assinatura::create($dados);

        for ($i = 1; $i <= 11; $i++) {
            //echo $i . "<br>";


            $datas = Assinatura::where('user_id', Auth::user()->id)->orderBy('fim', 'desc')->first();
            //dd($datas);
            $grava2 = [
                'inicio' => $datas->fim,
                'fim' => Carbon::create($datas->fim)->addDays((30 * 1)),
                'status' => 0,
                'plano_id' => $id,
                'user_id' => Auth::user()->id,
                'valor' => $plano->valor
            ];


            //  $controle[] = $grava2;
            Assinatura::create($grava2);
        }
        //dd($controle);

        //Assinatura::create($grava);

        return redirect(url('cliente/faturas'));
    }
}
