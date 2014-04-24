@extends('blog::base')
@section('title')
Blog
@stop
@section('cuerpo')
<div class="listado-categorias"><h1>Blog</h1><h3> :: {{$articulos->first()->categoria->nombre}}</h3></div>
<hr />
@foreach ($articulos as $articulo)
<div class="articulos-portada">
<h2><a href="{{route('blog')}}/{{$articulo->slug}}-{{$articulo->id}}">{{ $articulo->titulo }}</a></h2>
    <p class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($articulo->updated_at))) }}</p> 
    <p>Categoria: <a href="{{route('blog')}}/categoria/{{$articulo->categoria->slug}}">{{ $articulo->categoria->nombre }}</a></p>
</div>  
@endforeach
<?php echo $articulos->links(); ?>
@stop

