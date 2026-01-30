<?php

require_once BASE_PATH . '/users/models/md_user.php';

class UserController
{
    private $model;

    public function __construct()
    {
        auth_admin();
        $this->model = new UserModel();
    }

    public function index()
    {
        $users = $this->model->getAll();
        require BASE_PATH . '/users/views/vw_user.php';
    }

    public function store()
    {
        $this->model->store($_POST);
        header("Location: index.php?page=users");
    }
}