<?php 

class Categoria 
{
	private $id_categoria;
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