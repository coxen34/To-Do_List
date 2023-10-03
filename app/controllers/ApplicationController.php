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



        $this->view->dataJ = $dataJ;

        return $dataJ;
    }

    // ___________CONTROLADOR CREAR TAREA_____________
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

            //PROCESO PARA OBTENER EL ULTIMO ID
            $lastId = 0;
            $dataJ = [];

            $dataJson = new TaskModel();
            $dataJ = $dataJson->getAllTasks();
            foreach ($dataJ as $task) {
                if ($task["id"] > $lastId) {
                    $lastId = $task["id"];
                }
            }

            $newId = $lastId + 1;

            // Crea un nuevo array con los datos del formulario
            $newTask = [

                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status,
                "id" => $newId


            ];
            // $this->view->newTask = $newTask;

        }
        if ($newTask !== null) {
            // Llama a un método para agregar la tarea al modelo
            $createTaskModel = new TaskModel();
            $createTaskModel->createTask($newTask);
            $this->view->createTaskModel = $createTaskModel;
            // Set a task success message in the session
            $_SESSION['success_message'] = 'Task created successfully';

            // Redirect to the task list or any other appropriate page after deletion
            header("Location: getAllTasks");
        }
    }
    // ___________CONTROLADOR EDITAR TAREA_____________
    public function ediTaskAction()
    {
        // Asigno el valor del input "name:taskId"
        // Usando el operador ternario "? $_POST["taskId"] : null;", le asigno valor en función de la verificación: "isset($_POST["taskId"])"
        $taskId = isset($_POST["taskId"]) ? $_POST["taskId"] : null;


        if ($taskId !== null) {

            $taskModel = new TaskModel();
            $taskToEdit = $taskModel->getTaskById($taskId);

            // Existe la tarea con ese id?
            if ($taskToEdit) {
                // Visualizamos
                $this->view->taskToEdit = $taskToEdit;
            } else {
                echo "La tarea no existe.";
            }
        } else {
            echo "ID de tarea no válido.";
        }
    }
    // ___________CONTROLADOR UPDATE TAREA_____________
    public function updateTaskAction()
    {
        // Si se recibe una solicitud HTTP POST, recopila datos del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $taskId = $_POST["taskId"];
            $taskDescription = $_POST["taskDescription"];
            $author = $_POST["author"];
            $startingDate = $_POST["startingDate"];
            $enDate = $_POST["endDate"];
            $status = $_POST["status"];

            //COMPRUEBO SI ALMACENA LOS DATOS
            // var_dump($_POST);

            // Array con los datos actualizados
            $updatedTask = [
                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status
            ];
            //Ya se puede actualizar la tarea
            $taskModel = new TaskModel();
            $taskModel->updateTask($taskId, $updatedTask);
        }
    }

    public function deleteTaskAction()
    {


        // checks the HTTP request method to see if it's a POST request.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Retrieve the value of the "taskId" parameter from the POST data.
            $taskId = isset($_POST["taskId"]) ? $_POST["taskId"] : null;

            if ($taskId !== null) {

                $taskModel = new TaskModel();
                $taskModel->deleteTask($taskId);

                // Set a task success message in the session
                $_SESSION['success_message'] = 'Task deleted successfully';

                // Redirect to the task list or any other appropriate page after deletion
                header("Location: getAllTasks");

                exit();
            } else {

                echo "Task ID doesn't exist.";
            }
        }
    } // ___________CONTROLADOR STATUS VIEWS_____________
    public function pendingAction()
    {
        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        //return $dataJ;

        $this->view->dataJ = $dataJ;
    }
    public function ongoingAction()
    {
        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        //return $dataJ;

        $this->view->dataJ = $dataJ;
    }
    public function completedAction()
    {
        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        //return $dataJ;

        $this->view->dataJ = $dataJ;
    }

    public function weeklyAction() {

        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        //return $dataJ;

        $this->view->dataJ = $dataJ;
    }

        
    public function monthlyAction() {

        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        $this->view->dataJ = $dataJ;
        
    }

    public function yearlyAction() {

        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        $this->view->dataJ = $dataJ;
        
    }
   
}
