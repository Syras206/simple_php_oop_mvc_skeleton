<?php
namespace App;

if (!defined('APP')) { exit; }

/**
 * Main Router Class.
 * Set up routes to direct page access requests.
 */
class Router {
	private $_404 = '';
	private $controllers_namespace = '\App\Controllers\\';
	private $routes = [
		'delete' => [],
		'get' => [],
		'post' => [],
		'put' => [],
	];
	private $request = null;

	/**
	 * Call the function linked to the route url. Find a controller-method pair if given.
	 *
	 * @access private
	 * @param  mixed   $function
	 * @param  array    $paramaters
	 * @return void
	 */
	private function call($function, array $paramaters = []): void {
		if (strrpos($function, '@')) {
			// split the function string by the @ symbol into an array [$controller, $method]
			list($controller, $method) = explode('@', $function);
			$controller = $this->controllers_namespace.$controller;

			// check if the controller and method exist
			if (class_exists($controller) && method_exists($controller, $method)) {
				// we have a match, call the method

				$controller::$method($paramaters);
			}
		}
	}

	/**
	 * Set a custom 404 function
	 *
	 * @access public
	 * @param  mixed   $function
	 * @return void
	 */
	public function custom_404($function): void {
		$this->_404 = $function;
	}

	/**
	 * Set the delete routes in a $routes array
	 *
	 * @access public
	 * @param  string   $url
	 * @param  mixed   $function
	 * @return void
	 */
	public function delete(string $url, $function): void {
		$this->routes['delete'][] = [
			'url' => $url,
			'function' => $function,
		];
	}

	/**
	 * Set the get routes in a $routes array
	 *
	 * @access public
	 * @param  string   $url
	 * @param  mixed   $function
	 * @return void
	 */
	public function get(string $url, $function): void {
		$this->routes['get'][] = [
			'url' => $url,
			'function' => $function,
		];
	}

	/**
	 * Set the post routes in a $routes array
	 *
	 * @access public
	 * @param  string   $url
	 * @param  mixed   $function
	 * @return void
	 */
	public function post(string $url, $function): void {
		$this->routes['post'][] = [
			'url' => $url,
			'function' => $function,
		];
	}

	/**
	 * Set the put routes in a $routes array
	 *
	 * @access public
	 * @param  string   $url
	 * @param  mixed   $function
	 * @return void
	 */
	public function put(string $url, $function): void {
		$this->routes['put'][] = [
			'url' => $url,
			'function' => $function,
		];
	}

	/**
	 * Run the router. This sets up the routes ready to go.
	 *
	 * @access public
	 * @return void
	 */
	public function run(): void {
		$success = false;

		// loop through our routes looking for a match
		foreach (['get', 'delete', 'post', 'put'] as $method_type) {
			foreach ($this->routes[$method_type] as $route) {
				$match = $this->find_match($route['url'], $method_type);
				if ($match['success'] !== true) continue;

				// if we get to this point it means we found a match. Now lets try and call the router and method
				$success = true;
				$this->call($route['function'], $match['paramaters'] ?? []);
			}
		}

		// no match found so show our 404 page
		if ($success === false) $this->call($this->_404);
	}

	/**
	 * Find a match between the current url and a route, and return success results and any parameters to use.
	 *
	 * @access private
	 * @param  string   $route_url
	 * @param  string   $method_type
	 * @return array
	 */
	private function find_match(string $route_url, string $method_type): array {
		$rtn = $paramaters = [];

		// check if the route method type is the same as the current request method
		if ($method_type != strtolower($_SERVER['REQUEST_METHOD'])) return ['success' => false];

		// split our current request url by '/' into an array of url parts
		$current_url = explode('/', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
		// split our route url by '/' into an array of url parts
		$route_url = explode('/', $route_url);

		// check if the ammount of url parts are the same
		if (count($route_url) != count($current_url)) return ['success' => false];

		// loop through each part and check if our current url part matches the route url part
		foreach ($route_url as $url_part_key => $url_part) {
			// trim the :: from the url part to build our parameter key
			$parameter_key = trim($url_part, '::');
			// check if this part is a parameter. If it is then store that in the parameters array
			if (strrpos($url_part, '::')) $paramaters[$parameter_key] = $current_url[$url_part_key];
			// return success false if this is not a parameter and there is no direct match
			if ($url_part != $current_url[$url_part_key] && !strrpos($url_part, '::')) return ['success' => false];
		}

		// add in posted json data
		$json_data = (array)json_decode(file_get_contents('php://input'));
		// add in posted form data
		$paramaters['data'] = array_merge($json_data, $_POST);

		return [
			'paramaters' => array_filter($paramaters),
			'success' => true,
		];
	}

}