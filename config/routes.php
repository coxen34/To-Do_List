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

	'/'				=>  'application#getAllTasks',
	'/getAllTasks'  =>	'application#getAllTasks',
	'/deleteTask' 	=>	'application#deleteTask',
	'/createTask'   =>  'application#createTask',
	'/ediTask'      =>  'application#ediTask',	
	'/updateTask'   =>  'application#updateTask',

	'/pendingTasks'=>'application#pendingTasks',
	'/ongoingTasks'=>'application#OngoingTasks',
	'/completedTasks'=>'application#CompletedTasks',

	'/weekly'      =>  'application#weekly',	
	'/monthly'      =>  'application#monthly',	
	'/yearly'      =>  'application#yearly'









);
