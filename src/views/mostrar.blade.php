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
        <h4><small><time datetime="{{$articulo->updated_at}}">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($articulo->updated_at))) }}</time></small></h4>    
        @foreach ($categoria as $datos)
        <h5>Categoria: <a href="{{route('blog')}}/categoria/{{$datos->slug}}">{{ $datos->nombre }}</a></h5>
        @endforeach    
        <hr />    
    </header>
    <p>{{ $articulo->cuerpo }}</p>
    <hr />
    
    {{------------------ COMENTARIOS --------------------}}
    <h2>Comentarios</h2>    
    @foreach ($comentarios as $comentario)
    <div class="comentarios">
        <article>   
            <div class="cabecera-comentarios">              
                <header>
                    <span class="autor-comentario"><strong>{{ $comentario->autor }} </strong></span>-
                    <span class="texto-secundario"> {{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($comentario->created_at))) }}</span>
                </header>
            </div>            
            <div class="cuerpo-comentarios">{{ $comentario->cuerpo }}</div>
        </article>
    </div>
</article>
@endforeach
<nav class="texto-centrado"><?php echo $comentarios->links(); ?></nav>

{{-- Mensaje de confirmación de envio de post --}}
@if (isset($confirmacion)) 
<br><br>
<p id="confirmacion" class="alert alert-success">{{ $confirmacion }}</p>
@endif

<h3>Añadir comentario</h3>
@include ('blog::errores')

@if (Session::get('vista_previa'))
<hr />
<h3 id="vista-previa">Vista previa</h3>

<div id="vista-previa-comentario" class="well">
{{ Session::get('mensaje', '') }}
</div>
@endif

{{ Form::open(array('url' => Request::path(),'id' => 'formulario-comentario','role' => 'form', 'class' => 'well well-lg')) }}
<div class="form-group">
{{ Form::label('nombre', 'Nombre') }}
{{ Form::text('nombre',null,array('class' => 'form-control')) }}
</div>

{{-- Este campo no aparecera en el formulario, se ocultara via jquery --}}
<div id="div-email" class="form-group">
{{ Form::label('email', 'Email') }}
{{ Form::text('email',null,array('class' => 'form-control')) }}
</div>


<div class="form-group">
{{ Form::label('mensaje', 'Mensaje') }}
{{ Form::textarea('mensaje',null,array('class' => 'form-control', 'rows' => '15')) }}
</div>
<span class="text-danger">Todos los comentarios son revisados antes de publicarse.</span><br>
<span>Etiquetas permitidas: <code>&lt;strong&gt;, &lt;a&gt;, &lt;pre&gt;</code>.</span><br>
<span>Ejemplos de uso:</span>
<ul>
    <li>&lt;strong&gt;<code>Tu texto</code>&lt;/strong&gt;</li>    
    <li>&lt;a href="http://encuentra.biz"&gt;<code>Tu texto</code>&lt;/a&gt;</li>
    <li>&lt;pre&gt;&lt;![CDATA[<br><code>Tu codigo html,css,php etc...</code><br>]]&gt;&lt;/pre&gt;</li>
</ul>
{{ Form::hidden('articulo_id', $articulo->id) }} 
<br />
{{ Form::submit('Vista previa',array('name'=>'boton','class' => 'btn btn-success btn-lg')) }}
@if (Session::get('vista_previa'))
    {{ Form::submit('Enviar',array('name'=>'boton','class' => 'btn btn-primary btn-lg')) }}
@endif
{{ Form::close() }}


@stop



