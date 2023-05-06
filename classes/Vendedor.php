<?php

namespace App;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args= [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';        
    }

    public function validar(){
        if (!$this->nombre) {
            self::$errores[] = "You must insert a name";
        }

        if (!$this->apellido) {
            self::$errores[] = "You must insert a last name";
        }

        if (!$this->telefono) {
            self::$errores[] = "You must insert a phone number";
        }


        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Invalid format";
        }

        return self::$errores;
    }

}