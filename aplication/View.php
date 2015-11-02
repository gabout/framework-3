<?php

/**
 * Clase View
 * Clase que permite la creación de las vistas  
 * @author  Cristian Bernal <crisbera@gmail.com>
 */
class View
{
	private $_controlador;
	private $_metodo;
	
	
	/**
	 * Método __construct
	 * 
	 * Método constructor de la clase 
	 * 
	 */
	public function __construct(Request $peticion){
		$this->_controlador = $peticion->getControlador();
		$this->_metodo = $peticion->getMetodo();
	}

	/**
	 * Método renderizar
	 * 
	 * Método para renderizar el contenido
	* @return  void no regresa ningún valor
	 */
	public function renderizar($vista){

		$_layoutParams = array(
			'ruta_css' => APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/css/',
			'ruta_img' => APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/img/',
			'ruta_js' => APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/js/',
		);

		$rutaView = ROOT.'views'.DS.$this->_controlador.DS.$vista.'.phtml';
                
		if ($this->_metodo == 'login'){
			$layout = 'login';
		}else{
			$layout = DEFAULT_LAYOUT;
		}


		if(is_readable($rutaView)){
			include_once ROOT.'views'.DS.'layouts'.DS.$layout.DS.'header.php';
			include_once $rutaView;
			include_once ROOT.'views'.DS.'layouts'.DS.$layout.DS.'footer.php';

		}else{
			throw new Exception('Error de  vista');
		}
	}

}












?>