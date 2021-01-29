<?php

if (!defined('APP')) { exit; }

// 404
$router->custom_404('Custom_Errors@e404');

// homepage
$router->get('/', 'Under_Construction@under_construction');

// example
$router->get('/hello/::name::', 'Say_Hello@say_hello');
$router->get('/hello/::name::/times/::num_times::', 'Say_Hello@say_hello_times');

// login
$router->get('/login', 'Auth@login');
$router->post('/login', 'Auth@process_login');
$router->get('/logout', 'Auth@logout');

// register
$router->get('/register', 'Auth@register');