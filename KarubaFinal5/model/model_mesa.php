<?php 

class Mesa 
{
	private $num_mesa;
	private $nombre;
	private $estado;


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