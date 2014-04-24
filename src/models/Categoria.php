<?php

class Categoria extends Eloquent
{

    public function articulo()
    {
        return $this->hasOne('Articulo');
    }

}
