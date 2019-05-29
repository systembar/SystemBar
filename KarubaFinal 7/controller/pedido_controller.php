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
		$consulta="SELECT pe.id_pedido,pe.fecha ,pe.estado,r.nombre responsable,pe.total,pe.descuento,pe.subtotal FROM tbl_pedido pe join  tbl_usuario r on pe.responsable=r.cedula ORDER BY id_pedido desc";
	
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new Pedido();
				$pedido->__SET('id_pedido',$datos->id_pedido);
				$pedido->__SET('fecha',$datos->fecha);
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
    
    public function listarBarman()
	{
		$datos=array();
		$consulta="SELECT pe.id_pedido,pe.fecha, pe.estado,r.nombre responsable,pe.total,pe.descuento,pe.subtotal FROM tbl_pedido pe join  tbl_usuario r on pe.responsable=r.cedula where pe.estado=1 ORDER BY pe.id_pedido desc";
		//$consulta="SELECT p.id_pedido,p.fecha,p.num_mesa,p.total ,r.nombre from tbl_usuario r join tbl_pedido p on r.cedula=p.responsable ";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new Pedido();
				$pedido->__SET('id_pedido',$datos->id_pedido);
				$pedido->__SET('fecha',$datos->fecha);
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
		$consulta="select um.nombre as unidadMedida,p.nombre,p.precio,sum(d.cantidad) as cantidad,sum(d.precioAcumulado)as precioAcumulado FROM tbl_dlle_producto_pedido d join tbl_producto p on d.id_producto=p.id_producto join tbl_pedido pe on d.id_pedido=pe.id_pedido join tbl_unidad_de_medida um on p.unidadMedida=um.id_unidad_medida WHERE d.id_pedido=$id_pedido GROUP  BY p.id_producto";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$detalle = new DetalleP();
				$detalle->__SET('nombre',$datos->nombre);
				$detalle->__SET('cantidad',$datos->cantidad);
				$detalle->__SET('precioAcumulado',$datos->precioAcumulado);
				$detalle->__SET('precio',$datos->precio);
				$detalle->__SET('unidadMedida',$datos->unidadMedida);
				
				$dato[]=$detalle;
			}
			return $dato;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
    
    public function listarp2($id_pedido)
    {
        $datos=array();
		$consulta="SELECT total,descuento,subtotal FROM tbl_pedido WHERE id_pedido=$id_pedido";
		try {
			$resultado=$this->conexion->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$pedido = new Pedido();
				$pedido->__SET('total',$datos->total);
				$pedido->__SET('descuento',$datos->descuento);
				$pedido->__SET('subtotal',$datos->subtotal);
			
				$dato[]=$pedido;
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
    
    
    public function addItem($cantidad,$id_producto,$precio,$id_pedido,$subtotal)
    {
        $consulta="SELECT id_producto from tbl_dlle_producto_pedido where id_producto=$id_producto and id_pedido=(select id_pedido where id_pedido=$id_pedido)";
        $respuesta=$this->conexion->prepare($consulta);
        $respuesta->execute();
        $dato=$respuesta->rowCount();
        if($dato==1){
           
           $consulta2="SELECT cantidad, precioAcumulado from tbl_dlle_producto_pedido where id_pedido=$id_pedido and id_producto=(SELECT id_producto WHERE id_producto=$id_producto)";
            $respuesta2=$this->conexion->prepare($consulta2);
            $respuesta2->execute();
            $e=$respuesta2->fetch(PDO::FETCH_ASSOC);
  /*           echo '
            <script>
                        alert("'.$e['cantidad'].'");

            </script>
        ';*/
            $ncant=$e["cantidad"]+$cantidad;
            $nsub=$e["precioAcumulado"]+$subtotal;
            
            $actualizar="UPDATE  tbl_dlle_producto_pedido SET cantidad=$ncant,precioAcumulado=$nsub where id_pedido=$id_pedido and id_producto=(SELECT id_producto WHERE id_producto=$id_producto)";
            $this->conexion->prepare($actualizar)->execute();
            
            $consulta5="SELECT SUM(precioAcumulado) as precioAcumulado FROM tbl_dlle_producto_pedido where id_pedido=$id_pedido";
            $respuesta5=$this->conexion->prepare($consulta5);
            $respuesta5->execute();
            $t=$respuesta5->fetch(PDO::FETCH_ASSOC);
            $desc="SELECT descuento FROM tbl_pedido where id_pedido=$id_pedido";
            $re=$this->conexion->prepare($desc);
            $re->execute();
            $d=$re->fetch(PDO::FETCH_ASSOC);
            
            $total=($t['precioAcumulado'])-($d['descuento']);
            $subtotal2=$t['precioAcumulado'];
            
            $nuevosd="UPDATE tbl_pedido SET total=$total,subtotal=$subtotal2 where id_pedido=$id_pedido";
            $resul=$this->conexion->prepare($nuevosd)->execute();
            

        }else{
            $consulta4="insert into tbl_dlle_producto_pedido (id_producto,id_pedido,cantidad,precioAcumulado) values($id_producto,$id_pedido,$cantidad,$subtotal)";
            $this->conexion->prepare($consulta4)->execute();
            
             $consulta5="SELECT SUM(precioAcumulado) as precioAcumulado FROM tbl_dlle_producto_pedido where id_pedido=$id_pedido";
            $respuesta5=$this->conexion->prepare($consulta5);
            $respuesta5->execute();
            $t=$respuesta5->fetch(PDO::FETCH_ASSOC);
            $desc="SELECT descuento FROM tbl_pedido where id_pedido=$id_pedido";
            $re=$this->conexion->prepare($desc);
            $re->execute();
            $d=$re->fetch(PDO::FETCH_ASSOC);
            
            $total=($t['precioAcumulado'])-($d['descuento']);
            $subtotal2=$t['precioAcumulado'];
            
            $nuevosd="UPDATE tbl_pedido SET total=$total,subtotal=$subtotal2 where id_pedido=$id_pedido";
            $resul=$this->conexion->prepare($nuevosd)->execute();
            
            

        }
        
        
    }
    
	public function insertar(Pedido $pedido,$mesa,$total)
	{
   
        
        /////////////////////// creaamos nuevo pedido//////////////////
       
            $insertarP="INSERT INTO tbl_pedido (id_pedido,responsable,subtotal,total,estado) values (?,?,?,?,1)";
            $this->conexion->prepare($insertarP)->execute(array(
				$pedido->__GET('id_pedido'),
				$pedido->__GET('responsable'),
				$pedido->__GET('subtotal'),
				$pedido->__GET('subtotal'),
                	)); 
        
        /////////////////////// buscamos el ultimo id //////////////////
          $buscarId= "select max(id_pedido) id_pedido from tbl_pedido ";//id del pedido al cual se va ingresar
            $resultado=$this->conexion->prepare($buscarId);
            $resultado->execute(); //id del pedido al cual se va ingresar
            $idUltimaVenta = 0; //inicializar variable para almacenar el id
            while ($fila=$resultado->fetch(PDO::FETCH_ASSOC)) {
                     $idUltimaVenta=$fila['id_pedido'] ;
                        }// toma el id y lo asigna a la varible inicializada
        
          /////////////////////// Asignamos las mesas pedido//////////////////
        
            foreach($mesa as $m){
                $Mesas="INSERT INTO tbl_dlle_pedido_mesa (id_pedido,num_mesa) values ($idUltimaVenta,$m)";
                $this->conexion->prepare($Mesas)->execute();
            } 

                foreach($_SESSION["carrito"] as $p){
                $query="insert into tbl_dlle_producto_pedido (id_producto,id_pedido,cantidad,precioAcumulado) values(
                '".$p->__GET("id_producto")."',
                '".$idUltimaVenta."',
                '".$p->__GET("cantidad")."',
                '".$p->__GET("subTotal")."')";      
                $this->conexion->prepare($query)->execute(); // se agrega productos al pedido
            }
        foreach($mesa as $m){
                $mod="UPDATE tbl_mesa SET estado=0 WHERE num_mesa=$m";
                $this->conexion->prepare($mod)->execute();
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
            $pedido->__SET('responsable',$datos->responsable);
			return $pedido;
		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}
    	public function CambiarEstado($cambio,$id_pedido)
	{
		$cambiar="UPDATE  tbl_pedido SET estado=? WHERE id_pedido=?";
        $mesa="SELECT num_mesa FROM tbl_dlle_pedido_mesa WHERE id_pedido=$id_pedido";
        $m=$this->conexion->prepare($mesa);
        $m->execute();
      
             while ($fila=$m->fetch(PDO::FETCH_ASSOC)) {
                 $me=$fila['num_mesa'] ;
                 $mes="UPDATE  tbl_mesa SET estado=1 WHERE num_mesa=$me";
            $this->conexion->prepare($mes)->execute();
             }
			
		try {
			$this->conexion->prepare($cambiar)->execute(array($cambio,$id_pedido));
			return true;
		} catch (Exception $e) {
			echo "error al cambiar estado".$e->getMessage();
		}
	}
    
    public function Notificaciones()
    {
     
        $notificaciones="SELECT * from tbl_pedido where estado=1";
        $Npedido=$this->conexion->prepare($notificaciones);
        $Npedido->execute();
        $n=$Npedido->fetchAll();
        $noti=count($n);
        return $noti;
    
    }
    
    public function Reporte($id_pedido)
    {
        $consulta="select p.id_pedido, u.nombre,u.apellido, p.total, p.descuento, p.subtotal  from tbl_pedido p join tbl_usuario u on p.responsable=u.cedula where id_pedido=$id_pedido ";
        $resultado=$this->conexion->prepare($consulta);
        $resultado->execute();
        
        return $resultado;
    }
    
        public function ReporteP($id_pedido)
    {
        $consultaP="SELECT p.nombre, p.precio ,SUM(d.cantidad) as cantidad, d.precioAcumulado FROM tbl_dlle_producto_pedido d join tbl_producto p on d.id_producto = p.id_producto WHERE d.id_pedido=$id_pedido GROUP by p.id_producto";
        $resultadoP=$this->conexion->prepare($consultaP);
        $resultadoP->execute();
        
        return $resultadoP;
    }
    
    
        public function Descuento($descuento,$id_pedido)
        {
        $consulta="SELECT subtotal from tbl_pedido WHERE id_pedido=$id_pedido ";
        $resultado=$this->conexion->prepare($consulta);
        $resultado->execute();
        $subt=$resultado->fetch();  //se consulta el total del pedido al que se hara descuento
        $total=$subt['subtotal']-$descuento;
        $consulta3="UPDATE tbl_pedido SET total=$total WHERE id_pedido=$id_pedido ";
        $this->conexion->prepare($consulta3)->execute();   
        $consulta2="UPDATE tbl_pedido SET descuento=$descuento WHERE id_pedido=$id_pedido ";
        $this->conexion->prepare($consulta2)->execute(); 
         
         
       

           
        }
    
}
?>