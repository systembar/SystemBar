<?php 

class Pedido
{
	private $id_pedido;
	private $fecha;
	private $num_mesa;
	private $responsable;
    private $total;


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