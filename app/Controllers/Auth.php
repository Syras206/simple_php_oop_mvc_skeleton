<?php
namespace App\Controllers;

if (!defined('APP')) { exit; }

/**
 * Auth Controller
 */
class Auth extends \App\Controller {


	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function login(): void {
		$view = self::load_view('Auth/login', 'Layout/standard');
		$view->title = 'Login';

		$view->render([
			// add any data for the view here
		]);
	}


	/**
	 * [POST] -- render view file within a template
	 *
	 * @access public
	 * @static
	 * @param array $data (default: [])
	 * @return void
	 */
	public static function process_login(array $data = []): void {
		$view = self::load_view('Auth/login', 'Layout/standard');
		$view->title = 'Login';

		$posted_data = $data['data'] ?? [];

		// this is where you do something with your posted data

		$view->render([
			// add any data for the view here
		]);
	}

	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function logout(): void {
		$view = self::load_view('Auth/logout', 'Layout/standard');
		$view->title = 'Logout';

		$view->render([
			// add any data for the view here
		]);
	}

	/**
	 * [GET] -- render view file within a template
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function register(): void {
		$view = self::load_view('Auth/register', 'Layout/standard');
		$view->title = 'Register';

		$view->render([
			// add any data for the view here
		]);
	}

}