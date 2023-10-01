<?php

/**
 * Se utiliza para configurar la ruta en el sistema.
 */
class Router
{
	/**
	 * Ejecuta el enrutamiento del sistema.
	 * @throws Exception
	 */
	public function execute($routes)
	{
		// intenta encontrar la ruta y ejecutar la acción dada en el controlador
		try {
			// El controlador y la acción a ejecutar.
			$controller = null;
			$action = null;
			
			// intenta encontrar una ruta sencilla
			$routeFound = $this->_getSimpleRoute($routes, $controller, $action);
			
			if (!$routeFound) {
				// intenta encontrar una "ruta de parámetro" coincidente
				$routeFound = $this->_getParameterRoute($routes, $controller, $action);
			}
			
			// no se encontró ninguna ruta, lanza una excepción para ejecutar el controlador de errores
			if (!$routeFound || $controller == null || $action == null) {
				throw new Exception('no route added for ' . $_SERVER['REQUEST_URI']);
			}
			else {
				// ejecuta la acción en el controlador
				$controller->execute($action);
			}
		}
		catch(Exception $exception) {
			// ejecuta el controlador de errores
			$controller = new ErrorController();
			$controller->setException($exception);
			$controller->execute('error');
		}
	}
	
	/**
	 * Prueba si una ruta tiene parámetros
	 * @param string $route the route (uri) to test
	 * @return boolean
	 */
	public function hasParameters($route)
	{
		return preg_match('/(\/:[a-z]+)/', $route);
	}
	
	/**
	 * Obtiene el URI actual llamado
	 * @return string the URI called
	 */
	protected function _getUri()
	{
		$uri = explode('?',$_SERVER['REQUEST_URI']);
		$uri = $uri[0];
		$uri = substr($uri, strlen(WEB_ROOT));
		
		return $uri;
	}
	
	/**
	 * Intenta encontrar una ruta simple que coincida
	 * @param array $routes la lista de rutas en el sistema
	 * @param Controller $controller el controlador a usar (enviado como referencia)
	 * @param string $action la acción a ejecutar (enviada como referencia)
	 * @return boolean
	 */
	protected function _getSimpleRoute($routes, &$controller, &$action)
	{
		// recupera el URI
		$uri = $this->_getUri();
		
		// si la ruta no está definida, intente agregar una barra diagonal
		if (isset($routes[$uri])) {
			$routeFound = $routes[$uri];
		}
		else if(isset($routes[$uri . '/'])) {
			$routeFound = $routes[$uri . '/'];
		}
		else {
			$uri = substr($uri, 0, -1);
			// busca la ruta actual
			$routeFound = isset($routes[$uri]) ? $routes[$uri] : false;
		}
		
		// si se encontró una ruta coincidente
		if ($routeFound) {
			list($name, $action) = explode('#', $routeFound);
		
			// initializes the controller
			$controller = $this->_initializeController($name);
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * Intenta encontrar una ruta de parámetro coincidente
	 * @param array $routes la lista de rutas en el sistema
	 * @param Controller $controller el controlador a usar (enviado como referencia)
	 * @param string $action la acción a ejecutar (enviada como referencia)
	 * @return boolean
	 */
	protected function _getParameterRoute($routes, &$controller, &$action)
	{
		// fetches the URI
		$uri = $this->_getUri();
		
		// testing routes with parameters
		foreach ($routes as $route => $path) {
			if ($this->hasParameters($route)) {
				$uriParts = explode('/:', $route);
					
				$pattern = '/^';
				//$pattern .= '\\'.($uriParts[0] == '' ? '/' : $uriParts[0]); 
				if ($uriParts[0] == '') {
					$pattern .= '\\/';
				}
				else {
					$pattern .= str_replace('/', '\\/', $uriParts[0]);
				}
					
				foreach (range(1, count($uriParts)-1) as $index) {
					$pattern .= '\/([a-zA-Z0-9]+)';
				}
				
				// ¡Ahora también maneja las barras diagonales finales!
				$pattern .= '[\/]{0,1}$/';
					
				$namedParameters = array();
				$match = preg_match($pattern, $uri, $namedParameters);
				// if the route matches
				if ($match) {
					list($name, $action) = explode('#', $path);
		
					// initializes the controller
					$controller = $this->_initializeController($name);
		
					// agrega los parámetros nombrados al controlador
					foreach (range(1, count($namedParameters)-1) as $index) {
						$controller->addNamedParameter(
								$uriParts[$index],
								$namedParameters[$index]
						);
					}
					
					return true;
				}
			}
		}
		
		return false;
	}
	
	/**
	 * Initializes the given controller
	 * @param string $name the name of the controller
	 * @return mixed null if error, else a controller
	 */
	protected function _initializeController($name)
	{
		// Inicializa el controlador dado
		$controller = ucfirst($name) . 'Controller';
		// constructs the controller
		return new $controller();
	}
}
