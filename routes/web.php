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

Route::get('/login', [\App\Http\Controllers\PainelController::class, 'login'])->name("painel.login");
Route::post('/logar', [\App\Http\Controllers\PainelController::class, 'logar'])->name("painel.logar");

Route::post('/api/leads', [\App\Http\Controllers\ApiController::class, 'leadAdd'])->name("lead.add");

Route::middleware(['admin'])->group(function () {

	Route::name("painel.")->group(function () {
		Route::controller(\App\Http\Controllers\PainelController::class)->group(function () {
			Route::get('/', 'index')->name("index");
			Route::get('/indisponivel', 'indisponivel')->name("indisponivel");
			Route::get('/sair', 'sair')->name("sair");
			Route::get('/leads', 'leads')->name("leads");
		});

		// ROTAS DE ASSOCIADOS
		Route::name("associados")->controller(\App\Http\Controllers\AssociadosController::class)->group(function () {
			Route::get('/associados', 'consultar');
			Route::get('/associados/importar', 'importar')->name(".importar");
			Route::get('/associados/senhas', 'senhas')->name(".senhas");
			Route::get('/associados/exportar', 'exportar')->name(".exportar");
		});

		Route::name("servicos")->controller(\App\Http\Controllers\ServicosController::class)->group(function () {
			Route::get('/tipos', 'consultar');
		});

		// ROTAS DE CONVENIOS
		Route::name("convenios")->controller(\App\Http\Controllers\ConveniosController::class)->group(function () {
			Route::get('/convenios', 'consultar');
		});

		// ROTAS DE EVENTOS
		Route::name("eventos")->controller(\App\Http\Controllers\EventosController::class)->group(function () {
			Route::get('/eventos', 'consultar');
			Route::get('/eventos/{evento}/palestras', 'palestras')->name(".palestras");
		});

		// ROTAS DE BANNERS
		Route::name("banners")->controller(\App\Http\Controllers\BannersController::class)->group(function () {
			Route::get('/banners/principal', 'consultar');
			Route::get('/banners/cursos', 'cursos')->name(".cursos");
		});

		// ROTAS DE MENSAGENS
		Route::name("mensagens")->controller(\App\Http\Controllers\MensagensController::class)->group(function () {
			Route::get('/mensagens/suporte', 'suporte')->name(".suporte");
		});

		// ROTAS DE NEWSLETTER
		Route::name("newsletter")->controller(\App\Http\Controllers\NewsletterController::class)->group(function () {
			Route::get('/newsletter', 'consultar');
		});

		// ROTAS DE LEADS
		Route::name("leads")->controller(\App\Http\Controllers\LeadsController::class)->group(function () {
			Route::get('/leads', 'consultar');
		});

		// ROTAS DE USUÁRIOS
		Route::controller(\App\Http\Controllers\UsuariosController::class)->group(function () {
			Route::get('/usuarios', 'consultar')->name("usuarios");
			Route::get('/usuarios/inativos', 'consultar_inativos')->name("usuarios.inativos");
			Route::get('/usuarios/ativos', 'consultar_ativos')->name("usuarios.ativos");
			Route::get('/usuarios/cadastro', 'cadastro')->name("usuario.cadastro");
			Route::post('/usuarios/cadastrar', 'cadastrar')->name("usuario.cadastrar");
			Route::get('/usuarios/editar/{usuario}', 'editar')->name("usuario.editar");
			Route::post('/usuarios/salvar/{usuario}', 'salvar')->name("usuario.salvar");
			Route::get('/usuarios/bloqueio/{usuario}', 'bloqueio')->name("usuario.bloqueio");
			Route::get('/usuarios/remover/{usuario}', 'remover')->name("usuario.remover");
		});

		// ROTAS DE HOTSITES
		Route::name("hotsites")->controller(\App\Http\Controllers\HotsitesController::class)->group(function () {
			Route::get('/hotsites', 'consultar');
		});


		// ROTAS DE TAGS
		Route::get('/tags', [\App\Http\Controllers\TagsController::class, 'consultar'])->name("tags");
		Route::post('/tags/cadastrar', [\App\Http\Controllers\TagsController::class, 'cadastrar'])->name("tag.cadastrar");
		Route::post('/tags/salvar/{tag}', [\App\Http\Controllers\TagsController::class, 'salvar'])->name("tag.salvar");
		Route::get('/tags/deletar/{tag}', [\App\Http\Controllers\TagsController::class, 'deletar'])->name("tag.deletar");

		// ROTAS DE CATEGORIAS
		Route::match(['get', 'post'], '/categorias', [\App\Http\Controllers\ContratosController::class, 'consultar'])->name("categorias");
		Route::post('/categorias/salvar', [\App\Http\Controllers\ContratosController::class, 'salvar'])->name("categoria.salvar");
		Route::get('/categorias/deletar/{contrato}', [\App\Http\Controllers\ContratosController::class, 'deletar'])->name("categoria.deletar");
		Route::get('/categorias/cadastrar', [\App\Http\Controllers\ContratosController::class, 'cadastrar'])->name("categorias.cadastro");
		Route::get('/categorias/editar/{contrato}', [\App\Http\Controllers\ContratosController::class, 'editar'])->name("categorias.editar");

		// ROTAS DE NOTICIAS
		Route::match(['get', 'post'], '/noticias', [\App\Http\Controllers\NoticiasController::class, 'consultar'])->name("noticias");
		Route::get('/noticias/cadastro', [\App\Http\Controllers\NoticiasController::class, 'cadastro'])->name("noticia.cadastro");
		Route::get('/noticias/leads/{noticia}', [\App\Http\Controllers\NoticiasController::class, 'visitas'])->name("noticia.visitas");
		Route::post('/noticias/cadastrar', [\App\Http\Controllers\NoticiasController::class, 'cadastrar'])->name("noticia.cadastrar");
		Route::get('/noticias/editar/{noticia}', [\App\Http\Controllers\NoticiasController::class, 'editar'])->name("noticia.editar");
		Route::post('/noticias/salvar/{noticia}', [\App\Http\Controllers\NoticiasController::class, 'salvar'])->name("noticia.salvar");
		Route::get('/noticias/deletar/{noticia}', [\App\Http\Controllers\NoticiasController::class, 'deletar'])->name("noticia.deletar");
		Route::get('/noticias/publicar/{noticia}', [\App\Http\Controllers\NoticiasController::class, 'publicar'])->name("noticia.publicar");
		Route::get('/noticias/preview/{noticia}', [\App\Http\Controllers\NoticiasController::class, 'preview'])->name("noticia.preview");


		Route::post('/salvar/imagens/temporarias', [\App\Http\Controllers\ImagensController::class, 'salvar_temp'])->name("imagens.temporarias.salvar");
	});
});
