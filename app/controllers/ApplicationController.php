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
        // Retrieve the task ID to edit from the request parameters (e.g., URL or form submission)
        $taskId = $this->_getParam("taskId");

        if ($taskId !== null) {
            // Initialize the TaskModel
            $taskModel = $this->initializeObject();

            // Retrieve the task details for editing
            $taskToEdit = $taskModel->getTaskById($taskId);

            if ($taskToEdit) {
                // Pass the task details to the view for displaying the edit form
                $this->view->taskToEdit = $taskToEdit;
            } else {
                $_SESSION['error_message'] = 'Task not found.';
            }
        } else {
            $_SESSION['error_message'] = 'Invalid task ID.';
        }
    }

    // ___________CONTROLADOR ACTUALIZAR TAREA_____________
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

            // Array con los datos actualizados
            $updatedTask = [
                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status
            ];
            //Ya se puede actualizar la tarea
            $taskModel = $this->initializeObject();
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

    public function weeklyAction()
    {
        // Define an array to store the tasks you want to display
        $tasksToDisplay = [];

        // Get the current date
        $currentDate = new DateTime();
        
        // Calculate the end date (current date + 7 days)
        $endDate = clone $currentDate;
        $endDate->add(new DateInterval('P7D'));

        $todoObject = $this->initializeObject();
        $todo = $todoObject->getAllTasks();

        foreach ($todo as $task) {

            // Parse the task dates in 'yyyy-mm-dd' format
            $startDate = DateTime::createFromFormat('Y-m-d', $task['starting_date']);

            if ($startDate >= $currentDate && $startDate <= $endDate) {

                // Add the task to the array if it meets the criteria
                $tasksToDisplay[] = $task;

            }

            // Check if the task's start date is equal to the current date
            if ($startDate->format('Y-m-d') == $currentDate->format('Y-m-d')) {

            // Add the task to the array for the current date
            $tasksToDisplay[] = $task;
            
            }   

        }

        $todo = $tasksToDisplay;
        $this->view->todo = $todo;

    }

}