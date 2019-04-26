<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_producto.php';
class Producto_Controller extends Conexion
{
	public function listar()
	{
		$datos=array();
        	$consulta="SELECT * FROM tbl_producto";

		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$producto = new Producto();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre',$datos->nombre);
				$producto->__SET('precio',$datos->precio);
				$producto->__SET('foto',$datos->foto);
				$producto->__SET('estado',$datos->estado);
				$dato[]=$producto;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
    
    public function listarP()
	{
		$datos=array();
        	$consulta="SELECT * FROM tbl_producto WHERE estado=1";

		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$producto = new Producto();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre',$datos->nombre);
				$producto->__SET('precio',$datos->precio);
				$producto->__SET('foto',$datos->foto);
				$producto->__SET('estado',$datos->estado);
				$dato[]=$producto;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function insertar(Producto $producto)
	{
        $insertar="INSERT INTO tbl_producto (id_producto,nombre, precio, foto, estado) values (?,?,?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$producto->__GET('id_producto'),
				$producto->__GET('nombre'),
				$producto->__GET('precio'),
				$producto->__GET('foto'),
				$producto->__GET('estado')
			));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}

public function actualizar(Producto $producto)
	{
		$actualizar="UPDATE tbl_producto SET nombre= ?, precio = ?, foto = ?, estado = ? where id_producto=?";
	try {
			$this->conexion->prepare($actualizar)->execute(array(
				$producto->__GET('nombre'),
				$producto->__GET('precio'),
				$producto->__GET('foto'),
				$producto->__GET('estado'),
				$producto->__GET('id_producto')
			));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}


	public function buscar($id_producto)
	{
        $buscar="SELECT * FROM tbl_producto where id_producto=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($id_producto));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$producto= new Producto();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre',$datos->nombre);
				$producto->__SET('precio',$datos->precio);
				$producto->__SET('foto',$datos->foto);
				$producto->__SET('estado',$datos->estado);
			return $producto;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}

	public function eliminar($id_producto)
	{
		$borrar="DELETE FROM tbl_producto WHERE id_producto=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($id_producto));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}

}
	public function CambiarEstado($cambio,$id_producto)
	{
		$cambiar="UPDATE  tbl_producto SET estado=? WHERE id_producto=?";
		try {
			$this->conexion->prepare($cambiar)->execute(array($cambio,$id_producto));
			return true;

		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
		}


	}
    

}

?>