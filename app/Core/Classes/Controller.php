<?php
namespace App;

if (!defined('APP')) { exit; }

use App\View;

/**
 * Main Controller Class.
 * Set up controllers to load views and templates.
 */
class Controller {
	public static $controller = NULL;

	/**
	 * initialise our controller
	 *
	 * @access public
	 * @static
	 * @param mixed $options [default: []]
	 */
	public static function init(array $options = []) {
	  	if (self::$controller == NULL) self::$controller = new self();

		return self::$controller;
	}

	/**
	 * Create and return a new view instance
	 *
	 * @access public
	 * @param string $view_file
	 * @param string $template_file [default: '']
	 * @return ?View
	 */
	public static function load_view(string $view_file, string $template_file = ''): ?View {
		// check the view exists
		$view_path = VIEWS_DIRECTORY.$view_file.'.php';
		if (!file_exists($view_path)) return null;

		// instantiate a new view with this path
		$view = new View($view_path);

		// check if we have a template
		if (!empty($template_file)) {
			// try and set this template in the view object
			$template_path = VIEWS_DIRECTORY.$template_file.'.php';
			if (file_exists($template_path)) $view->set_template($template_path);
		}

		return $view;
	}
}