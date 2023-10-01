<?php



class TaskModel
{

    protected $tasks = [];
    protected $jsonPath;


    public function __construct()
    {

        $this->jsonPath = ROOT_PATH . '/app/models/data/DDBB.json';
    }
    public function getAllTasks()
    {

        // $data= file_get_contents('/..app/models/data/DDBB.json') ;
        $data = file_get_contents($this->jsonPath);
        // El segundo argumento "true" indica que se debe devolver un arreglo asociativo en lugar de un objeto.
        $tasks = json_decode($data, true);
        return $tasks;
    }
    // ___________METODO CREAR TAREA_____________
    public function createTask($newTask)
    {
        $jsonPath = ROOT_PATH . '/app/models/data/DDBB.json';
        $jsonData = file_get_contents($jsonPath);
        // El segundo argumento "true" indica que se debe devolver un arreglo asociativo en lugar de un objeto.
        $tasks = json_decode($jsonData, true);

        $tasks[] = $newTask;

        // Convierte el array actualizado a formato JSON
        $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);

        // Escribe el nuevo JSON en el archivo
        file_put_contents($jsonPath, $newJsonData);
    }

    
    // OBTENER ID 
    public function getTaskById($taskId)
{
    // Lee el contenido actual del archivo JSON
    $jsonData = file_get_contents($this->jsonPath);

    // Decodifica el contenido JSON en un arreglo
    $tasks = json_decode($jsonData, true);

    // Encuentra la tarea que corresponde al ID proporcionado
    foreach ($tasks as $task) {
        if ($task['id'] == $taskId) {
            return $task; // Devuelve la tarea encontrada
        }
    }

    // Si no se encuentra la tarea, devuelve null o un mensaje de error según tu preferencia
    return null;
}

    // METODO ACTUALIZAR TAREA
    public function updateTask($taskId, $updatedTask)
    {
        // Lee el contenido actual del archivo JSON
        $jsonData = file_get_contents($this->jsonPath);

        // Decodifica el contenido JSON en un arreglo
        $tasks = json_decode($jsonData, true);

        // Encuentra la tarea que se va a actualizar por su ID
        foreach ($tasks as &$task) {
            if ($task['id'] == $taskId) {
                // Actualiza los detalles de la tarea con los nuevos datos
                $task = array_merge($task, $updatedTask);
                break;
            }
        }

        // Convierte el arreglo actualizado a formato JSON
        $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);

        // Escribe el nuevo JSON en el archivo
        file_put_contents($this->jsonPath, $newJsonData);
    }
}

    



    

