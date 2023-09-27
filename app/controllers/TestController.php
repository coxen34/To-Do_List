<?php

class TestController extends ApplicationController
{
	public function indexAction()
	{
		//$this->view->message = "hola qué tal";
		echo "hello from index action test Controller";
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}
}
