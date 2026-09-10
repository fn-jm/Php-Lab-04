<?php

class Usuario
{
    public string $nombre;
    public string $email;

    public function mostrarInfo()
    {
        return "Nombre: $this->nombre <br> Email: $this->email";
    }
}
