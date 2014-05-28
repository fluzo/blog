<?php

class Comentario extends Eloquent
{

    private static $reglas = array(
        'nombre' => array('required', 'min:2', 'max:25',
            'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'),
        'mensaje' => 'required | max:5000',
        'email' => 'in:'  // Dato que debe venir vacio ya que se oculta mediante jquery (anti spam)
    );
    private static $mensajes = array('regex' => 'El formato de el :attribute no es correcto, solo se permiten letras, números, espacios en blanco
    y guiones medios o bajos.');
    public static function valida()
    {
        $validador = Validator::make(Input::all(), self::$reglas, self::$mensajes); // Validamos el formulario       
        return $validador;
    }

    public function articulo()
    {
        return $this->belongsTo('Articulo');
    }

}
