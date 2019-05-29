<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_unidadMedida.php';
class unidadMedida_Controller extends Conexion
{
	public function ListarDatos()
	{
		$datos=array();
		$consulta="SELECT * FROM tbl_unidad_de_medida ORDER BY id_unidad_medida ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$unidadMedida = new unidadMedida();
				$unidadMedida->__SET('id_unidad_medida',$datos->id_unidad_medida);
				$unidadMedida->__SET('nombre',$datos->nombre);

				$dato[]=$unidadMedida;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function insertar(unidadMedida $unidadMedida)
	{
		$insertar="INSERT INTO tbl_unidad_de_medida (id_unidad_medida,nombre) values (?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$unidadMedida->__GET('id_unidad_medida'),
				$unidadMedida->__GET('nombre')
			));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($id_unidad_medida)
	{
		$buscar="SELECT * FROM tbl_unidad_de_medida where id_unidad_medida=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array(id_unidad_medida));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$unidadMedida = new unidadMedida();
			$unidadMedida->__SET('id_unidad_medida',$datos->id_unidad_medida);
			$unidadMedida->__SET('nombre',$datos->nombre);
			return $unidadMedida;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(unidadMedida $unidadMedida)
	{
		$actualizar="UPDATE tbl_unidad_de_medida SET nombre=? where id_unidad_medida=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$categoria->__GET('nombre'),
				$categoria->__GET('id_unidad_medida')

			));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}  

}
	



?>