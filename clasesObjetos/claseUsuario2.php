<?php

class Usuario2
{
    public string $nombre;
    public string $email;

    public function __construct(string $nombre, string $email)
    {
        $this->nombre = $nombre;
        $this->email = $email;
    }

    public function mostrarInfo()
    {
        return "Nombre: $this->nombre <br> Email: $this->email";
    }
}
