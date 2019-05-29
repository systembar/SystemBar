<?php 

class unidadMedida
{
	private $id_unidad_medida;
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