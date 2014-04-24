<?php

class Articulo extends Eloquent
{

    public function comentarios()
    {
        return $this->hasMany('Comentario');
    }
    public function categoria()
    {
        return $this->belongsTo('Categoria');
    }

}
