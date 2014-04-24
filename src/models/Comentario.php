<?php

class Comentario extends Eloquent
{

    public function articulo()
    {
        return $this->belongsTo('Articulo');
    }

}
