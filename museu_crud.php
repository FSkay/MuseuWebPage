<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=dbmuseu;
                       charset=utf8", 'root', '');
    $metodo = $_SERVER['REQUEST_METHOD'];
    switch ($metodo) {
        case 'GET':
            if (isset($_GET['nome'])) {
                $consulta = $pdo->query('SELECT * FROM tbcadastro_artefato WHERE nome like "%' . $_GET['nome'] . '%" ');
            } else {
                $consulta = $pdo->query('SELECT * FROM tbcadastro_artefato');
            }
            $artefato = $consulta->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($artefato);
            break;
        case 'POST':
            $entrada = file_get_contents('php://input');
            $artefato = json_decode($entrada);
            $pdo->query("INSERT INTO tbcadastro_artefato(nome, epoca, material, doador, img) values('$artefato->nome', $artefato->epoca, $artefato->material, $artefato->doador, $artefato);");
            break;
        case 'PUT':
            $entrada = file_get_contents('php://input');
            $artefato = json_decode($entrada);
            $sql = "UPDATE tbcadastro_artefato SET nome = '$artefato->nome', epoca = '$artefato->epoca', material = $artefato->ma, bairro = '$cliente->bairro'  WHERE id = $cliente->id; ";
            $pdo->query($sql);
            break;
        case 'DELETE':
            $entrada = file_get_contents('php://input');
            $cliente = json_decode($entrada);
            $sql = "DELETE FROM tbcadastro_artefato WHERE id = '$cliente->id'; ";
            $pdo->query($sql);
            $consulta = $pdo->query('SELECT * FROM cliente');
            $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($clientes);
            break;
    }
} catch (Exception $e) {
    file_put_contents('exception.txt', print_r($e, true), FILE_APPEND);
}