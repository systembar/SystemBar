<?php 

class Pedido
{
	private $id_pedido;
	private $fecha;
	private $responsable;
    private $total;
    private $subtotal;
    private $descuento;


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