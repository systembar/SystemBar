
<?php

include '../../model/model_user.php';

class IniciarSesion extends Conexion
{
	
	//metodo iniciar sesion---------------------------------------------------------------
	public function iniciar($usuario,$pass)
	{	
                        session_start();

		$usu=$usuario;
		$password=$pass; 
		//preparamos la  consulta  para  verificar si el rol del usuario es correto
		$iniciar="SELECT tipo_usuario,cedula FROM tbl_usuario WHERE usuario='$usu' AND pass='$password' ";
    
		try {
			$resul=$this->conexion->prepare($iniciar);
			$resul->execute();
			$dato=$resul->rowCount();

			if ($dato > 0) {
				$datos=$resul->fetch(PDO::FETCH_ASSOC);
				$user= new Usuario();
                $user->__SET('tipo_usuario',$datos['tipo_usuario']);
                $user->__SET('cedula',$datos['cedula']);
                $perfil=$user->tipo_usuario;
                $_SESSION['usuario']=$user;

				
				switch ($perfil) {
					case '1':
						header("location:../user/listar.php");
						break;
				    case '2':
						header("location:../mesas/listar.php");
						break;
					default:
						echo "error al iniciar sesion";
						break;
				}
				
			}else{
                     echo'<script type="text/javascript">
                                  swal({
                      title: "Datos incorrectos",
                      text: "su usuario o contraseña son incorrectos!",
                      type: "warning",
                      confirmButtonColor: "#f76100",
                      confirmButtonText: "ok!",
                      closeOnConfirm: false
                    });
                                </script>';
                                }
			
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
    
}
