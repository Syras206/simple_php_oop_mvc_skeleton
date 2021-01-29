<?php
namespace App\Controllers;

if (!defined('APP')) { exit; }

/**
 * Under Construction Controller
 */
class Under_Construction extends \App\Controller {

	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @return void
	 */
	public function under_construction() {
		$view = $this->load_view('under_construction', 'Layout/standard_no_nav');
		$view->title = 'Coming Soon';

		$message = 'We are working on this';
		$view->render([
			'message' => $message,
		]);
	}

}