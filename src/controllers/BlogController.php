<?php

//use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends BaseController
{

    public function listado()
    {
        $articulos = Articulo::orderBy('updated_at', 'desc')->paginate(5);
        return View::make('blog::listado')->with('articulos', $articulos);
    }

    public function mostrar($slug = null)
    {
        $array_slug = explode("-", $slug);
        $id = end($array_slug); // Id obtenido del slug
        $slug = substr($slug, 0, strrpos($slug, "-")); // Slug sin el id
        $articulo = Articulo::where('id', '=', $id)->where('slug', '=', $slug)->firstOrFail();
        $categoria = Categoria::where('id', '=', $articulo->categoria_id)->get();
        $comentarios = Comentario::where('articulo_id', '=', $articulo->id)->orderBy('created_at', 'asc')->paginate(10);

        return View::make('blog::mostrar')->with(array('articulo' => $articulo, 'categoria' => $categoria, 'comentarios' => $comentarios));
    }

    public function listadoCategoria($categoria = null)
    {
        $categoria_id = Categoria::where('slug', '=', $categoria)->pluck('id');
        if (is_null($categoria_id)) // Si no existe la categoria, lanzamos un 404
        {
            App::abort(404);
        }
        $articulos = Articulo::where('categoria_id', '=', $categoria_id)->orderBy('updated_at', 'desc')->paginate(5);
        return View::make('blog::listado')->with(array('articulos' => $articulos, 'categoria' => $categoria));
    }

}
