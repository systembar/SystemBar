<?php 

class Producto 
{
	private $id_producto;
	private $nombre;
	private $precio;
	private $foto;
	private $estado;
	private $categoria;
	private $cantidad;
	private $subTotal;
	private $unidadMedida;


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