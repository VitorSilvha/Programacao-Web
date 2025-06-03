<?php

    $conn = new mysqli("localhost", "root", "", "pontovenda");
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    $nome = $_POST["nome"] ?? '';
    $preco = $_POST["preco"] ?? '';


    $stmt = $conn->prepare("INSERT INTO produtos (nome, preco)
    VALUES (?,?)");

    $stmt->bind_param("ss", $nome, $preco);
    $stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concluido</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f2f2f2;
    padding: 20px;
}
    </style>
</head>
<body>

<div class="resultado">
        <h2>Cadastrado Concluido</h2>
        <p><strong>Nome:</strong> <?= $nome?></p>
        <p> <strong>Preco:</strong> <?= $preco?></p>
   </div>
</body>
</html>