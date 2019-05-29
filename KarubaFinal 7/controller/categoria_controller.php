<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_categoria.php';
class Categoria_Controller extends Conexion
{
	public function ListarDatos()
	{
		$datos=array();
		$consulta="SELECT * FROM tbl_categoria ORDER BY id_categoria ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$categoria = new Categoria();
				$categoria->__SET('id_categoria',$datos->id_categoria);
				$categoria->__SET('nombre',$datos->nombre);

				$dato[]=$categoria;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function insertar(Categoria $categoria)
	{
		$insertar="INSERT INTO tbl_categoria (id_categoria,nombre) values (?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$categoria->__GET('id_categoria'),
				$categoria->__GET('nombre')
			));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($id_categoria)
	{
		$buscar="SELECT * FROM tbl_categoria where id_categoria=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($id_categoria));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$categoria= new Categoria();
			$categoria->__SET('id_categoria',$datos->id_categoria);
			$categoria->__SET('nombre',$datos->nombre);
			return $categoria;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(Categoria $categoria)
	{
		$actualizar="UPDATE tbl_categoria SET nombre=? where id_categoria=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$categoria->__GET('nombre'),
				$categoria->__GET('id_categoria')

			));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}  

}
	



?>