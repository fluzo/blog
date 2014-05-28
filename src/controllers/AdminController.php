<?php

class AdminController extends BaseController
{

    public function mostrar()
    {
//        App::error(function(ModelNotFoundException $e)
//        {
//            return View::make('blog::pendiente')->with('comentarios', null);
//        });
        // Comentarios de articulos pendientes de aprobación
        $comentarios = Comentario::where('aprobado', '=', false)->orderBy('created_at', 'asc')->paginate(1);
        if (is_null($comentarios->first())) { $comentarios=null; }
        return View::make('blog::pendiente')->with('comentarios', $comentarios);
    }

    public function aprobar($id_comentario)
    {
        $comentario = Comentario::find($id_comentario);
        $comentario->aprobado = true;
        $comentario->save();
        return Redirect::route('admin-blog-pendiente');
    }

    public function eliminar($id_comentario)
    {
        Comentario::destroy($id_comentario);
        return Redirect::route('admin-blog-pendiente');
    }

}
