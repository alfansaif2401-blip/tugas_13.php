<?php
require_once BASE_PATH . '/tamu/models/md_tamu.php';

class TamuController
{
    private $model;

    public function __construct()
    {
        auth_login();
        $this->model = new Md_tamu();
    }

    public function index()
    {
        $tamu = $this->model->getAll();
        require BASE_PATH . '/tamu/views/vw_tamu.php';
    }

    public function store()
    {
        $this->model->store($_POST);
        header("Location: index.php?page=tamu");
    }

    public function edit()
    {
        return $this->model->find($_GET['id']);
    }

    public function update()
    {
        $this->model->update($_POST);
        header("Location: index.php?page=tamu");
    }

    public function destroy()
    {
        $this->model->delete($_GET['id']);
        header("Location: index.php?page=tamu");
    }
}