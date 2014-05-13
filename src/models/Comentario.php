<?php

class Comentario extends Eloquent
{
    private static $reglas = array(
        'nombre' => array('required', 'min:2', 'max:25'), 
            //'regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'),
        //'email' => 'required | email | min:5 | max:150',
        'mensaje' => 'required | max:5000',
        'email' => 'in:'  // Dato que debe venir vacio ya que se oculta mediante jquery (anti spam)
    );
    public static function valida()
    {
        $validador = Validator::make(Input::all(), self::$reglas); // Validamos el formulario       
        return $validador;
    }
    
    public function articulo()
    {
        return $this->belongsTo('Articulo');
    }

}
