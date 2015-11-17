<?

namespace bloquesModelo\bloqueIndex;

if (! isset ( $GLOBALS ["autorizado"] )) {
    include ("../index.php");
    exit ();
}

include_once ("core/manager/Configurador.class.php");

class Frontera {
    
    var $ruta;
    var $sql;
    var $funcion;
    var $lenguaje;
    var $miFormulario;
    
    var 

    $miConfigurador;
    
    function __construct() {
        
        $this->miConfigurador = \Configurador::singleton ();
    
    }
    
    public function setRuta($unaRuta) {
        $this->ruta = $unaRuta;
    }
    
    public function setLenguaje($lenguaje) {
        $this->lenguaje = $lenguaje;
    }
    
    public function setFormulario($formulario) {
        $this->miFormulario = $formulario;
    }
    
    function frontera() {
        $this->html ();
    }
    
    function setSql($a) {
        $this->sql = $a;
    
    }
    
    function setFuncion($funcion) {
        $this->funcion = $funcion;
    
    }
    
    function html() {
    	
        //conexion a la BD para validacion inicio de sesion
        $this->ruta=$this->miConfigurador->getVariableConfiguracion("rutaBloque");
        $conexion='estructura';
        $esteRecurso=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        
        
        if(isset($_REQUEST['opcion'])){
            
                $auxiliar = $this->sql->getCadenaSql("buscarRegistroxUsuario");
                $matrizItems=$esteRecurso->ejecutarAcceso($auxiliar, "busqueda");
                //si no esta vacia
                if(!empty($matrizItems)){
                    
                    $_REQUEST['opcion']='ingresa';
                }
                else{
                   
                    $_REQUEST['opcion']='accesoDenegado';
                    
                }
             
                switch ($_REQUEST['opcion']){
                    
        		case "ingresa":
        			include_once ($this->ruta . "/formulario/tabla.php");
        			break;
                        case "accesoDenegado":
                                
        			include_once ($this->ruta . "/formulario/contenido.php");
        		break;    
        	}
        }
         
        else{
        	include_once ($this->ruta . "/formulario/contenido.php");
        }
       
    }

}
?>
