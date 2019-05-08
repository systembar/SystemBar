<?php 

class Detalle 
{
	private $id;
	private $id_producto;
	private $id_pedido;
	private $cantidad;
	private $precioAcumulado;


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