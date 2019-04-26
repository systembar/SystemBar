<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_mesa.php';
class Mesa_Controller extends Conexion
{
	public function listar()
	{
		$datos=array();
		$consulta="SELECT * FROM tbl_mesa ORDER BY num_mesa ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$mesa = new Mesa();
				$mesa->__SET('num_mesa',$datos->num_mesa);
				$mesa->__SET('nombre',$datos->nombre);
                $mesa->__SET('estado',$datos->estado);
				$dato[]=$mesa;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function insertar(Mesa $mesa)
	{
		$insertar="INSERT INTO tbl_mesa (num_mesa,nombre,estado) values (?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$mesa->__GET('num_mesa'),
				$mesa->__GET('nombre'),
                $mesa->__GET('estado')
			));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($num_mesa)
	{
		$buscar="SELECT * FROM tbl_mesa where num_mesa=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($num_mesa));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$mesa= new Mesa();
			    $mesa->__SET('num_mesa',$datos->num_mesa);
				$mesa->__SET('nombre',$datos->nombre);
                $mesa->__SET('estado',$datos->estado);
			return $mesa;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(Mesa $mesa)
	{
		$actualizar="UPDATE tbl_mesa SET nombre=?,estado=? where num_mesa=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$mesa->__GET('nombre'),
				$mesa->__GET('estado'),
				$mesa->__GET('num_mesa')

			));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function eliminar($num_mesa)
	{
		$borrar="DELETE  FROM tbl_mesa WHERE num_mesa=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($num_mesa));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}


	}
    
    	public function CambiarEstado($cambio,$num_mesa)
	{
		$cambiar="UPDATE  tbl_mesa SET estado=? WHERE num_mesa=?";
		try {
			$this->conexion->prepare($cambiar)->execute(array($cambio,$num_mesa));
			return true;

		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
		}


	}
    
    
   

	
    

}
	



?>