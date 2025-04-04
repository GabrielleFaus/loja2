<?php

require_once __DIR__ . '/../../../config/env.php';
require_once __DIR__ . '/../../../model/UsuarioModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuarioModel = new UsuarioModel();

    if (empty($_POST['id'])) {
        // Criar - se não tiver id
        $salvou = $usuarioModel->criar($_POST['nome'], $_POST['email'], $_POST['dataNascimento'], $_POST['cpf']);
    } else {
        // Editar - se tiver id
        $salvou = $usuarioModel->editar([
            'id' => $_POST['id'],
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'dataNascimento' => $_POST['dataNascimento'],
            'cpf' => $_POST['cpf']
        ]);
    }

    if ($salvou) {
        header('Location: ' . APP_CONSTANTS['APP_URL'] . APP_CONSTANTS['PATH_PAGES'] . 'admin/usuario.php');    
    } else {
        echo "ERRO";
    }

} else {
    header('Location: ' . APP_CONSTANTS['APP_URL'] . APP_CONSTANTS['PATH_PAGES'] . 'admin/usuario.php');
}