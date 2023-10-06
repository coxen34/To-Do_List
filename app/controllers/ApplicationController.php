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

    // __________DELETE TASK______________
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
