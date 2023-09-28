<?php

class TaskModel {
    protected $tasks=[];
    
    public function getAllTasks(){
    // $data= file_get_contents('/..app/models/data/DDBB.json') ;
    $data= file_get_contents(ROOT_PATH . '/app/models/data/DDBB.json') ;
    $tasks= json_decode($data, true);
    return $tasks;

    }
    }
    



