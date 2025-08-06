<?php
class Router
{
    // protected $routes = [];

    // // Đăng ký route
    // public function get($path, $callback)
    // {
    //     $this->routes['GET'][$path] = $callback;
    // }

    // // Xử lý request
    // public function dispatch()
    // {
    //     $url = isset($_GET['url']) ? '/' . trim($_GET['url'], '/') : '/';
    //     $method = $_SERVER['REQUEST_METHOD'];

    //     foreach ($this->routes[$method] as $route => $callback) {
    //         // Thay thế {param} bằng regex
    //         $route = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_]+)', $route);
    //         if (preg_match('#^' . $route . '$#', $url, $matches)) {
    //             array_shift($matches); // Bỏ phần khớp toàn bộ
    //             return $this->callAction($callback, $matches);
    //         }
    //     }

    //     // 404 nếu không tìm thấy route
    //     header('HTTP/1.1 404 Not Found');
    //     echo '404 - Page not found';
    // }

    protected $routes = [
        'GET' => [],
        'POST' => [],
        // Thêm các phương thức khác nếu cần, ví dụ: 'PUT', 'DELETE'
    ];

    // Đăng ký route
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    // Hàm dispatch như trên
    public function dispatch()
    {
        $url = isset($_GET['url']) ? '/' . trim($_GET['url'], '/') : '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method]) && is_array($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $callback) {
                $route = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_]+)', $route);
                if (preg_match('#^' . $route . '$#', $url, $matches)) {
                    array_shift($matches);
                    return $this->callAction($callback, $matches);
                }
            }
        }

        header('HTTP/1.1 404 Not Found');
        echo '404 - Page not found';
    }

    // Gọi controller và method
    protected function callAction($callback, $params)
    {
        list($controller, $method) = explode('@', $callback);
        $controller = "Controllers\\$controller";
        if (class_exists($controller)) {
            $controllerObj = new $controller();
            if (method_exists($controllerObj, $method)) {
                return call_user_func_array([$controllerObj, $method], $params);
            }
        }
        throw new Exception("Controller or method not found");
    }
}
