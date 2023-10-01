<?php

/**
 * Una clase para manejar la lógica de vista del sistema.
 *
 */
class View
{
	// utilizado para contener el contenido del script de vista
	protected $_content = "";
	// the standard layout
	protected $_layout = 'layout';
	
	protected $_viewEnabled = true;
	protected $_layoutEnabled = true;
	
	// initializes the data array
	protected $_data = array();
	// inicializa los javascripts adicionales para agregar al encabezado.
	protected $_javascripts = '';
	
	public $settings = null;
	
	public function __construct()
	{
	  $this->settings = new stdClass();
	}

	/**
	 * Representa el script de vista y almacena el resultado.
	 */
	protected function _renderViewScript($viewScript)
	{
		// inicia el buffer de salida
		ob_start();
		
		// incluye el script de visualización
		include(ROOT_PATH . '/app/views/scripts/' . $viewScript);
		
		// devuelve el contenido del buffer de salida
		$this->_content = ob_get_clean();
	}
	
	/**
	 * Obtiene el contenido del script de vista actual
	 */
	public function content()
	{
		return $this->_content;
	}
	
	/**
	 * Representa la vista actual.
	 */
	public function render($viewScript)
	{
	  if ($viewScript && $this->_viewEnabled) {
  		// renderiza el script de vista
  		$this->_renderViewScript($viewScript);
	  }
		
	  if ($this->_isLayoutDisabled()) {
	    echo $this->_content;
	  }
	  else {
  		// incluye la vista actual, que utiliza "$this->content()" para generar el
  		// ver el script que acaba de ser renderizado
  		include(ROOT_PATH . '/app/views/layouts/' . $this->_getLayout() . '.phtml');
	  }
	}
	
	/**
	 * Representa los datos dados como json
	 * @param mixed $data
	 */
	public function renderJson($data)
	{
	  $this->disableView();
	  $this->disableLayout();
	  
	  // establece los encabezados json
	  header('Cache-Control: no-cache, must-revalidate');
	  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	  header('Content-type: application/json');
	  
	  echo json_encode($data);
	}
	
	protected function _getLayout()
	{
		return $this->_layout;
	}
	
	public function setLayout($layout)
	{
		$this->_layout = $layout;
		
		if ($layout) {
		  $this->_enableLayout();
		}
	}
	
	public function disableLayout()
	{
	  $this->_layoutEnabled = false;
	}
	
	public function disableView()
	{
	  $this->_viewEnabled = false;
	}
	
	/**
	 * almacena los datos dados en la clave dada
	 * @param string $key la clave para almacenar los datos en
	 * @param mixed $value el valor a almacenar
	 */
	public function __set($key, $value)
	{
		// almacena los datos
		$this->_data[$key] = $value;
	}
	
	/**
	 * Devuelve los datos si existen, de lo contrario nulo
	 * @param string $key los datos a buscar
	 * @return mixed los datos encontrados o nulos
	 */
	public function __get($key)
	{
		if (array_key_exists($key, $this->_data)) {
			return $this->_data[$key];
		}
		
		return null;
	}
	
	/**
	 * La URL base se utiliza si la aplicación está ubicada en una subcarpeta. Usar
	 * esta función al vincular cosas.
	 * @return string la URL base de la aplicación.
	 */
	public function baseUrl()
	{
		return WEB_ROOT;
	}
	
	/**
	 * Agrega un nuevo javascript al encabezado.
	 * @param string $script la ruta al script a agregar
	 */
	public function appendScript($script)
	{
		$this->_javascripts .= '<script type="text/javascript" src="'.$script.'"></script>' ."\n";
	}
	
	/**
	 * Imprime los javascripts incluidos.
	 */
	public function printScripts()
	{
		echo $this->_javascripts;
	}
	
	/**
	 * Establece el diseño que se utilizará
	 */
	protected function _enableLayout()
	{
	  $this->_layoutEnabled = true;
	}
	
	/**
	 * Prueba si el diseño está deshabilitado
	 */
	protected function _isLayoutDisabled()
	{
	  return !$this->_layoutEnabled;
	}
}
