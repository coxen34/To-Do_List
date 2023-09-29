<?php

/**
 * Controlador base para la aplicación.
 * Agregar cosas generales en este controlador.
 */
class ApplicationController extends Controller
{

    public function indexAction()
    {
    }
    public function formAction()
    {
    }
    public function getAllTasksAction()
    {
        
        $dataJson = new TaskModel();
        $dataJ= $dataJson->getAllTasks(); 
       
        
        include ROOT_PATH . '/app/views/scripts/application/getAllTasks.phtml';
        $this->view->dataJ = $dataJ;
    }
}
