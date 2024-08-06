<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <?php 
    // Inicie ou retome a sessão
session_start();
// Verificar se o admin está logado
if (!isset($_SESSION["administrador"])) {
    // Redirecionar para a página de login se o admin não estiver logado
    header("Location: loginadm.php");
    exit; 
}
include 'nav.php';
     ?>

    <meta charset="utf-8">
    <title>Administração do Jornal Etec - Adicionar Notícia</title>
    <style>
        /* Estilos da página de adicionar notícia */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;

        }
        .content {
        flex-grow: 1;
        padding: 6px;
    }

    h1 {
        margin: 0 0 20px;
        color: #333;
        font-size: 24px;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="file"] {
        margin-top: 5px;
    }

    input[type="submit"] {
        background-color: white;
        color: white;
        padding: 9px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        font-weight: bold;
        text-transform: uppercase;
        transition: background-color 0.3s;
        color: black; /* Definir a cor do texto como preto */

    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .preview-image {
        margin-top: 10px;
        max-width: 100%;
        height: auto;
    }

  
    /* Estilos adicionais para o layout de notícias */
    .news-container {
        max-width: 800px;
        margin: auto;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .news-header {
        padding: 20px;
        background-color: #007bff;
        color: white;
        text-align: center;
        border-radius: 4px 4px 0 0;
    }

    .news-title {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .news-content {
        padding: 20px;
    }

    .news-image {
        max-width: 100%;
        height: auto;
        display: block;
        margin-top: 10px;
    }
</style>
</head>
<body>
    <div class="content">
        <h1>Administração do Jornal Etec - Adicionar Notícia</h1>
        <form action="processar_postagem.php" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>
            <label for="conteudo">Conteúdo:</label>
        <textarea name="conteudo" rows="5" required></textarea>

        <label for="imagem">Imagem:</label>
    <!-- aceita só arquivos de imagem ao dropar o arquivo -->
<input type="file" name="imagem" id="imagemInput" accept="image/*">
<div class="preview-image" id="previewImage"></div>

<label for="conteudo_adicional" name="conteudo_adicional">Conteúdo Adicional:</label>
<textarea name="conteudo_adicional" rows="5"></textarea>

<input type="submit" value="Publicar">
    </form>
</div>
<script>
    // Exibir a pré-visualização da imagem selecionada
    const previewImage = document.getElementById('previewImage');
    const imagemInput = document.querySelector('input[name="imagem"]');

    // Adicionar suporte para arrastar e soltar imagens
    previewImage.addEventListener('dragover', function (e) {
        e.preventDefault();
    });

    previewImage.addEventListener('drop', function (e) {
        e.preventDefault();

        // Obter a imagem arrastada
        const file = e.dataTransfer.files[0];

        // Ler a imagem
        const reader = new FileReader();

        reader.onloadend = function () {
            const img = new Image();
            img.src = reader.result;
            previewImage.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
</script>
<?php include 'rodape.php';?>
</body>
</html>