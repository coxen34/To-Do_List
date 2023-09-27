<?php
class TodoController extends Controller{

    public function indexAction()
	{
		//echo "hello from To Do Controller method index";
		// $this->view->message = "hello from test::index";
	}

	public function helloAction()
	{
		echo "hello from To Do Controller method hello";
		//$this->view->message = "hello from test::index";
	}
	public function createTaskAction(){
	echo "Function Create Task";

	}
	
}