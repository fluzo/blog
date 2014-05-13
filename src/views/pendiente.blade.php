@extends('blog::base')
@section('title')
Administracion
@stop
@section('cuerpo')
<h1><a href="/admin">Administración</a> :: <a href="{{route('admin-blog')}}">Blog</a> -> Pendiente</h1>
<hr />
<h2>Comentarios de articulos</h2>    
<hr />

@if ( !is_null($comentarios) )
<article>
    @foreach ($comentarios as $comentario)
    <div class="comentarios">
        <article>   
            <div class="cabecera-comentarios">              
                <header>
                    <h3>Articulo: <a href="/blog/{{$comentario->articulo->slug}}-{{$comentario->articulo->id}}">{{$comentario->articulo->titulo}}</a></h3>
                    <span>Id comentario: {{ $comentario->id }}</span><br />
                    <span class="autor-comentario"><strong>{{ $comentario->autor }}</strong></span><br />
                    <span class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($comentario->created_at))) }}</span>
                </header>
            </div>
            <div class="cuerpo-comentarios">{{ $comentario->cuerpo }}</div>
        </article>
    </div>
</article>
@endforeach
<a href="/admin/blog/eliminar/{{ $comentario->id }}" class="btn btn-danger">Eliminar</a>
<a href="/admin/blog/aprobar/{{ $comentario->id }}" class="btn btn-success pull-right">Aprobar</a>
<nav class="texto-centrado"><?php echo $comentarios->links(); ?></nav>
@else
<h3 class="alert alert-info">Ningún comentario pendiente</h3>
@endif
@stop

