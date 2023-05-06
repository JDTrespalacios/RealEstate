<?php

namespace App;

class ActiveRecord {
    // DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //ERRORS 
    protected static $errores = [];

    // DEFINE CONNECTION TO DB
    public static function setDB($database){
        self::$db = $database; 
    }


    public function guardar(){
        if(!is_null($this->id)){
            // UPDATE
            $this->actualizar();
        } else {
            // CREATE A NEW REGISTER
            $this->crear();
        }
    }

    public function crear(){
        
        //SANITIZE DATA
        $atributos = $this->sanitizarAtributos(); 

        //INSERTAR INTO DATABASE
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        //Mensaje de éxito o error
        if($resultado){
            // Redirect user
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){
        //SANITIZE DATA
        $atributos = $this->sanitizarAtributos(); 

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE ". static::$tabla . " SET "; 
        $query .= join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        
        $resultado = self::$db->query($query);

        if($resultado){
            // Redirect user
            header('Location: /admin?resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar(){
        // "escape_string" to avoid SQL Injection
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 "; 
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    // IDENTIFY AND MERGE ATTRIBUTES FROM DB

    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDB as $columna){
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // FILES UPLOAD
    public function setImagen($imagen){

        // DELETE PREVIOUS IMAGE
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        // ASSIGN IMAGE NAME TO imagen ATTRIBUTE
        if($imagen){
            $this->imagen = $imagen;
        }
    } 

    // DELETE FILES
    public function borrarImagen(){
            // Check if the file exists
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }



    // VALIDATION
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }


    // Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // GET NUMBER OF REGISTERS
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Search property by ID
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }


    public static function consultarSQL($query){
        // Consultar DB
        $resultado = self::$db->query($query);

        // Iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        // Liberar memoria
        $resultado->free();

        // Retornar resultados
        return $array;
    }


    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }


    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value) ){
                $this->$key = $value;
            }
        }
    }

}