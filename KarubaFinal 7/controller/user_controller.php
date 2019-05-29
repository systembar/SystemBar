<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_user.php';
class User_Controller extends Conexion
{
	public function listar()
	{
		$datos=array();
		$consulta="SELECT u.cedula,u.nombre nombre,u.apellido,u.telefono,u.celular,u.foto,u.correo,tu.nombre tipo_usuario,td.nombre tipo_documento,u.estado,u.usuario,u.pass FROM tbl_usuario u join tbl_tipo_usuario tu on u.tipo_usuario=tu.id_tipoUsuario join tbl_tipo_documento td on u.tipo_documento=td.id_tipoDocumento WHERE tipo_usuario!='1' ORDER BY cedula DESC";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$usuario = new Usuario();
				$usuario->__SET('cedula',$datos->cedula);
				$usuario->__SET('nombre',$datos->nombre);
                $usuario->__SET('apellido',$datos->apellido);
                $usuario->__SET('telefono',$datos->telefono);
                $usuario->__SET('celular',$datos->celular);
                $usuario->__SET('foto',$datos->foto);
				$usuario->__SET('correo',$datos->correo);
                $usuario->__SET('tipo_usuario',$datos->tipo_usuario);
                $usuario->__SET('tipo_documento',$datos->tipo_documento);
                $usuario->__SET('estado',$datos->estado);
				$usuario->__SET('usuario',$datos->usuario);
				$usuario->__SET('pass',$datos->pass);
				$dato[]=$usuario;
                
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function insertar(Usuario $usuario)
	{
		$insertar="INSERT INTO tbl_usuario (cedula,nombre,apellido,telefono,celular,correo,foto,tipo_usuario,tipo_documento,estado,usuario,pass) values (?,?,?,?,?,?,?,?,?,?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$usuario->__GET('cedula'),
				$usuario->__GET('nombre'),
                $usuario->__GET('apellido'),
                $usuario->__GET('telefono'),
                $usuario->__GET('celular'),
				$usuario->__GET('correo'),
				$usuario->__GET('foto'),
                $usuario->__GET('tipo_usuario'),
                $usuario->__GET('tipo_documento'),
                $usuario->__GET('estado'),
				$usuario->__GET('usuario'),
				$usuario->__GET('pass')
			));
			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($cedula)
	{
		$buscar="SELECT u.cedula,u.nombre nombre,u.apellido,u.telefono,u.celular,u.foto,u.correo,tu.nombre tipo_usuario,td.nombre tipo_documento,u.estado,u.usuario,u.pass FROM tbl_usuario u join tbl_tipo_usuario tu on u.tipo_usuario=tu.id_tipoUsuario join tbl_tipo_documento td on u.tipo_documento=td.id_tipoDocumento WHERE u.cedula=?";
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
				$usuario->__SET('correo',$datos->correo);
                $usuario->__SET('tipo_usuario',$datos->tipo_usuario);
                $usuario->__SET('tipo_documento',$datos->tipo_documento);
                $usuario->__SET('estado',$datos->estado);
				$usuario->__SET('usuario',$datos->usuario);
				$usuario->__SET('pass',$datos->pass);
			return $usuario;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
	public function actualizar(Usuario $usuario)
	{
		$actualizar="UPDATE tbl_usuario SET nombre=?,apellido=?,telefono=?,celular=?,correo=?,foto=?,usuario=? where cedula=? ";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$usuario->__GET('nombre'),
                $usuario->__GET('apellido'),
                $usuario->__GET('telefono'),
                $usuario->__GET('celular'),
				$usuario->__GET('correo'),
				$usuario->__GET('foto'),
				$usuario->__GET('usuario'),
				$usuario->__GET('cedula')

      ));
      $session= $_SESSION['usuario'];

      $varsesion = $session->foto=$usuario->__GET('foto');
      $_SESSION['usuario']=$session;
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function CambiarEstado($cambio,$cedula)
	{
		$cambiar="UPDATE  tbl_usuario SET estado=? WHERE cedula=?";
		try {
			$this->conexion->prepare($cambiar)->execute(array($cambio,$cedula));
			return true;

		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
		}


	}
    
    
    
    	public function validar($id)
	{
		$consulta="select * from tbl_usuario where cedula=$id";
		try {
			$val=$this->conexion->prepare($consulta);
            $val->execute();
            $dato=$val->rowCount();
            return $dato;


		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
		}


	}
    
        public function cambiarContraseña($user,$pass){
        
       $cambiar="UPDATE  tbl_usuario SET pass='$pass' WHERE correo='$user'";
		try {
			$this->conexion->prepare($cambiar)->execute(array());
			return true;
            

		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
            
		} 
    }
    
    
     public function verificarU($correo){
        $consulta="SELECT * FROM tbl_usuario Where correo='$correo'";
        $resul=$this->conexion->prepare($consulta);
            $resul->execute();
            $dato=$resul->rowCount();
         if ($dato > 0){
                 $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $cod = '' ;
    
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 4);
            $codigo = time().$cod . $tmp;
            $i++;
        }
             $fechaRecuperacion = date("Y-m-d H:i:s", strtotime('+24 hours'));
            
            $cambiar="UPDATE  tbl_usuario SET RestablecerPass='$codigo',FechaRecuperacion='$fechaRecuperacion' WHERE correo='$correo'";
            $resul=$this->conexion->prepare($cambiar);
            $resul->execute();
            
             
              echo'<script type="text/javascript">
              swal({
  title: "RECUPERACION",
  text: "Se encontro una cuenta asociada a este correo!",
  type: "success",
  confirmButtonColor: "green",
  confirmButtonText: "OK!"
},
function(){
  window.location.href="../../view/gestion/mail.php?user='.$correo.'&code='.$codigo.'";
});
            </script>';
               
         } else {
             
               echo '<script type="text/javascript">
              swal({
  title: "Error",
  text: "Este correo no esta asociado a ninguna cuenta!",
  type: "warning",
  confirmButtonColor: "#ce3a1e",
  confirmButtonText: "ok!",
  closeOnConfirm: false
});
            </script>';
         }
        
        
    }
    
    
     public function newPassword($Code){
         
          $consulta="SELECT correo,RestablecerPass,FechaRecuperacion from tbl_usuario Where RestablecerPass='$Code'"; 
          $resul=$this->conexion->prepare($consulta);
          $resul->execute();
          $dato=$resul->rowCount();

            if ($dato > 0) {
                $datos=$resul->fetch(PDO::FETCH_ASSOC);
                $user = new Usuario();
                $user->__SET('RestablecerPass',$datos['RestablecerPass']);
                $user->__SET('correo',$datos['correo']);
                $user->__SET('FechaRecuperacion',$datos['FechaRecuperacion']);
                 $current = date("Y-m-d H:i:s");
                
                if (strtotime($current) > strtotime($user->__GET('FechaRecuperacion'))) {
                
               echo '<script type="text/javascript">
              swal({
  title: "Error con el codigo",
  text: "Este codigo ya expiro!",
  type: "warning",
  confirmButtonColor: "#ce3a1e",
  confirmButtonText: "ok!",
  closeOnConfirm: false
});
            </script>';
             
               
                   
         } else {
              echo'<script type="text/javascript">
              swal({
  title: "Codigo Correcto",
  text: "Puede restablecer su cuenta!",
  type: "success",
  confirmButtonColor: "green",
  confirmButtonText: "OK!"
},
function(){
  window.location.href="../gestion/nuevaContrasena.php?user='.$user->__GET('correo').'";
});
            </script>';
         }
         
         
     
    
          }
        }
    
      public function nueva($id,$cambio){
          $consulta="UPDATE tbl_usuario SET pass='$cambio' where cedula=$id "; 
          $this->conexion->prepare($consulta)->execute();
      }
         
     

    
}
	



?>