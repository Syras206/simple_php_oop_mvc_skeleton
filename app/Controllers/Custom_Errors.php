<?php
namespace App\Controllers;

if (!defined('APP')) { exit; }

/**
 * Custom Errors Controller
 */
class Custom_Errors extends \App\Controller {

	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @return void
	 */
	public function e404() {
		$view = $this->load_view('Errors/404', 'Layout/standard_no_nav');

		$view->title = '404 Page not found';
		$message = '404 Page not found';

		$view->render([
			'message' => $message,
		]);
	}

}