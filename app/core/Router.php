<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return callback
 */

class Router {
	public static function route() {
		$url = $_SERVER['REQUEST_URI'];
		$url = rtrim($url, '/');

		$urlParts = explode('/', $url);

        // Cek apakah controller dan metode ada dalam URL
		if (isset($urlParts[1])) {
			$controllerName = ucfirst($urlParts[1]) . 'Controller';
			$methodName = isset($urlParts[2]) ? $urlParts[2] : 'index';
			$params = array_slice($urlParts, 3);
		} else {
            $controllerName = 'HomeController'; // Controller default
            $methodName = 'index';
            $params = [];
        }

        $controllerPath = "../app/controllers/{$controllerName}.php";
        if (file_exists($controllerPath)) {
        	require_once $controllerPath;
        	$controller = new $controllerName();

        	if (method_exists($controller, $methodName)) {
        		call_user_func_array([$controller, $methodName], $params);
        	} else {
        		echo "Method {$methodName} not found in {$controllerName}.";
        	}
        } else {
        	echo "Controller {$controllerName} not found.";
        }
    }
}
