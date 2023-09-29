<?php

class TaskModel {

    protected $tasks=[];
    protected $jsonPath;
    

    public function __construct() {

        $this->jsonPath= ROOT_PATH . '/app/models/data/DDBB.json';

    }
    public function getAllTasks() {

    // $data= file_get_contents('/..app/models/data/DDBB.json') ;
    $data= file_get_contents($this->jsonPath) ;
    $tasks= json_decode($data, true);
    return $tasks;

    }
    
    }
    



