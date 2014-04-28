@extends('blog::base')
@section('head')
@parent
<meta name="description" content="Listado de artículos sobre {{{ isset($categoria_seleccionada) ? $articulos->first()->categoria->nombre : 'cualquier categoria.' }}}" />
@stop
@section('title')
Blog
@stop

@section('cuerpo')
<div class="listado-categorias"><h1>Blog</h1><h3>{{{ isset($categoria_seleccionada) ?  ' :: '.$articulos->first()->categoria->nombre : '' }}}</h3></div>
<hr />

<select onchange="location = this.options[this.selectedIndex].value;">
    <option value="{{route('blog')}}">Categorías</option>
    @foreach ($categorias as $categoria)
    @if ((isset($categoria_seleccionada)) and ($categoria_seleccionada === $categoria->slug ))
            <option selected="selected" value="{{route('blog')}}/categoria/{{$categoria->slug}}">{{ $categoria->nombre }}</option>
        @else
            <option value="{{route('blog')}}/categoria/{{$categoria->slug}}">{{ $categoria->nombre }}</option>
    @endif
    @endforeach
</select>

<br /><br />

@foreach ($articulos as $articulo)
<section class="articulos-portada">
    <h3><a href="{{route('blog')}}/{{$articulo->slug}}-{{$articulo->id}}">{{ $articulo->titulo }}</a></h3>
    <span class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($articulo->updated_at))) }}</span> 
    <p>Categoria: <a href="{{route('blog')}}/categoria/{{$articulo->categoria->slug}}">{{ $articulo->categoria->nombre }}</a></p>
</section>
@endforeach
<nav><?php echo $articulos->links(); ?></nav>
@stop


<!--@section('javascript')
@parent
<script src="/packages/fluzo/blog/js/blog.js"></script>
@stop-->