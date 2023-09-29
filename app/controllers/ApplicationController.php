<?php

/**
 * Controlador base para la aplicación.
 * Agregar cosas generales en este controlador.
 */

class ApplicationController extends Controller {

    public function indexAction() {

    }

    public function formAction() {

    }

    public function getAllTasksAction() {

        $dataJ = [];
        
        $dataJson = new TaskModel();
        $dataJ= $dataJson->getAllTasks(); 

        //return $dataJ;

        $this->view->dataJ = $dataJ;
       
        // include ROOT_PATH . '/app/views/scripts/application/getAllTasks.phtml';

    }

}
