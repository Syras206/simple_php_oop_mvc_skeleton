<?php
/**
 * Initialise our app framework and set up everything we need
 */
class App {
	public static $app = NULL;

	function __construct() {
		$this->setup_defines();
		$this->setup_autoloads();
		$this->setup_routes();
	}

	/**
	 * Dynamically autoload classes
	 *
	 * @access protected
	 * @param string $prefix [namespace prefix]
	 * @param string $directory [directory path]
	 * @return void
	 */
	protected function autoload(string $prefix, string $directory): void {
		spl_autoload_register(function($classname_string) use($prefix, $directory) {
            // Check if the prefix characters match, else return
            if (strncmp($prefix, $classname_string, strlen($prefix)) !== 0) return;
            // Remove prefix from our classname
            $classname = str_replace($prefix, '', $classname_string);
            // Create a variable with our class path
            $class_path = $directory.str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';
            // Check for the class and return
            if (file_exists($class_path)) require $class_path;
        });
	}

    /**
	 * method to generate an instance of this class
	 *
	 * @access public
	 * @static
	 * @return App
	 */
	public static function init(): App {
        if (self::$app == NULL) self::$app = new self();

        return self::$app;
    }

    /**
	 * Set up autoloads to handle classes
	 *
	 * Namespace Examples
	 *
	 * ----------Base-------------
	 * App\[?Folder]\[class];
	 * App\Controllers\[?Folder]\[class];
	 *
	 * @access protected
	 * @return void
	 */
	protected function setup_autoloads(): void {
		$autoloads = [
			'core_classes' => [
				'namespace' => 'App',
				'directory' => CORE_DIRECTORY.'Classes',
			],
			'core_controllers' => [
				'namespace' => 'App\\Controllers',
				'directory' => APP_DIRECTORY.'Controllers',
			],
		];

		foreach ($autoloads as $autoload) {
			// Run our autoload method for each autoload
			$this->autoload($autoload['namespace'], $autoload['directory']);
		}
	}

	/**
	 * Set up defines used thoughout the system
	 *
	 * @access protected
	 * @return void
	 */
	protected function setup_defines(): void {
		define('ROOT_DIRECTORY', realpath(dirname(__DIR__, 1)).DIRECTORY_SEPARATOR);
		define('APP_DIRECTORY', realpath(ROOT_DIRECTORY.'app').DIRECTORY_SEPARATOR);
		define('PUBLIC_DIRECTORY', realpath(ROOT_DIRECTORY.'public').DIRECTORY_SEPARATOR);
		define('APP', 'skeleton');

		define('CORE_DIRECTORY', realpath(APP_DIRECTORY.'Core').DIRECTORY_SEPARATOR);
		define('MODELS_DIRECTORY', realpath(APP_DIRECTORY.'Models').DIRECTORY_SEPARATOR);
		define('VIEWS_DIRECTORY', realpath(APP_DIRECTORY.'Views').DIRECTORY_SEPARATOR);

		define('APP_ROOT_URL', '/');
	}

	/**
	 * Set up routes used thoughout the system
	 *
	 * @access protected
	 * @return void
	 */
	protected function setup_routes(): void {
		// Initiate Router
	    $router = new App\Router();
	    // include our route definitions
		include CORE_DIRECTORY.'Routes.php';
		// run the router
	    $router->run();
	}
}

// initialise our app
$app = App::init();
