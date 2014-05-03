<?php

//use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends BaseController
{

    public function validaComentario()
    {
        $validador = Comentario::valida();

        if ($validador->passes())
        {            
            $mensaje = Input::get('mensaje');
            $mensaje = str_replace(array("<pre>", "</pre>"), array("<pre><![CDATA[", "]]></pre>"), $mensaje);
            $mensaje = Purifier::clean($mensaje);                   
            $mensaje = Utilidades::fluzo_nl2br($mensaje);    
            
            
            if (Input::get('boton') === 'Vista previa') // Si venimos de vista previa, mostramos datos y recargamos con boton enviar visible.
            {
                return Redirect::to(Request::path() . '#vista-previa')
                        //->withInput(array('nombre' => Input::get('nombre'),'mensaje' => $mensaje))->with(array('mensaje' => $mensaje, 'vista_previa' => true));
                        ->withInput()->with(array('mensaje' => $mensaje, 'vista_previa' => true));
            }
            elseif (Input::get('boton') === 'Enviar') // Si venimos del boton enviar, grabamos y recargamos página.
            {
                //$comentario = Comentario::create(array('autor' => Input::get('nombre'), 'cuerpo' => Input::get('mensaje'), 'articulo_id' => Input::get('articulo_id')));
                $comentario = new Comentario;                
                $comentario->autor = Input::get('nombre');
                $comentario->cuerpo = $mensaje;
                $comentario->articulo_id = Input::get('articulo_id');
                $comentario->save();              
                
                return Redirect::to(Request::path());
            }
        }
        else
        {
            return Redirect::to(Request::path())->withErrors($validador)->withInput();
        }
    }

    public function listado()
    {
        $articulos = Articulo::orderBy('updated_at', 'desc')->paginate(4);
        $categorias = Categoria::all();
        return View::make('blog::listado')->with(array('articulos' => $articulos, 'categorias' => $categorias));
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
        $articulos = Articulo::where('categoria_id', '=', $categoria_id)->orderBy('updated_at', 'desc')->paginate(4);
        $categorias = Categoria::all();
        return View::make('blog::listado')->with(array('articulos' => $articulos, 'categoria_seleccionada' => $categoria, 'categorias' => $categorias));
    }

}
