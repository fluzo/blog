@extends('blog::base')

@section('head')
@parent
<meta name="description" content="{{ $articulo->meta_description }}" />
@stop

@section('title')
{{ $articulo->titulo }}
@stop
@section('cuerpo')

<h1>Blog</h1>
<hr />
<article>
    <header>
        <h2>{{ $articulo->titulo }}</h2>
        <span class="texto-secundario"><time datetime="{{$articulo->updated_at}}">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($articulo->updated_at))) }}</time></span>    
        @foreach ($categoria as $datos)
        <p>Categoria: <a href="{{route('blog')}}/categoria/{{$datos->slug}}">{{ $datos->nombre }}</a></p>
        @endforeach    
        <hr />    
    </header>
    <p>{{{ $articulo->cuerpo }}}</p>
    <hr />
<!--    <h2>Comentarios</h2> ¡¡¡ PENDIENTE !!!-->
    @foreach ($comentarios as $comentario)
    <div class="comentarios">
        <article>   
            <div class="cabecera-comentarios">              
                <header>
                    <p class="autor-comentario"><a href="">{{ $comentario->autor }}</a></p>
                    <p class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($comentario->created_at))) }}</p>
                </header>
            </div>
            <p class="cuerpo-comentarios">{{{ $comentario->cuerpo }}}</p>
        </article>
    </div>
</article>
@endforeach
<nav><?php echo $comentarios->links(); ?></nav>

@stop

