<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

/* ------------ Blog ---------------- */
Route::get('blog', array('as' => 'blog', 'uses' => 'BlogController@listado'));

Route::get('blog/{slug?}','BlogController@mostrar','slug');
Route::post('blog/{slug?}',array('before' => 'csrf', 'as' => 'blog-articulo', 'uses' =>  'BlogController@validaComentario',),'slug');

Route::get('blog/categoria/{categoria}',array('as' => 'blog-categoria', 'uses' =>  'BlogController@listadoCategoria',),'categoria');

Route::get('admin/blog', array('before' => 'auth.admin', 'as' => 'admin-blog', function()
{
    Return View::make('blog::admin');
}));
Route::get('admin/blog/pendiente',array('before' => 'auth.admin', 'as' => 'admin-blog-pendiente', 'uses' =>  'AdminController@mostrar'));
Route::get('admin/blog/aprobar/{id_comentario}',array('before' => 'auth.admin', 'as' => 'admin-blog-aprobar', 'uses' =>  'AdminController@aprobar'));
Route::get('admin/blog/eliminar/{id_comentario}',array('before' => 'auth.admin', 'as' => 'admin-blog-eliminar', 'uses' =>  'AdminController@eliminar'));