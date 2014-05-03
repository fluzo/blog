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
    <p>{{ $articulo->cuerpo }}</p>
    <hr />
    
    {{------------------ Comentarios --------------------}}
    <h2>Comentarios</h2>
    @foreach ($comentarios as $comentario)
    <div class="comentarios">
        <article>   
            <div class="cabecera-comentarios">              
                <header>
                    <span class="autor-comentario"><a href="">{{ $comentario->autor }}</a></span>
                    <span class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($comentario->created_at))) }}</span>
                </header>
            </div>
            <p class="cuerpo-comentarios">{{ $comentario->cuerpo }}</p>
        </article>
    </div>
</article>
@endforeach
<nav><?php echo $comentarios->links(); ?></nav>

<h3>Añadir comentario</h3>
@include ('blog::errores')

@if (Session::get('vista_previa'))
<hr />
<h3 id="vista-previa">Vista previa</h3>

<div id="vista-previa-comentario">
{{ Session::get('mensaje', '') }}
</div>
@endif

{{ Form::open(array('url' => Request::path(),'id' => 'formulario-comentario')) }}
{{ Form::label('nombre', 'Nombre') }}
{{ Form::text('nombre') }}
<br />
{{ Form::label('mensaje', 'Mensaje') }}
{{ Form::textarea('mensaje') }}
<br />
<br />
<span>Todos los comentarios son revisados antes de publicarse.</span><br>
<span>Etiquetas permitidas: <code>&lt;strong&gt;, &lt;a&gt;, &lt;pre&gt;</code>.</span><br>
<span>Ejemplos de uso:</span>
<ul>
    <li>&lt;strong&gt;mi texto&lt;/strong&gt;</li>    
    <li>&lt;a href="http://encuentra.biz"&gt;Encuentra&lt;/a&gt;</li>
    <li>&lt;pre&gt;Pon aqui tu codigo html, css, php ...&lt;/pre&gt;</li>
</ul>
{{ Form::hidden('articulo_id', $articulo->id) }} 
<br />
{{ Form::submit('Vista previa',array('name'=>'boton')) }}
@if (Session::get('vista_previa'))
    {{ Form::submit('Enviar',array('name'=>'boton')) }}
@endif
{{ Form::close() }}


@stop



