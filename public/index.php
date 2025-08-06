<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Database.php';

spl_autoload_register(function ($class) {
    // Thay \ thành / cho namespace
    $path = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';

    // Nếu không tìm thấy, thử trong app/core/ với tên class
    if (!file_exists($path)) {
        $className = basename(str_replace('\\', '/', $class));
        $path = __DIR__ . '/../app/core/' . $className . '.php';
    }

    if (file_exists($path)) {
        require_once $path;
    }
});


// Khởi tạo Router
$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/user/{id}', 'UserController@show');

// Xử lý request
$router->dispatch();


