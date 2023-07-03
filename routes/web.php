<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return 'Hello World, <br> seja bem vindo meu amigo';
// });

Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/sobrenos','SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::get('/login', function(){return 'login';})->name('site.login');


Route::prefix('/app')->group(function(){ 
  Route::get('/clientes', function(){return 'clientes';})->name('app.clientes');
  Route::get('/fornecedores', function(){return 'fornecedores';})->name('app.fornecedores');
  Route::get('/produtos', function(){return 'produtos';})->name('app.produtos');
});

Route::get('/rota1', function() {
echo 'rota 1';
})->name('site.rota1');

// Route::redirect('/rota2', '/rota1');

Route::get('/rota2', function() {
return redirect()->route('site.rota1');
})->name('site.rota2');


// nome, categoria, assunto, mensagem

// tipagem na variaveis para evitar erros
Route::get(
  '/contato/{nome}/{categoria_id}', 
function(
  string $nome = 'Desconhecido',
  int $categoria_id = 1 // 1 - 'Informação'
  ) {
  echo "Estamos aqui $nome - $categoria_id";
})->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+'); // Laravel identifica que se ele receber algo diferente de um numero entre 0 e 9, ele irá recusar a requisição

Route::fallback(function(){
  echo 'Rota acessada não existe. <a href="'.route('site.index').'">Clique aqui para ir até a página inicial</a>';
});

// Route::get($uri, $callback) -> primeiro parametro é sempre a rota e o segundo é uma ação que deve ser tomara quando esse respectivo metodo for acessado

// além do verbo http::get, temos também: 

// get
// post
// put
// delete
// patch
// options