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
    	
        //Como se tiene un solo formulario no es necesario un switch para cargarlo:
        $this->ruta=$this->miConfigurador->getVariableConfiguracion("rutaBloque");
        
        if(isset($_REQUEST['opcion'])){
          
               if($_REQUEST['contraseña'] == 'millos'){
                    $_REQUEST['opcion']="mostrar";
               }
               else{  
                  $_REQUEST['opcion']="no";
               }
              
              switch ($_REQUEST['opcion']){
        		case "mostrar":
        			include_once ($this->ruta . "/formulario/contenidoCentral.php");
        			break;
                        case "personaNatural":
        			include_once ($this->ruta . "/formulario/personaNatural.php");
        			break;      
                        case "no":
        			include_once ($this->ruta . "/formulario/contenido.php");
        			break;        
                        default :
                                include_once ($this->ruta . "/formulario/contenido.php");
                                break;
        	}
                
        }else{
        	include_once ($this->ruta . "/formulario/contenido.php");
        }
       
    }

}
?>
