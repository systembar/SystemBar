<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_producto.php';
class Producto_Controller extends Conexion
{
	public function listar()
	{
		$datos=array();
        	$consulta="SELECT pro.id_producto,pro.nombre,pro.precio,pro.foto,pro.estado,ca.nombre as categoria,u.nombre as unidadMedida FROM tbl_producto pro join tbl_categoria ca on pro.categoria=ca.id_categoria join tbl_unidad_de_medida u on pro.unidadMedida=u.id_unidad_medida ORDER BY id_producto desc" ;

		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$producto = new Producto();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre',$datos->nombre);
				$producto->__SET('precio',$datos->precio);
				$producto->__SET('categoria',$datos->categoria);
				$producto->__SET('foto',$datos->foto);
				$producto->__SET('estado',$datos->estado);
				$producto->__SET('unidadMedida',$datos->unidadMedida);
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
        	$consulta="SELECT pro.id_producto,pro.nombre,pro.precio,pro.foto,pro.estado,pro.categoria,u.nombre as unidadMedida FROM tbl_producto pro join tbl_unidad_de_medida u on pro.unidadMedida = u.id_unidad_medida WHERE estado=1";

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
				$producto->__SET('categoria',$datos->categoria);
				$producto->__SET('unidadMedida',$datos->unidadMedida);
				$dato[]=$producto;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function insertar(Producto $producto)
	{
        $insertar="INSERT INTO tbl_producto (id_producto,nombre, precio,categoria, foto, estado,unidadMedida) values (?,?,?,?,?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$producto->__GET('id_producto'),
				$producto->__GET('nombre'),
				$producto->__GET('precio'),
				$producto->__GET('categoria'),
				$producto->__GET('foto'),
				$producto->__GET('estado'),
				$producto->__GET('unidadMedida')
			));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}

public function actualizar(Producto $producto)
	{
		$actualizar="UPDATE tbl_producto SET nombre= ?, precio = ?, estado = ?,foto=?, categoria=?,unidadMedida=? where id_producto=?";
	try {
			$this->conexion->prepare($actualizar)->execute(array(
				$producto->__GET('nombre'),
				$producto->__GET('precio'),
				$producto->__GET('estado'),
				$producto->__GET('foto'),
				$producto->__GET('categoria'),
				$producto->__GET('unidadMedida'),
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
				$producto->__SET('categoria',$datos->categoria);
				$producto->__SET('unidadMedida',$datos->unidadMedida);
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