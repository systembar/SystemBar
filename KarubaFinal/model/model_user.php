<?php 

class Usuario 
{
	private $cedula;
	private $nombre;
	private $apellido;
    private $telefono;
    private $celular;
	private $foto;
    private $correo;
    private $tipo_usuario;
    private $tipo_documento;
    private $estado;
    private $usuario;
	private $pass;


	public function __GET($att)
	{
		return $this->$att;
	}

	public function __SET($att, $v)
	{
		$this->$att=$v;
	}
}





?>