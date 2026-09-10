<?php
class Tarea
{
    private $id;
    private $descripcion;
    private $importancia;
    private $mesRealizacion;
    private $fechaRealizacion;

    public function __construct($id, $descripcion = "", $importancia = 1, $mesRealizacion = "", $fechaRealizacion = 1)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->importancia = $importancia;
        $this->mesRealizacion = $mesRealizacion;
        $this->fechaRealizacion = $fechaRealizacion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getImportancia()
    {
        return $this->importancia;
    }

    public function getMesRealizacion()
    {
        return $this->mesRealizacion;
    }

    public function getFechaRealizacion()
    {
        return $this->fechaRealizacion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setImportancia($importancia)
    {
        $this->importancia = $importancia;
    }

    public function setMesRealizacion($mesRealizacion)
    {
        $this->mesRealizacion = $mesRealizacion;
    }

    public function setFechaRealizacion($fechaRealizacion)
    {
        $this->fechaRealizacion = $fechaRealizacion;
    }

    public static function nuevaTarea($id, $descripcion, $importancia, $mesRealizacion, $fechaRealizacion)
    {
        return new Tarea($id, $descripcion, $importancia, $mesRealizacion, $fechaRealizacion);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'importancia' => $this->importancia,
            'mesRealizacion' => $this->mesRealizacion,
            'fechaRealizacion' => $this->fechaRealizacion
        ];
    }
}
