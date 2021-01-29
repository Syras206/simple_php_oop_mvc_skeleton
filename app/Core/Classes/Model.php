<?php
namespace App;

if (!defined('APP')) { exit; }

/**
 * Main Model Class.
 */
class Model {

	/**
	 * initialise our model
	 *
	 * @access public
	 * @static
	 * @param mixed $options [default: []]
	 */
	public static function init(array $options = []) {
		$model_class = get_called_class();

		return new $model_class($options);
	}

}