<?php

class CategoriaArticulo extends Eloquent
{

    public function articulo()
    {
        return $this->belongsToMany('Articulo');
    }

}
