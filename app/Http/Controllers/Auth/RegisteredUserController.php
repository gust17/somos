<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['cpf_ou_cnpj', 'required', 'unique:users'],
            'telefone' => ['required'],
            'nascimento' => ['required','date'],
            'cep' => ['required'],
            'endereco' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'uf' => ['required'],
            'n' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => preg_replace("/[^0-9]/", "", $request->cpf),
            'telefone' => $request->telefone,
            'link' => md5($request->cpf),
            'nascimento' => $request->nascimento
        ]);

        $estado = \App\Models\Estado::where("name", $request->uf)->first();


        if (!($estado)) {
            $estado = \App\Models\Estado::create(['name' => $request->uf]);
        }
        $cidade = \App\Models\Cidade::where("name", $request->cidade)->where("estado_id", $estado->id)->first();

        if (!($cidade)) {
            $cidade = \App\Models\Cidade::create(['name' => $request->cidade, 'estado_id' => $estado->id]);
        }

        $bairro = \App\Models\Bairro::where('name', $request->bairro)->where("estado_id", $estado->id)->where("cidade_id", $cidade->id)->first();

        //dd($bairro);
        if (!($bairro)) {
            $bairro = \App\Models\Bairro::create(
                [
                    'name' => $request->bairro,
                    'estado_id' => $estado->id,
                    'cidade_id' => $cidade->id
                ]
            );
        }

        $grava = [
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'bairro_id' => $bairro->id,
            'user_id' => $user->id,
            'cidade_id' => $cidade->id,
            'estado_id' => $estado->id,
            'n' => $request->n,
            'complemento' => $request->complemento
        ];

        \App\Models\Endereco::create($grava);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
