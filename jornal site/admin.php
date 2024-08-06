<?php
 // Inicie ou retome a sessão
 session_start();
 // Verificar se o admin está logado
 if (!isset($_SESSION["administrador"])) {
     // Redirecionar para a página de login se o admin não estiver logado
     header("Location: loginadm.php");
     exit; // Certifique-se de sair após o redirecionamento
 }

if(isset($_POST['continuar'])) {
    $selectedOption = $_POST['acao'];

    if ($selectedOption === "adicionar") {
        header("Location: adicionar_noticia.php");
        exit();
    } elseif ($selectedOption === "editar") {
        header("Location: editar_noticia.php");
        exit();
    } elseif ($selectedOption === "excluir") {
        header("Location: excluir_noticia.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<meta charset="utf-8">
    <title>Administração do Jornal Etec</title>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .noticia {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            background-color: #fff;
        }

        .noticia h2 {
            margin: 0;
            font-size: 18px;
            cursor: pointer;
            color: #4285f4;
            text-decoration: none;
        }

        .noticia h2:hover {
            text-decoration: underline;
        }

        .noticia .conteudo {
            margin-top: 10px;
            color: #555;
            font-size: 16px;
        }

        .noticia p.data {
            margin: 0;
            font-size: 14px;
            color: #888;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0a51ae;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0a51ae;
        }

        .acoes-noticia {
            margin-top: 10px;
        }

        .acao {
            display: inline-block;
            margin-right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Espaçamento vertical entre as notícias */
        .noticia + .noticia {
            margin-top: 20px;
        }
        
        
    </style>
    <script>
        // Função para exibir/ocultar o conteúdo da notícia ao clicar no título
        function toggleContent(noticiaId) {
            var conteudo = document.getElementById("conteudo-" + noticiaId);
            if (conteudo.style.display === "none") {
                conteudo.style.display = "block";
            } else {
                conteudo.style.display = "none";
            }
        }

        function excluirNoticia(noticiaId) {
        if (confirm("Tem certeza de que deseja excluir esta notícia?")) {
            // Enviar uma requisição para excluir a notícia usando AJAX
            $.ajax({
                type: "POST",
                url: "excluir_noticia.php",
                data: { noticiaId: noticiaId },
                success: function (response) {
                    // Notifique o usuário sobre a exclusão
                    alert("Notícia excluída com sucesso!");
                    // Remova a notícia da página
                    document.getElementById("conteudo-" + noticiaId).style.display = "none";
                },
                error: function (xhr, status, error) {
                    alert("Erro ao excluir a notícia: " + error);
                }
            });
        }
    }
    </script>
</head>
<body>
    <?php include 'nav.php'; ?>
    <br>
    <div class="container">
    <div style="text-align: center; margin-bottom: 20px;">
            <img src="imagens/logo.png" alt="Imagem do Jornal Etec" style="max-width: 20%; height: auto;">
        </div>
        <h1>Administração do Jornal Etec</h1>
        
        <!-- exibir as notícias -->
        <?php
        $conn = mysqli_connect("localhost", "root", "usbw", "jornal_etec");
        if (!$conn) {
            die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }
        mysqli_set_charset($conn, "utf8");

        $sql = "SELECT tb02_id, tb02_titulo, tb02_conteudo, tb02_data_publicacao FROM tb02_noticias ORDER BY tb02_data_publicacao DESC";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $noticiaId = $row["tb02_id"];
                $titulo = $row["tb02_titulo"];
                $conteudo = $row["tb02_conteudo"];
                $dataPublicacao = $row["tb02_data_publicacao"];

                echo '<div class="noticia">';
                echo '<h2 onclick="toggleContent(' . $noticiaId . ')">' . $titulo . '</h2>';
                echo '<div class="conteudo" id="conteudo-' . $noticiaId . '" style="display: none;">' . $conteudo . '</div>';
                echo '<p class="data">Data de Publicação: ' . $dataPublicacao . '</p>';

                echo '<a href="visualizar_noticia.php?id=' . $noticiaId . '">Visualizar Notícia</a>';

                echo '<div class="acoes-noticia">';
                echo '<form action="editar_noticia.php" method="post" style="display: inline-block;">';
                echo '<input type="hidden" name="noticiaId" value="' . $noticiaId . '">';
                echo '<input type="submit" name="editar" value="Editar">';
                echo '</form>';
                
                echo '<form action="excluir_noticia.php" method="post" style="display: inline-block;" name="excluir-noticia-form">';
                echo '<input type="hidden" name="noticiaId" value="' . $noticiaId . '">';
                echo '<input type="submit" name="excluir-noticia-form" value="Excluir">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhuma notícia encontrada.</p>';
        }
        mysqli_close($conn);
        ?>
        <!-- Formulário para adicionar, editar ou excluir uma notícia -->
        <form id="acaoForm" method="post">
    <label for="acao">Escolha uma ação:</label>
    <select name="acao">
        <option value="adicionar">Adicionar Notícia</option>
        <option value="editar">Editar Notícia</option>
        <option value="excluir">Excluir Notícia</option>
    </select>
    <input type="submit" value="Continuar" name="continuar">
</form>
    </div>
    <?php include 'rodape.php' ?>
</body>
</html>