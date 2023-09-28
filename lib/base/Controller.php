<?php

/**
 * El controlador base del CMS
 */
class Controller
{
	// defines the view
	public $view = null;
	// defines the request(solicitud)
	protected $_request = null;
	// the current action
	protected $_action = null;
	
	protected $_namedParameters = array();
	
	/**
	 * inicializa varias cosas en el controlador
	 */
	public function init()
	{
		$this->view = new View();
		
		$this->view->settings->action = $this->_action;
		$this->view->settings->controller = strtolower(str_replace('Controller', '', get_class($this)));
	}
	
	/**
	 * Estos filtros se ejecutan ANTES de ejecutar la acción.
	 */
	public function beforeFilters()
	{
		// sin declarantes estándar
	}
	
	/**
	 * Estos filtros se ejecutan DESPUÉS de que se ejecute la acción. Estos filtros se ejecutan DESPUÉS de que se ejecute la acción.
	 */
	public function afterFilters()
	{
		// sin declarantes estándar
	}
	
	/**
	 * El punto de entrada principal a la ruta de ejecución del controlador. El parámetro
	 * tomada es la acción a ejecutar.
	 * @param string $action the action to execute
	 * @throws Exception 
	 */
	public function execute($action = 'index')
	{
		// almacena la acción actual
		$this->_action = $action;
		
		// inicializa el conterolador
		$this->init();
		
		// ejecuta los filtros anteriores
		$this->beforeFilters();
		
		// agrega el sufijo de acción a la función a llamar
		$actionToCall = $action.'Action';
		
		// ejecuta la acción
		$this->$actionToCall();
		
		// ejecuta los filtros posteriores
		$this->afterFilters();
		
		// representa la vista
		$this->view->render($this->_getViewScript($action));
	}
	
	/**
	 * recupera el script de vista para la acción dada
	 * @param string $action
	 * @return string la ruta al script de vista
	 */
	protected function _getViewScript($action)
	{
		// recupera el controlador actual ejecutado
		$controller = get_class($this);
		// elimina la parte "Controlador" y agrega el nombre de la acción a la ruta
		$script = strtolower(substr($controller, 0, -10) . '/' . $action . '.phtml');
		// devuelve el script para renderizar
		return $script;
	}
	
	/**
	 * La URL base se utiliza si la aplicación está ubicada en una subcarpeta. Usar
	 * esta función al vincular cosas.
	 * @return string la URL base de la aplicación.
	 */
	protected function _baseUrl()
	{
		return WEB_ROOT;
	}
	
	/**
	 * Recupera la solicitud actual
	 * @return Request
	 */
	public function getRequest()
	{
		// inicializa el objeto de solicitud
		if ($this->_request == null) {
			$this->_request = new Request();
		}
		
		return $this->_request;
	}
	
	/**
	 * Una forma de acceder a los parámetros de solicitud actuales.
	 * @param string $key la clave a buscar
	 * @param mixed $default el valor predeterminado, de lo contrario nulo
	 * @return mixed
	 */
	protected function _getParam($key, $default = null)
	{
		// pruebas contra los parámetros nombrados primero
		if (isset($this->_namedParameters[$key])) {
			return $this->_namedParameters[$key];
		}
		
		// pruebas contra los parámetros GET/POST
		return $this->getRequest()->getParam($key, $default);
	}
	
	/**
	 * Obtiene todos los parámetros actuales
	 * @return array una lista de todos los parámetros
	 */
	protected function _getAllParams()
	{
		return array_merge($this->getRequest()->getAllParams(), $this->_namedParameters);
	}
	
	public function addNamedParameter($key, $value)
	{
		$this->_namedParameters[$key] = $value;
	}
}
