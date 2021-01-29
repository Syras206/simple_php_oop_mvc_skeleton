<?php
namespace App\Controllers;

if (!defined('APP')) { exit; }

/**
 * Say_Hello Controller
 */
class Say_Hello extends \App\Controller {


	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function say_hello(array $data): void {
		$view = $this->load_view('Say_Hello/say_hello', 'Layout/standard');
		$view->title = 'Login';

		$view->render([
			'name' => ucfirst($data['name']),
		]);
	}


	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function say_hello_times(array $data): void {
		$view = $this->load_view('Say_Hello/say_hello_times', 'Layout/standard');
		$view->title = 'Login';

		$view->render([
			'name' => ucfirst($data['name']),
			'times' => $data['num_times'],
		]);
	}

}