<?php 
include_once '../../model/conexion.php';
include_once '../../model/model_producto.php';
include_once '../../model/model_produc_pedi.php';
include_once '../../model/model_pedido.php';
include_once '../../model/model_detalleP.php';
include_once '../../model/model_mesa.php';
class Pedido_Controller extends Conexion
{
	public function listar()
	{
		$datos=array();
		$consulta="SELECT * FROM tbl_pedido ORDER BY id_pedido desc";
		//$consulta="SELECT p.id_pedido,p.fecha,p.num_mesa,p.total ,r.nombre from tbl_usuario r join tbl_pedido p on r.cedula=p.responsable ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new Pedido();
				$pedido->__SET('id_pedido',$datos->id_pedido);
				$pedido->__SET('fecha',$datos->fecha);
				$pedido->__SET('num_mesa',$datos->num_mesa);
				$pedido->__SET('estado',$datos->estado);
				$pedido->__SET('responsable',$datos->responsable);
				$pedido->__SET('total',$datos->total);
				$pedido->__SET('subtotal',$datos->subtotal);
				$pedido->__SET('descuento',$datos->descuento);
				$dato[]=$pedido;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
    public function listarp($id_pedido)
	{
		$datos=array();
		$consulta="select  p.nombre,p.precio,d.cantidad,d.precioAcumulado FROM tbl_dlle_producto_pedido d join tbl_producto p on d.id_producto=p.id_producto WHERE d.id_pedido=$id_pedido";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$detalle = new DetalleP();
				$detalle->__SET('nombre',$datos->nombre);
				$detalle->__SET('cantidad',$datos->cantidad);
				$detalle->__SET('precioAcumulado',$datos->precioAcumulado);
				$detalle->__SET('precio',$datos->precio);
				$dato[]=$detalle;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
    public function listarPro($id_pedido)
	{
		$datos=array();
		$consulta="SELECT * FROM tbl_dlle_producto_pedido where id=$id_pedido";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new Pedido();
				$pedido->__SET('id_pedido',$datos->id_pedido);
				$pedido->__SET('fecha',$datos->fecha);
				$pedido->__SET('num_mesa',$datos->num_mesa);
				$pedido->__SET('estado',$datos->estado);
				$pedido->__SET('responsable',$datos->responsable);
				$pedido->__SET('total',$datos->total);
				$dato[]=$pedido;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function insertar(Pedido $pedido,$total,$mesa)
	{
    /////////se consulta el estado de la mesa////////////
        $Estadomesa="select estado from tbl_mesa WHERE num_mesa=$mesa";
        $respuesta=$this->conexion->prepare($Estadomesa);
        $respuesta->execute();
        $r=$respuesta->fetch();
        
        
        
    /////////Si esta ocupada se realiza el pedido sobre el ultimo pedido realizado a esa mesa////////////
            if($r['estado']==0){
                $buscarId= "select max(id_pedido) id_pedido from tbl_pedido where num_mesa=$mesa";//id del pedido al cual se va ingresar
                   $buscarId= "select max(id_pedido) id_pedido from tbl_pedido";
            $resultado=$this->conexion->prepare($buscarId);
            $resultado->execute(); //id del pedido al cual se va ingresar
            $idUltimaVenta = 0; //inicializar variable para almacenar el id
            while ($fila=$resultado->fetch(PDO::FETCH_ASSOC)) {
                     $idUltimaVenta=$fila['id_pedido'] ;
                        }// toma el id y lo asigna a la varible inicializada
                foreach($_SESSION["carrito"] as $p){
                $query="insert into tbl_dlle_producto_pedido (id_producto,id_pedido,cantidad,precioAcumulado) values(
                '".$p->__GET("id_producto")."',
                '".$idUltimaVenta."',
                '".$p->__GET("cantidad")."',
                '".$p->__GET("subTotal")."')";      
                $this->conexion->prepare($query)->execute(); // se agrega productos al pedido
            
            }
                $consulto="SELECT total FROM tbl_pedido WHERE id_pedido=$idUltimaVenta";
                $resulto=$this->conexion->prepare($consulto);
                $resulto->execute();
                $totalP=$resulto->fetch();
                $nuevoTotal=$totalP['total']+$total;
            echo $nuevoTotal;
                $actualizarT="UPDATE tbl_pedido SET total=$nuevoTotal WHERE id_pedido=$idUltimaVenta";
                $this->conexion->prepare($actualizarT)->execute();
            }
        
        /////////Si esta disponible se realiza un nuevo pedido ////////////
        else  if($r['estado']==1){
            $insertarP="INSERT INTO tbl_pedido (id_pedido,num_mesa,responsable,descuento,subtotal,total,estado) values (?,?,?,?,?,$total,1)";
            $this->conexion->prepare($insertarP)->execute(array(
				$pedido->__GET('id_pedido'),
				$pedido->__GET('num_mesa'),
				$pedido->__GET('responsable'),
				$pedido->__GET('descuento'),
				$pedido->__GET('subtotal'),
                	)); // creaamos nuevo pedido
            $buscarId2= "select max(id_pedido) id_pedido from tbl_pedido";
            $resultado=$this->conexion->prepare($buscarId2);
            $resultado->execute(); //id del pedido al cual se va ingresar
            $idUltimaVenta = 0; //inicializar variable para almacenar el id
            while ($fila=$resultado->fetch(PDO::FETCH_ASSOC)) {
                     $idUltimaVenta=$fila['id_pedido'] ;
                        }// toma el id y lo asigna a la varible inicializada
                foreach($_SESSION["carrito"] as $p){
                $query="insert into tbl_dlle_producto_pedido (id_producto,id_pedido,cantidad,precioAcumulado) values(
                '".$p->__GET("id_producto")."',
                '".$idUltimaVenta."',
                '".$p->__GET("cantidad")."',
                '".$p->__GET("subTotal")."')";      
                $this->conexion->prepare($query)->execute(); // se agrega productos al pedido
            }
                $cambiarEstado="UPDATE  tbl_mesa SET estado=0 WHERE num_mesa=$mesa";
                $resultado2=$this->conexion->prepare($cambiarEstado);
                $resultado2->execute();
            
                
                
                
                
            }
        
        
            }
    public function insertar_productos(Detalle $producto)
	{
     $insertar="INSERT INTO tbl_dlle_producto_pedido (id,id_producto,id_pedido,cantidad) values (?,?,?,?)";
		try {
			$this->conexion->prepare($insertar)->execute(array(
				$producto->__GET('id'),
				$producto->__GET('id_producto'),
				$producto->__GET('id_pedido'),
                $producto->__GET('cantidad'),
            ));
			return true;
		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}
	public function buscar($id_pedido)
	{
		$buscar=" SELECT * FROM tbl_pedido where id_pedido=?";
		try {
			$resultado=$this->conexion->prepare($buscar);
			$resultado->execute(array($id));
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			$pedido= new pedido();
            $pedido->__SET('id_pedido',$datos->id_pedido);
            $pedido->__SET('fecha',$datos->fecha);
            $pedido->__SET('num_mesa',$datos->num_mesa);
            $pedido->__SET('responsable',$datos->responsable);
			return $pedido;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
    	public function CambiarEstado($cambio,$id_pedido)
	{
		$cambiar="UPDATE  tbl_pedido SET estado=? WHERE id_pedido=?";
		try {
			$this->conexion->prepare($cambiar)->execute(array($cambio,$id_pedido));
			return true;
		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
		}
	}
}
?>