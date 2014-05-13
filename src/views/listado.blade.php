@extends('blog::base')
@section('head')
@parent
<meta name="description" content="Listado de artículos sobre {{{ isset($categoria_seleccionada) ? $articulos->first()->categoria->nombre : 'cualquier categoria.' }}}" />
@stop
@section('title')
Blog
@stop

@section('cuerpo')
<h1>Blog<small>{{{ isset($categoria_seleccionada) ?  ' :: '.$articulos->first()->categoria->nombre : '' }}}</small></h1>
<hr />
<select class="form-control select-categorias" onchange="location = this.options[this.selectedIndex].value;">
    <option value="{{route('blog')}}">Categorías</option>
    @foreach ($categorias as $categoria)
    @if ((isset($categoria_seleccionada)) and ($categoria_seleccionada === $categoria->slug ))
            <option selected="selected" value="{{route('blog')}}/categoria/{{$categoria->slug}}">{{ $categoria->nombre }}</option>
        @else
            <option value="{{route('blog')}}/categoria/{{$categoria->slug}}">{{ $categoria->nombre }}</option>
    @endif
    @endforeach
</select>


@foreach ($articulos as $articulo)
<section class="articulos-portada well">
    <h3><a href="{{route('blog')}}/{{$articulo->slug}}-{{$articulo->id}}">{{ $articulo->titulo }}</a></h3>
    <h4><small>{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($articulo->updated_at))) }}</small></h4>
    <h5>Categoria: <a href="{{route('blog')}}/categoria/{{$articulo->categoria->slug}}">{{ $articulo->categoria->nombre }}</a></h5>
</section>
@endforeach
<nav><?php echo $articulos->links(); ?></nav>
@stop


<!--@section('javascript')
@parent
<script src="/packages/fluzo/blog/js/blog.js"></script>
@stop-->