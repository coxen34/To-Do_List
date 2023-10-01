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

        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        //return $dataJ;

        $this->view->dataJ = $dataJ;

    }
    
    public function createTaskAction()
    {
        // Si se recibe una solicitud HTTP POST, recopila datos del formulario
        $newTask = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtén los datos del formulario
            $taskDescription = $_POST["taskDescription"];
            $author = $_POST["author"];
            $startingDate = $_POST["startingDate"];
            $enDate = $_POST["enDate"];
            $status = $_POST["status"];

            //COMPRUEBO SI ALMACENA LOS DATOS
            // var_dump($_POST);

            // Crea un nuevo array con los datos del formulario
            $newTask = [
                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status
                
            ];
            // $this->view->newTask = $newTask;
           
        }
        if ($newTask !== null) {
            // Llamar a un método para agregar la tarea al modelo, por ejemplo:
            $createTaskModel = new TaskModel();
            $createTaskModel->addTask($newTask);$this->view->createTaskModel = $createTaskModel;
        }
    }
    public function ediTaskAction(){
        
    }

    public function deleteTaskAction() {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $taskId = isset($_POST["taskId"]) ? $_POST["taskId"] : null;

        if ($taskId !== null) {

            $taskModel = new TaskModel();
            $taskModel->deleteTask($taskId);

            // Redirect to the task list or any other appropriate page after deletion
            header("Location: getAllTasks");

            exit();

        } else {

            echo "Task ID doesn't exist.";
        }

    }

}
    
}