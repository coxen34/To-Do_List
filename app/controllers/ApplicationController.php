<?php


/**
 * Controlador base para la aplicación.
 * Agregar cosas generales en este controlador.
 */

class ApplicationController extends Controller
{
    public function initializeObject()
    {
        return new TaskModel();
    }

    public function getAllTasksAction()
    {
        $todoObject = $this->initializeObject();
        $todo = $todoObject->getAllTasks();
        $this->view->todo = $todo;
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

            // Crea un nuevo array con los datos del formulario
            $newTask = [

                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status,
            ];
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
        return $newTask;
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
        $taskId = $this->_getParam("taskId");

        if ($taskId !== null) {
            $todoObject = $this->initializeObject();

            $success = $todoObject->deleteTask($taskId);

            if ($success) {
                $_SESSION['success_message'] = 'Task deleted successfully';
            } else {
                $_SESSION['error_message'] = 'Error deleting task';
            }
        }

        header("Location: getAllTasks");
        exit();
    }
}
