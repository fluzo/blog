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

Route::get('blog/categoria/{categoria}',array('as' => 'blog-categoria', 'uses' =>  'BlogController@listadoCategoria',),'categoria');
