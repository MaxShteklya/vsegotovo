<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;
	protected $model;

	public function __construct($route) {
		$this->route = $route;

		if (!$this->checkAcl()) {
			$adminPg = explode("/",$_SERVER["REQUEST_URI"])[1];
			if($adminPg == "admin") header("Location: /admin/login");
			else View::errorCode(403);
		}

		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
		$this->model->rememberMeAdmin();
	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (!isset($_SESSION['admin']['id']) && $this->isAcl('guest')) {
			return true;
		}
		elseif (isset($_SESSION['admin']['id']) && $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}
}
