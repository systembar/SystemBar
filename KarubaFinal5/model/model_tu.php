<?php 

class TipoUsuario 
{
	private $id_tipoUsuario;
	private $nombre;

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