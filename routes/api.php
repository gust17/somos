<?php

use App\Models\Anexo;
use App\Models\Plano;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('dados/{id}', function ($id) {
    $user = \App\Models\User::find($id);

    $start = \Carbon\Carbon::now()->startOfMonth();
    $end = \Carbon\Carbon::now()->addDays(7);

    $ids = $user->indicados->pluck('id')->toArray();


    // dd($assinaturas);
    $controle = [];

    for ($i = $start; $i <= $end; $i->addDay()) {

        $assinaturas = \App\Models\Assinatura::whereIn('user_id', $ids)->whereDate('inicio', $start)->where('status', 1)->count();

        if ($assinaturas > 0) {
            $controle[] = ['name' => $i->format('d-m-Y'), 'total' => $assinaturas];
        }
    }

    return  array_slice(array_reverse($controle), 0, 7);
});

Route::get('buscadados/{id}', function ($id) {

    $plano = Plano::find($id);

    $dado = [];

    $dado[] = ['id' => 1, 'name' => 'Mensal', 'valor' => 'R$ ' . number_format($plano->valor, 2, ',', '.')];
    $dado[] = ['id' => 2, 'name' => 'Anual', 'valor' => 'R$ ' . number_format($plano->valor * 12, 2, ',', '.')];


    //$novo = [];
    // $novo[] = ['name' => $plano->name, 'id' => $plano->id, $dado];
    return $dado;
});
Route::get('buscaplano/{id}', function ($id) {

    $plano = Plano::find($id);



    //$novo = [];
    // $novo[] = ['name' => $plano->name, 'id' => $plano->id, $dado];
    return $plano;
});


Route::post('file-upload/frente', function (Request $request) {

    //return ($request->all());

    $rules = array(
        'file' => 'required|mimes:jpeg,jpg,png,pdf|max:32760'
    );

    $error = Validator::make($request->all(), $rules);

    if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
    }
    $cliente = User::find($request->cliente_id);

    // return ($cliente);
    $image = $request->file('file');

    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    //$image->move(public_path('arquivos'), $new_name);
    $busca = $cliente->anexos->where("doc_id", $request->doc_id);

    //  return ($busca);
    if (count($busca) > 0) {
        $image->move(public_path('arquivos'), $new_name);
        $salvar =  $busca->first();
        $salvar->fill(['verso' => $new_name]);
        $salvar->save();
        //dd($cliente->doc);
        ///  $cliente->doc->fill(['frente' => $new_name]);


        // $cliente->doc->save();
    } else {

        $image->move(public_path('arquivos'), $new_name);
        // return 'oi';
        $grava = [
            'user_id' => $request->cliente_id,
            'frente' => $new_name,
            'doc_id' => $request->doc_id
        ];

        //  return $grava;

        $anexo = Anexo::create($grava);
    }

    $output = array(
        'success' => 'Image uploaded successfully',
        'image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" />'
    );

    return $output;

    // $grava = ['custom' => $request['name'], 'name' => $new_name, 'protocolo_id' => $request['protocolo_id']];
});


Route::post('file-upload/produto/upload', function (Request $request) {
    $rules = array(
        'file' => 'required|mimes:jpeg,jpg,png,pdf|max:32760'
    );

    $error = Validator::make($request->all(), $rules);

    if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
    }

    //return $request->all();
    // $cliente = User::find($request->cliente_id);

    // return ($cliente);
    $image = $request->file('file');

    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    //$image->move(public_path('arquivos'), $new_name);
    // $busca = $cliente->anexos->where("doc_id", $request->doc_id);
    $busca = Produto::find($request->produto_id);
    //return ($busca);
    if (!empty($busca->img)) {
        unlink('arquivos/produtos/' . $busca->img);
    }


    $image->move(public_path('arquivos/produtos'), $new_name);
    $salvar =  $busca;
    $salvar->fill(['img' => $new_name]);
    $salvar->save();
    //dd($cliente->doc);
    ///  $cliente->doc->fill(['frente' => $new_name]);


    // $cliente->doc->save();


    $output = array(
        'success' => 'Image uploaded successfully',
        'image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" />'
    );

    return $output;
});
Route::post('file-upload/produto/doc/upload', function (Request $request) {
    $rules = array(
        'file' => 'required|mimes:jpeg,jpg,png,pdf|max:32760'
    );

    $error = Validator::make($request->all(), $rules);

    if ($error->fails()) {
        return response()->json(['errors' => $error->errors()->all()]);
    }
    if (!empty($busca->arquivo)) {
        unlink('arquivos/produtos/doc' . $busca->arquivo);
    }


    //return $request->all();
    // $cliente = User::find($request->cliente_id);

    // return ($cliente);
    $image = $request->file('file');

    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    //$image->move(public_path('arquivos'), $new_name);
    // $busca = $cliente->anexos->where("doc_id", $request->doc_id);
    $busca = Produto::find($request->produto_id);
    //return ($busca);
    $image->move(public_path('arquivos/produtos/doc'), $new_name);
    $salvar =  $busca;
    $salvar->fill(['arquivo' => $new_name]);
    $salvar->save();
    //dd($cliente->doc);
    ///  $cliente->doc->fill(['frente' => $new_name]);


    // $cliente->doc->save();


    $output = array(
        'success' => 'Image uploaded successfully',
        'image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" />'
    );

    return $output;
});
