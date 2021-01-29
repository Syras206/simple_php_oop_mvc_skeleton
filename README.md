# simple php oop mvc skeleton

This is a simple framework skeleton to help you get started with your project. No frills, no extra junk you'll end up having to delete.
The only functionality included out-the-box is routing, everything else has been purposely left out for your to add in as you like.

There is no database logic, authentication or security, you'll just find emtpy classes ready for you to fill in.

The framework structure follows the MVC pattern and the code has been written using object oriented PHP.


## Installation

Clone the repository and change the web root of your server to point to /public

## Router
The router is fully functional, but please not that any data passed in is not sanitised - you will need to add that functionality in as you see fit.

### Simple router defenitions
Routes can be set in App/Core/routes.php in the following pattern:

`$router->{{get/put/post/delete}}({{url}}, {{Controller Classname}}@{{Method Name}})`

For example:

```
$router->get('/login', 'Auth@login');
$router->post('/login', 'Auth@process_login');
```

any posted data is passed through to the controller in an array with the 'data' key like this:

```
[
    'data' => [
        // posted data here
    ]
]
```

### Url parameters
Using paramaters in the router can be done like this:

`/foo/::bar::`

For example:

```
$router->get('/hello/::name::', 'Say_Hello@say_hello');
$router->get('/hello/::name::/times/::num_times::', 'Say_Hello@say_hello_times');
```

These paramaters will be passed into the controller as an array with the parameter name as the key like this:

```
[
    'name' => 'John',
    'num_times' => 12,
]
```

## Views and Templates
You define which view and template to use in your controller methods, and pass any data you need into the view.

views can be defined in the following pattern:
`$view = self::load_view('{{view file)}}', {{optional template file}});`

you render the view, along with any data like this:

```
$view->render([
    'foo' => $bar,
]);
```

For example:

```
$view = self::load_view('Say_Hello/say_hello', 'Layout/standard');
$view->title = 'Login';

$view->render([
    'name' => ucfirst($data['name']),
]);
```