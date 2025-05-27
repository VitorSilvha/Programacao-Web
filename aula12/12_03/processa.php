<?php
function limpar($dado) {
    return htmlspecialchars(trim($dado));
}

$nome = limpar($_POST['nome'] ?? '');
$rua = limpar($_POST['rua'] ?? '');
$numero = limpar($_POST['numero'] ?? '');
$complemento = limpar($_POST['complemento'] ?? '');
$bairro = limpar($_POST['bairro'] ?? '');
$cidade = limpar($_POST['cidade'] ?? '');
$estado = limpar($_POST['estado'] ?? '');
$cep = limpar($_POST['cep'] ?? '');


$foto_name="";
$erro_foto="";

if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
    $extensao_permitida = ['jpg', 'jpeg', 'png', 'gif'];
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    $nome_original = $_FILES['foto']['name'];
    $extensao = strtolower(pathinfo($nome_original, PATHINFO_EXTENSION));

    if(in_array($extensao, $extensao_permitida)){
        $novo_nome = uniqid() . '.' . $extensao;
        $destino = 'uploads/' . $novo_nome;

        if(!is_dir('uploads')){
            mkdir('uploads', 0755, true);
        }
        
        if(move_uploaded_file($arquivo_tmp, $destino)){
            $foto_name = $destino;
        } else {
            $erro_foto = "Erro ao mover a imagem.";
        }
    }else {
        $erro_foto = "Formato de imagem inválido.";
    }
} elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE){
    $erro_foto = "Erro ao fazer upload da imagem.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Endereço</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f2f2f2;
    padding: 20px;
}

.resultado {
    background: white;
    padding: 20px;
    max-width: 600px;
    margin: auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgb(0, 0, 0, 0.1);
}

h2 {
    color: #007bff
}

p {
   margin: 10px 0;
}

img {
    max-width: 200px;
    margin-top: 15px;
    border-radius: 10px;
}

a {
    text-decoration: none;
    color: white;
}

button {
    margin-top: 20px;
    padding: 10px 20px;
    background: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    display: block;
    margin: 0 auto;
}

button:hover {
    background: #0056b3;
    font-size: 14px;
}

button:active {
  background-color: #024286;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
    </style>
</head>
<body>
    <div class="resultado">
        <h2>Endereço Cadastrado:</h2>
        <p><strong>Nome:</strong> <?= $nome?></p>
        <p> <strong>Rua:</strong> <?= $rua?></p>
        <p> <strong>Número:</strong> <?= $numero?></p>
        <p> <strong>Complemento:</strong> <?= $complemento?></p>
        <p> <strong>Bairro:</strong> <?= $bairro?></p>
        <p> <strong>Cidade:</strong> <?= $cidade?></p>
        <p> <strong>Estado:</strong> <?= $estado?></p>
        <p> <strong>CEP:</strong> <?= $cep?></p>

        <?php if($foto_name): ?>
            <p><strong>Foto enviada:</strong></p>
            <img src="<?= $foto_name ?>" alt="Foto de Perfil">
        <?php elseif($erro_foto): ?>
            <p style="color: rede;"><strong>Erro na imagem:</strong> <?= $erro_foto ?></p>
        <?php endif; ?>
        <br><br>
        <button type="submit"><a href="formulario.html">Voltar ao formulário</a></button> 
    </div>
</body>
</html>