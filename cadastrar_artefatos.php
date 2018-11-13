<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form method="post" action="cadastrar_artefatos.php">
    Nome: <input type="text" name="nome" id="nome"> <br>
    
    epoca: <input type="number" name="epoca" id="epoca"><br>
    
    Doador: <input type="text" name="doador" id="doador"><br>
    
    Imagem: <input type="image" name="img" id="img"><br>
    <input type="submit" value="Cadastrar">
</form>
<?php
if (isset($_POST['nome'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=dbmuseu;
                            charset=utf8", 'root', '');
    } catch (PDOException $e) {
        die('Error, não pude conectar: ' . $e->getMessage() . '  <br>  ');
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $strInserir = "INSERT INTO livro(nome, epoca, material, doador, img) VALUES(:nome, :epoca, :material, :doador, :img)";
    $comando = $pdo->prepare($strInserir, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $comando->execute(array(':nome' => $_POST['nome'],
        ':epoca' => $_POST['epoca'],
        ':material' => $_POST['epoca'],
        ':doador' => $_POST['doador'],
        ':img' => $_POST['img']));
}
?>

<br>
</body>
</html>



