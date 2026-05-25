<?php 

namespace Model;

class Servicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'Service Name is Mandatory';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'The Price of the Service is Mandatory';
        }
        if(!is_numeric($this->precio)) {
            self::$alertas['error'][] = 'The price is not valid';
        }

        return self::$alertas;
    }
}