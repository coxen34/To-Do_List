<?php

/**
 * Se utiliza para definir las rutas en el sistema.
 * 
 * Una ruta debe definirse con una clave que coincida con la  URL y un
 * controlador#método acción-para-llamar. P.ej.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
// $routes = array(
// 	'/test' => 'test#index'
// );

$routes = array(
	'/'				=>  'application#index',
	'/'				=>  'application#getAllTasks',
	'/getAllTasks'  =>	'application#getAllTasks',
	'/createTask'	=>	'application#createTask',
	'/ediTask'		=>	'application#ediTask',
	'/updateTask'	=>	'application#updateTask',
	'/deleteTask' =>	'application#deleteTask',
	'/weekly'       =>  'application#weekly',
	'/monthly'       =>  'application#monthly',
	'/yearly'       =>  'application#yearly'




);
