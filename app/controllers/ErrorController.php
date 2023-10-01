<?php

/**
 * Un controlador utilizado para manejar errores estándar.
 */
class ErrorController extends Controller
{
	protected $_exception = null;
	
	/**
	 * Establece la excepción para mostrar información sobre
	 */
	public function setException(Exception $exception)
	{
		$this->_exception = $exception;
	}
	
	/**
	 * La acción de error, que se llama cada vez que hay un error en el sitio.
	 */
	public function errorAction()
	{
		// establece el encabezado 404
		header("HTTP/1.0 404 Not Found");
		
		// establece el error que se representará en la vista
		$this->view->error = $this->_exception->getMessage();
		
		// registra el error en el registro
		error_log($this->view->error);
		error_log($this->_exception->getTraceAsString());
	}
}
