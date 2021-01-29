<?php
namespace App;

if (!defined('APP')) { exit; }

/**
 * Main View Class.
 */
class View {
	private $data = [];
	private $template = '';
	private $view_path;
	protected $directory_path = VIEWS_DIRECTORY;
	public $title = '';

	function __construct($view_path) {
		$this->view_path = $view_path;
	}

	/**
	 * capture page from a view file
	 *
	 * @access public
	 * @param string $view_path
	 * @param array $data
	 * @return string
	 */
	public function capture_page(string $view_path, array $data): string {
		ob_start();
		extract($data, EXTR_PREFIX_SAME, 'data');

		try {
			include($view_path);

			return ob_get_clean();
		} catch (Exception $e) {
			ob_end_clean();

			echo 'Something went wrong fetching this view '.$e;
		}

	}

	/**
	 * get data variables
	 *
	 * @access public
	 * @return array
	 */
	public function get_data(): array {
		return $this->data;
	}

	/**
	 * Include a partial in the view with all data
	 *
	 * @access public
	 * @param  string $partial
	 * @param array $options [default: []]
	 * @return string
	 */
	public function partial(string $partial, $options = []) {
		$data = array_merge($this->get_data(), $options);
		$partial_path = $this->directory_path.$partial.'.php';

		return $this->capture_page($partial_path, $data);
	}

	/**
	 * render page from a view file
	 *
	 * @access public
	 * @param array $variables [default: []]
	 * @return void
	 */
	public function render(array $variables = []): void {
		$this->set_data($variables);

		// check if this view has a template
		if (!empty($this->template)) $this->render_template();
		// otherwise just render the view
		else {
			extract($this->get_data(), EXTR_PREFIX_SAME, 'data');

			require_once($this->view_path);
		}
	}

	/**
	 * render view file within a template
	 *
	 * @access private
	 * @return void
	 */
	private function render_template(): void {
		if (!empty($this->template)) {
			// capture the view file and set it as a contents variable to place in our template
			$contents = $this->capture_page($this->view_path, $this->get_data());

			// show the template
			require_once($this->template);
		}
	}

	/**
	 * set data we'll use in our view
	 *
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function set_data(array $data): void {
		foreach ($data as $data_key => $data_value) {
			$this->data[$data_key] = $data_value;
		}
	}

	/**
	 * set template we'll use in our view
	 *
	 * @access public
	 * @param string $template_path
	 * @return void
	 */
	public function set_template(string $template_path): void {
		$this->template = $template_path;
	}

}