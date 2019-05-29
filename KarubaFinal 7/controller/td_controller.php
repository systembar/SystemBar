<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_td.php';
class td_Controller extends Conexion
{
	public function ListarDatos()
	{
		$datos=array();
		$consulta="SELECT * FROM tbl_tipo_documento ORDER BY id_tipoDocumento ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$td = new TipoDocumento();
				$td->__SET('id_tipoDocumento',$datos->id_tipoDocumento);
				$td->__SET('nombre',$datos->nombre);

				$dato[]=$td;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function insertar(TipoDocumento $TipoDocumento )
	{
		$insertar="INSERT INTO tbl_tipo_documento (id_tipoDocumento,nombre) values (?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$TipoDocumento->__GET('id_tipoDocumento'),
				$TipoDocumento->__GET('nombre')
			));

			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($cedula)
	{
		$buscar="SELECT * FROM usuario where cedula=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($cedula));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$usuario= new Usuario();
			$usuario->__SET('cedula',$datos->cedula);
				$usuario->__SET('nombre',$datos->nombre);
                $usuario->__SET('apellido',$datos->apellido);
                $usuario->__SET('telefono',$datos->telefono);
                $usuario->__SET('celular',$datos->celular);
                $usuario->__SET('foto',$datos->foto);
				$usuario->__SET('coreo',$datos->correo);
                $usuario->__SET('tipo_usuario',$datos->tipo_usuario);
                $usuario->__SET('tipo_documento',$datos->tipo_documento);
				$usuario->__SET('usuario',$datos->usuario);
				$usuario->__SET('pass',$datos->pass);
			return $usuario;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(Usuario $usuario)
	{
		$actualizar="UPDATE usuario SET nombre=?,apellido=?,telefono=?,celular=?,foto=?,correo=?,usuario=?,pass=? where cedula=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$usuario->__GET('nombre'),
                $usuario->__GET('apellido'),
                $usuario->__GET('telefono'),
                $usuario->__GET('celular'),
                $usuario->__GET('foto'),
				$usuario->__GET('correo'),
				$usuario->__GET('usuario'),
				$usuario->__GET('pass'),
				$usuario->__GET('cedula')

			));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function eliminar($cedula)
	{
		$borrar="DELETE  FROM usuarios WHERE Cedula=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($cedula));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}


	}

	
    

}
	



?>