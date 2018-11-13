<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=dbmuseu;
                       charset=utf8",'root', '');
} catch (PDOException $e) {
    die('Error, não pude conectar: ' . $e->getMessage() . '  <br>  ');
}
$metodo =  $_SERVER['REQUEST_METHOD'];
switch ($metodo){
    case 'GET':
        if(isset($_GET['nome'])) {
            $consulta = $pdo->query('SELECT * FROM tbcadastro_artefato WHERE nome like "%' . $_GET['nome'] . '%" ');
        } else{
            $consulta = $pdo->query('SELECT * FROM tbcadastro_artefato');
        }
        $_Artfatos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($_Livros);
        break;
    case 'POST':
        $entrada = file_get_contents('php://input');
        $artefato = json_decode($entrada);
        $pdo->query("INSERT INTO tbcadastro_artefato(nome, epoca, material, doador, img) values('$artefato->nome', $artefato->epoca, $artefato->material, $artefato->doador, $artefato); ");
        break;
    case 'PUT':
        $entrada = file_get_contents('php://input');
        $livro = json_decode($entrada);
        $sql = "UPDATE livro SET ano = $livro->ano WHERE nome = '$artefato->nome'; ";
        $pdo->query($sql);
        break;
    case 'DELETE':
        $entrada = file_get_contents('php://input');
        $artefato = json_decode($entrada);
        $sql = "DELETE FROM livro WHERE nome = '$livro->nome'; ";
        $pdo->query($sql);
        break;
}
