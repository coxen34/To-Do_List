 <?php

// $json_path = ROOT_PATH . '/app/models/data/DDBB.json';
define('JSON_PATH', ROOT_PATH . '/app/models/data/DDBB.json');

class ModelJson
{
    protected $json_file;
    // Conectar la ddbb con la clase modelo
    
    //!PROBAR $_SESSION["name"]=$name;
    public function __construct($json_file)
    {
        $this->json_file = $json_file;


    }
    
    
    public function getJson()
    {
        // Verifica que $this->json_file tenga un valor válido
        if ($this->json_file && file_exists($this->json_file)) {
            $currentData = file_get_contents($this->json_file);
            return json_decode($currentData, true)['tasks'];
        } else {
            // Manejar el error si $this->json_file no es válido
            return [];
        }
    }

    public function createTask()
{
    if (isset($_POST["buttonForm"])) {
        $taskDescription = $_POST["taskDescription"];
        $author = $_POST["author"];
        $startingDate = $_POST["startingDate"];
        $endDate = $_POST["endDate"];
        $state = $_POST["state"];

        // Leer los datos actuales del archivo JSON
        $currentData = json_decode(file_get_contents(JSON_PATH), true);

        // Crear nueva tarea
        $newTask = [
            'taskDescription' => $taskDescription,
            'author' => $author,
            'startingDate' => $startingDate,
            'endDate' => $endDate,
            'state' => $state,
        ];

        // Agregar la nueva tarea a los datos actuales
        $currentData['tasks'][] = $newTask;

        // Convertir los datos actualizados a formato JSON
        $jsonData = json_encode($currentData, JSON_PRETTY_PRINT);

        // Guardar los datos en el archivo JSON
        file_put_contents(JSON_PATH, $jsonData);
    }
    return $jsonData;
}



    public function createOldTask()
    {
        
        if (isset($_POST["buttonForm"])) {
            $taskDescription = $_POST["taskDescription"];
            $author = $_POST["author"];
            $startingDate = $_POST["startingDate"];
            $endDate = $_POST["endDate"];
            $state = $_POST["state"];

            

            // Crear nueva tarea
            $newTask = [
                'taskDescription' => $taskDescription,
                'author' => $author,
                'startingDate' => $startingDate,
                'endDate' => $endDate,
                'state' => $state,
            ];

            // Agregar la nueva tarea a los datos actuales
            // $currentData[] = $newTask;
            $currentData['tasks'][] = $newTask;

            // Convertir los datos actualizados a formato JSON
            $jsonData = json_encode($currentData, JSON_PRETTY_PRINT);

            // Guardar los datos en el archivo JSON
            file_put_contents($this->json_file, $jsonData);
        }
        return $jsonData;
        
    }
    public function getOldJson()
    {
        // Cargar datos actuales del archivo JSON
        // $currentData = json_decode(file_get_contents($this->json_file), true);
        $currentData = file_get_contents($this->json_file);
        return json_decode($currentData, true)['tasks'];

    }
} 
