<?php

class Request
{
	/**
	 * Prueba si la solicitud actual es una solicitud POST
	 * @return boolean
	 */
	public function isPost()
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
	}
	
	/**
	 * Prueba si la solicitud actual es una solicitud GET
	 * @return boolean
	 */
	protected function _isGet()
	{
		return ($_SERVER['REQUEST_METHOD'] == 'GET' ? true : false);
	}
	
	/**
	 * recupera los datos del parámetro dado.
	 * @param string $key la clave a buscar.
	 * @param mixed $default el valor predeterminado a devolver, si el parámetro dado no está configurado.
	 */
	public function getParam($key, $default = null)
	{
		if ($this->isPost()) {
			if(isset($_POST[$key])) {
				return $_POST[$key];
			}
		}
		else if ($this->_isGet()) {
			if(isset($_GET[$key])) {
				return $_GET[$key];
			}
		}
			
		return $default;
	}
	
	/**
	 * Devuelve una lista de parámetros proporcionados en la solicitud actual.
	 * @return array the params given
	 */
	public function getAllParams()
	{
		if ($this->isPost()) {
			return $_POST;
		}
		else if ($this->_isGet()) {
			return $_GET;
		}
	}
}
