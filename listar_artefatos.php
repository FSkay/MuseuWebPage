<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=biblioteca;
                       charset=utf8",'root', '');
} catch (PDOException $e) {
    die('Error, não pude conectar: ' . $e->getMessage() . '  <br>  ');
}
$metodo =  $_SERVER['REQUEST_METHOD'];
switch ($metodo){
    case 'GET':
        if(isset($_GET['nome'])) {
            $consulta = $pdo->query('SELECT * FROM livro WHERE nome like "%' . $_GET['nome'] . '%" ');
        } else{
            $consulta = $pdo->query('SELECT * FROM tbcadastro_artefatos');
        }
        $_Artefatos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($_Artefatos);
        break;
    case 'POST':
        $entrada = file_get_contents('php://input');
        $artefato = json_decode($entrada);
        $pdo->query("INSERT INTO tbcadastro_artefato(nome, epoca, material, doador, img) values('$artefato->nome', $artefato->epoca, $artefato->material, $artefato->doador, $artefato->img);");
        break;
    case 'PUT':
        $entrada = file_get_contents('php://input');
        $livro = json_decode($entrada);
        $sql = "UPDATE livro SET idmom = $artefato->idmom WHERE idmom = '$artefato->idmom'; ";
        $pdo->query($sql);
        break;
    case 'DELETE':
        $entrada = file_get_contents('php://input');
        $livro = json_decode($entrada);
        $sql = "DELETE FROM tbcadastro_artefato WHERE idmom = '$artefato->idmom'; ";
        $pdo->query($sql);
        break;
}

