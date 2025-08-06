<?php

namespace Controllers;

use Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function show($id)
    {
        // Validate id
        if (!is_numeric($id) || $id <= 0) {
            header('HTTP/1.1 404 Not Found');
            echo 'Invalid user ID';
            exit;
        }

        // Lấy user từ repository
        $user = $this->userRepository->findById($id);

        // Kiểm tra user có tồn tại
        if (!$user) {
            header('HTTP/1.1 404 Not Found');
            echo 'User not found';
            exit;
        }

        // Chuẩn bị dữ liệu cho view
        $data = [
            'title' => 'User Profile',
            'user' => $user
        ];

        // Load view hiện tại
        $this->view('home/index', $data);
    }
}
