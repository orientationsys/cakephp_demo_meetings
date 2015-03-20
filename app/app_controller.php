<?php

	class AppController extends Controller{
		public $components = array('Cookie', 'RequestHandler');	
		public $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Navigation', 'PartialLayout', 'Text');

		
	}

?>