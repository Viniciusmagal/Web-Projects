<!DOCTYPE html>
<html lang="pt-br">
<head>
    
<link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <meta charset="utf-8">
    <title>Editar Notícia - Administração do Jornal Etec</title>
    <style>
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
            padding: 20px;
            margin-top: 20px;
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
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .preview-image {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <br><br><br>
    <div class="container">
        <h1>Editar Notícia</h1>
        <?php
        date_default_timezone_set('America/Sao_Paulo');
        // Verifica se o formulário foi enviado para editar a notícia
        if (isset($_POST["editar"]) && isset($_POST["noticiaId"])) {
            // Conexão com o banco de dados (substitua os valores de host, usuário, senha e nome_do_banco)
            $conn = mysqli_connect("localhost", "root", "usbw", "jornal_etec");

            // Verifica se a conexão foi estabelecida com sucesso
            if (!$conn) {
                die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
            }

            // Definir a codificação de caracteres
            mysqli_set_charset($conn, "utf8");

            $noticiaId = $_POST["noticiaId"];

            // Obtém os detalhes da notícia do banco de dados
            $sql = "SELECT tb02_titulo, tb02_conteudo FROM tb02_noticias WHERE tb02_id = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Vincula o parâmetro à instrução preparada como um valor inteiro
                mysqli_stmt_bind_param($stmt, "i", $noticiaId);

                // Executa a instrução preparada
                if (mysqli_stmt_execute($stmt)) {
                    // Associa as colunas do resultado à variáveis
                    mysqli_stmt_bind_result($stmt, $titulo, $conteudo);

                    // Busca o resultado
                    mysqli_stmt_fetch($stmt);

                    // Fecha a instrução preparada
                    mysqli_stmt_close($stmt);
                } else {
                    echo '<div class="mensagem">Erro ao obter detalhes da notícia: ' . mysqli_stmt_error($stmt) . '</div>';
                }
            }

            // Fecha a conexão com o banco de dados
            mysqli_close($conn);
        } else {
            // Redireciona de volta para a página de administração se o formulário não for enviado corretamente
            exit();
        }
        ?>

        <!-- Formulário para editar a notícia -->
       <?php
        date_default_timezone_set('America/Sao_Paulo');
        if (isset($_POST["editar"]) && isset($_POST["noticiaId"])) {
            $conn = mysqli_connect("localhost", "root", "usbw", "jornal_etec");

            if (!$conn) {
                die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
            }

            mysqli_set_charset($conn, "utf8");

            $noticiaId = $_POST["noticiaId"];

            $sql = "SELECT tb02_titulo, tb02_conteudo, tb02_imagem FROM tb02_noticias WHERE tb02_id = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $noticiaId);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_bind_result($stmt, $titulo, $conteudo, $imagemBinaria);

                    if (mysqli_stmt_fetch($stmt)) {
                        mysqli_stmt_close($stmt);
                    } else {
                        echo '<div class="mensagem">Erro ao buscar detalhes da notícia: ' . mysqli_stmt_error($stmt) . '</div>';
                    }
                } else {
                    echo '<div class="mensagem">Erro ao executar a consulta: ' . mysqli_stmt_error($stmt) . '</div>';
                }
            }

            mysqli_close($conn);
        } else {
            exit();
        }
        ?>

        <!-- Formulário para editar a notícia -->
        <form action="edita_postagem.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $noticiaId; ?>">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>" required>
            <label for="conteudo">Conteúdo:</label>
            <textarea name="conteudo" id="conteudo" rows="6" required><?php echo $conteudo; ?></textarea>
            <label for="nova_imagem">Nova Imagem:</label>
            <input type="file" name="nova_imagem" id="nova_imagem">
            <label for="conteudo_adicional">Conteúdo Adicional:</label>
<textarea name="conteudo_adicional" rows="5"></textarea>
            <input type="submit" name="salvar" value="Salvar">
        </form>
    </div>
    <?php include 'rodape.php'?>
</body>
</html>