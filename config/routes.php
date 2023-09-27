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
// !Lo saco del array routes  AVER K PASA
 
 	//'/ruta' => 'test#ruta',
//'/test' => 'test#index'
//'/' => 'ToDo#index',

$routes = array(
	'/' => 'ToDo#index',
	'/index' => 'ToDo#index',
	'/hello' => 'ToDo#hello',
	'/ruta' => 'test#ruta',
	'/test' => 'test#index',
	'/createTask' => 'ToDo#createTask'
	
);