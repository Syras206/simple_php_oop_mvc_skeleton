<?php
namespace App\Controllers;

if (!defined('APP')) { exit; }

/**
 *
 */
class Under_Construction extends \App\Controller {

	public static function under_construction() {
		$view = self::load_view('under_construction', 'Layout/standard_no_nav');
		$view->title = 'Coming Soon';

		$message = 'We are working on this';
		$view->render([
			'message' => $message,
		]);
	}

}