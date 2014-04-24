@extends('blog::base')
@section('title')
{{ $articulo->titulo }}
@stop
@section('cuerpo')

<h1>Blog</h1>
<hr />
<h2>{{ $articulo->titulo }}</h2>
<p class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($articulo->updated_at))) }}</p>    
@foreach ($categoria as $datos)
<p>Categoria: <a href="{{route('blog')}}/categoria/{{$datos->slug}}">{{ $datos->nombre }}</a></p>
@endforeach
<hr />
<p>{{ $articulo->cuerpo }}</p>
<hr />
<h2>Comentarios</h2>

@foreach ($comentarios as $comentario)
<div class="comentarios">
    <div class="cabecera-comentarios">
        <p class="autor-comentario"><a href="">{{ $comentario->autor }}</a></p>
        <p class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($comentario->created_at))) }}</p>
    </div>
    <p class="cuerpo-comentarios">{{{ $comentario->cuerpo }}}</p>
</div>
@endforeach
<?php echo $comentarios->links(); ?>

@stop

