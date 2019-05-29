<?php 

class DetalleMesa 
{
	private $id;
	private $id_mesa;
	private $id_pedido;

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