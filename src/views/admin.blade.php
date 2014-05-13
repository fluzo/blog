@extends('blog::base')
@section('title')
Administracion :: Blog
@stop

@section('cuerpo')
<h1><a href="/admin">Administración</a> :: Blog</h1>
<hr />
<a href="{{route('admin-blog-pendiente')}}">Pendiente</a>
@stop

