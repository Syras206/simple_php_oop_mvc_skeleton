<?php
namespace App\Controllers;

if (!defined('APP')) { exit; }

/**
 *
 */
class Custom_Errors extends \App\Controller {

	public static function e404() {
		$view = self::load_view('Errors/404', 'Layout/standard_no_nav');

		$view->title = '404 Page not found';
		$message = '404 Page not found';

		$view->render([
			'message' => $message,
		]);
	}

}