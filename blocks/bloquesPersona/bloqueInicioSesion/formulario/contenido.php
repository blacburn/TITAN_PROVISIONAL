<?php 
namespace bloquesModelo\bloqueIndex\formulario;

if(!isset($GLOBALS["autorizado"])) {
	include("../index.php");
	exit;
}


class Formulario {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;

    function __construct($lenguaje, $formulario, $sql) {

        $this->miConfigurador = \Configurador::singleton ();

        $this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );

        $this->lenguaje = $lenguaje;

        $this->miFormulario = $formulario;
        
        $this->miSql=$sql;

    }

    function formulario() {

        /**
         * IMPORTANTE: Este formulario está utilizando jquery.
         * Por tanto en el archivo ready.php se delaran algunas funciones js
         * que lo complementan.
         */

        // Rescatar los datos de este bloque
        $esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		 
		$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );
		 
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
		$rutaBloque .= $esteBloque ['grupo'] . '/' . $esteBloque ['nombre'];
        
                $esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );

        // ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
        /**
        * Atributos que deben ser aplicados a todos los controles de este formulario.
        * Se utiliza un arreglo
        * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
        *
        * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
        * $atributos= array_merge($atributos,$atributosGlobales);
        */
        $atributosGlobales ['campoSeguro'] = 'true';
        $_REQUEST['tiempo']=time();
        
        $conexion='estructura';
        $esteRecurso=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
       	
        //var_dump($esteRecurso);
       	//exit;
        
     
        // -------------------------------------------------------------------------------------------------

        // ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
        $esteCampo = $esteBloque ['nombre'];
        $atributos ['id'] = $esteCampo;
        $atributos ['nombre'] = $esteCampo;
        
        // Si no se coloca, entonces toma el valor predeterminado 'application/x-www-contenido-urlencoded'
        $atributos ['tipoFormulario'] = '';
        
        // Si no se coloca, entonces toma el valor predeterminado 'POST'
        $atributos ['metodo'] = 'POST';
        
        // Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
        $atributos ['action'] = 'index.php';
        $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
        
        // Si no se coloca, entonces toma el valor predeterminado.
        $atributos ['estilo'] = '';
        $atributos ['marco'] = true;
        $tab = 1;
        // ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------

        // ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
                    $atributos ['tipoEtiqueta'] = 'inicio';
                    echo $this->miFormulario->formulario ( $atributos );

                    // ---------------- SECCION: Controles del Formulario -----------------------------------------------
                            $atributos ["id"] = "ImagenCentral";
                            echo $this->miFormulario->division("inicio", $atributos);
                            unset($atributos);
                           
	        
		        // ---------------- CONTROL: Imagen --------------------------------------------------------
		       $atributos ["id"] = "cuadros";
echo $this->miFormulario->division("inicio", $atributos);
unset($atributos);

$atributos ["id"] = "titulo";
echo $this->miFormulario->division("inicio", $atributos);
unset($atributos);
$esteCampo = 'BIENVENIDO';
$atributos ["id"] = $esteCampo;
$atributos ["estilo"] = $esteCampo;
$atributos ['columnas'] = 1;
$atributos ["estilo"] = $esteCampo;
$atributos ['texto'] = 'BIENVENIDO '; // Aqui se deberealizar la consulta  para mostrar el usuario del sistema.
$atributos ['tabIndex'] = $tab++;
echo $this->miFormulario->campoTexto($atributos);
unset($atributos);
  echo $this->miFormulario->division ( "fin" );

                        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                        $esteCampo = 'usuario';
                        $atributos ['id'] = $esteCampo;
                        $atributos ['nombre'] = $esteCampo;
                        $atributos ['tipo'] = 'text';
                        $atributos ['estilo'] = 'jqueryui';
                        $atributos ['marco'] = false;
                        $atributos ['columnas'] = 1;
                        $atributos ['obligatorio'] = true;
                        $atributos ['etiquetaObligatorio'] = true;
                        $atributos ['dobleLinea'] = false;
                        $atributos ['tabIndex'] = $tab;
                        $atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
                        $atributos ['validar'] = 'required';

                        if (isset ( $_REQUEST [$esteCampo] )) {
                                $atributos ['valor'] = $_REQUEST [$esteCampo];
                        } else {
                                $atributos ['valor'] = '';
                        }
                        $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
                        $atributos ['deshabilitado'] = false;
                        $atributos ['tamanno'] = 25;
                        $atributos ['maximoTamanno'] = '';
                        $tab ++;

                        // Aplica atributos globales al control
                        $atributos = array_merge ( $atributos, $atributosGlobales );
                        echo $this->miFormulario->campoCuadroTexto ( $atributos );
                        // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------

                        // ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
                        $esteCampo = 'contraseña';
                        $atributos ['id'] = $esteCampo;
                        $atributos ['nombre'] = $esteCampo;
                        $atributos ['tipo'] = 'password';
                        $atributos ['estilo'] = 'jqueryui';
                        $atributos ['marco'] = false;
                        $atributos ['columnas'] = 1;
                        $atributos ['dobleLinea'] = false;
                        $atributos ['tabIndex'] = $tab;
                        $atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
                        $atributos ['validar'] = 'required';
                        $atributos ['obligatorio'] = true;
                        $atributos ['etiquetaObligatorio'] = true;

                        if (isset ( $_REQUEST [$esteCampo] )) {
                            $atributos ['valor'] = $_REQUEST [$esteCampo];
                        } else {
                            $atributos ['valor'] = '';
                        }
                        $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
                        $atributos ['deshabilitado'] = false;
                        $atributos ['tamanno'] = 25;
                        $atributos ['maximoTamanno'] = '';
                        $tab ++;

                        // Aplica atributos globales al control
                        $atributos = array_merge ( $atributos, $atributosGlobales );
                        echo $this->miFormulario->campoCuadroTexto ( $atributos );
                        // --------------- FIN CONTROL : Cuadro de Texto --------------------------------------------------

                        // ------------------Division para los botones-------------------------
                        $atributos ["id"] = "botones";
                        $atributos ["estilo"] = "marcoBotones";
                        echo $this->miFormulario->division ( "inicio", $atributos );

                        // -----------------CONTROL: Botón ----------------------------------------------------------------
                        $esteCampo = 'botonInicioSesion';
                        $atributos ["id"] = $esteCampo;
                        $atributos ["tabIndex"] = $tab;
                        $atributos ["tipo"] = 'boton';
                        // submit: no se coloca si se desea un tipo button genérico
                        $atributos ['submit'] = true;
                        $atributos ["estiloMarco"] = '';
                        $atributos ["estiloBoton"] = 'jqueryui';
                        // verificar: true para verificar el formulario antes de pasarlo al servidor.
                        $atributos ["verificar"] = '';
                        $atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
                        $atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
                        $atributos ['nombreFormulario'] = $esteBloque ['nombre'];
                        $tab ++;

                        // Aplica atributos globales al control
                        $atributos = array_merge ( $atributos, $atributosGlobales );
                        echo $this->miFormulario->campoBoton ( $atributos );
                        
                        
                        
                        // -----------------FIN CONTROL: Botón -----------------------------------------------------------

                        // ------------------Fin Division para los botones-------------------------
                   
                        
        echo $this->miFormulario->division("fin"); 
                                
                        echo $this->miFormulario->division ( "fin" );
        
        	
        
	      	
        // ------------------- SECCION: Paso de variables ------------------------------------------------

        /**
         * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
         * SARA permite realizar esto a través de tres
         * mecanismos:
         * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
         * la base de datos.
         * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
         * formsara, cuyo valor será una cadena codificada que contiene las variables.
         * (c) a través de campos ocultos en los formularios. (deprecated)
        */

        // En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:

        // Paso 1: crear el listado de variables

       // $valorCodificado = "actionBloque=" . $esteBloque ["nombre"];
        $valorCodificado = "&pagina=" . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
        $valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
        $valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
         $valorCodificado .= "&opcion=ingresar";
                 
               
       
        $valorCodificado .= "&tiempo=" . $_REQUEST ['tiempo'];
        /**
         * SARA permite que los nombres de los campos sean dinámicos.
         * Para ello utiliza la hora en que es creado el formulario para
         * codificar el nombre de cada campo. 
         */
        $valorCodificado .= "&campoSeguro=" . $_REQUEST['tiempo'];
        // Paso 2: codificar la cadena resultante
        $valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );

        $atributos ["id"] = "formSaraData"; // No cambiar este nombre
        $atributos ["tipo"] = "hidden";
        $atributos ['estilo'] = '';
        $atributos ["obligatorio"] = false;
        $atributos ['marco'] = true;
        $atributos ["etiqueta"] = "";
        $atributos ["valor"] = $valorCodificado;
        echo $this->miFormulario->campoCuadroTexto ( $atributos );
        unset ( $atributos );

        // ----------------FIN SECCION: Paso de variables -------------------------------------------------

        // ---------------- FIN SECCION: Controles del Formulario -------------------------------------------

        // ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
        // Se debe declarar el mismo atributo de marco con que se inició el formulario.
        $atributos ['marco'] = true;
        $atributos ['tipoEtiqueta'] = 'fin';
        echo $this->miFormulario->formulario ( $atributos );

        return true;

    }

    function mensaje() {

        // Si existe algun tipo de error en el login aparece el siguiente mensaje
        $mensaje = $this->miConfigurador->getVariableConfiguracion ( 'mostrarMensaje' );
        $this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', null );

        if ($mensaje) {

            $tipoMensaje = $this->miConfigurador->getVariableConfiguracion ( 'tipoMensaje' );

            if ($tipoMensaje == 'json') {

                $atributos ['mensaje'] = $mensaje;
                $atributos ['json'] = true;
            } else {
                $atributos ['mensaje'] = $this->lenguaje->getCadena ( $mensaje );
            }
            // -------------Control texto-----------------------
            $esteCampo = 'divMensaje';
            $atributos ['id'] = $esteCampo;
            $atributos ["tamanno"] = '';
            $atributos ["estilo"] = 'information';
            $atributos ["etiqueta"] = '';
            $atributos ["columnas"] = ''; // El control ocupa 47% del tamaño del formulario
            echo $this->miFormulario->campoMensaje ( $atributos );
            unset ( $atributos );

             
        }

        return true;

    }

}

$miFormulario = new Formulario ( $this->lenguaje, $this->miFormulario, $this->sql);


$miFormulario->formulario ();
$miFormulario->mensaje ();

?>