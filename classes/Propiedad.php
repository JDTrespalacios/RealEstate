<?php 

namespace App;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args= [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
        
    }

    public function validar(){
        if (!$this->titulo) {
            self::$errores[] = "You must insert a title";
        }

        if (!$this->precio) {
            self::$errores[] = "The 'price' field is mandatory";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "The 'description' field must have at least 50 characters";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "The 'habitaciones' field is mandatory";
        }

        if (!$this->wc) {
            self::$errores[] = "The 'wc' field is mandatory";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "The 'estacionamiento' field is mandatory";
        }

        if (!$this->vendedorId) {
            self::$errores[] = "Choose a seller";
        }
        
        if (!$this->imagen) {
            self::$errores[] = "Image is mandatory";
        }

        return self::$errores;
    }
}