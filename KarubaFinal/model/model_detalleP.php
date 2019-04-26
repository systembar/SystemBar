<?php 

class DetalleP
{
	private $id;
	private $nombre;
	private $cantidad;
	private $precioAcumulado;
	private $precio;


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