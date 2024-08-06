<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <?php include 'nav.php';?>
    <meta charset="utf-8">
    <title>Minhas Curtidas</title>
    <style>
        /* Estilos da página de Minhas Curtidas */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            margin: 0 0 20px;
            color: #333;
            font-size: 24px;
            text-align: center; /* Centraliza o título */
        }

        /* Estilos para o card de notícia */
        .news-container {
            flex: 0 0 calc(100% - 40px);
            margin: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            flex-grow: 1;
        }

        .news-title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(10, 81, 174, 0.7);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 24px;
            text-align: center;
            font-family: 'Arial', sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .news-content {
            padding: 20px;
        }

        .news-header {
            position: relative;
            height: 300px;
            width: 100%;
            padding: 20px;
            color: white;
            text-align: center;
            border-radius: 4px 4px 0 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: transform 0.3s, z-index 0s 0.3s;
        }

        .date-overlay {
            position: absolute;
            bottom: -5px;
            left: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 16px;
            z-index: 1;
        }

        .likes-overlay {
            position: absolute;
            bottom: 4px;
            right: 70px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 16px;
            z-index: 2;
        }

        .empty-news {
            text-align: center;
            background: transparent; /* Fundo transparente */
            padding: 20px;
        }

        .empty-news-message {
            color: #333;
            font-size: 18px;
        }

        /* Estilos responsivos */
        @media only screen and (min-width: 576px) {
            body {
                font-size: 16px;
            }

            .news-container {
                border-radius: 8px;
            }
        }

        @media only screen and (max-width: 992px) {
            .news-header {
                height: 250px;
            }
        }

        @media only screen and (max-width: 768px) {
            .date-overlay,
            .likes-overlay {
                font-size: 0.75rem;
                padding: 3px 6px;
            }

            .news-header {
                height: 200px;
            }
        }

        @media only screen and (max-width: 576px) {
            .news-title {
                font-size: 1.5rem;
                padding: 5px;
            }

            .news-header {
                height: 150px;
            }
        }
    </style>
</head>
<body style="overflow-x: hidden;">

    <!-- Loop para exibir as notícias curtidas -->
    <?php
    // Aqui, você precisa fazer a conexão com o banco de dados e obter os dados das notícias curtidas pelo usuário
    include 'conexao.php';
    $usuarioEmail = $_SESSION['email']; // Certifique-se de que a sessão do usuário está configurada corretamente

    // Consulta SQL para obter as notícias curtidas pelo usuário
    $sql = "SELECT tb02_id, tb02_titulo, tb02_data_publicacao, tb02_imagem, tb02_curtidas FROM tb02_noticias WHERE tb02_usuarios_curtiram LIKE '%$usuarioEmail%' ORDER BY tb02_data_publicacao DESC";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $noticiaId = $row['tb02_id'];
            $titulo = $row["tb02_titulo"];
            $data_publicacao = $row["tb02_data_publicacao"];
            $imagemBinaria = $row["tb02_imagem"];
            $curtidas = $row["tb02_curtidas"];

            echo '<div class="news-container">';
            echo '<a href="visualizar_noticia.php?id=' . $noticiaId . '">';
            echo '<div class="news-header" style="background-image: url(\'data:image/jpeg;base64,' . base64_encode($imagemBinaria) . '\');" data-link="visualizar_noticia.php?id=' . $noticiaId . '">';
            echo '<h2 class="news-title">' . $titulo . '</h2>';
            echo '<p class="date-overlay">Publicado em: ' . $data_publicacao . '</p>';
            echo '<div class="likes-overlay">Curtidas: ' . $curtidas . '</div>'; 

            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo '<div class="news-container empty-news">
        <p class="empty-news-message">Você não curtiu nenhuma notícia ainda.</p>
    </div>';
    }
    $conn->close();
    include 'rodape.php';
    ?>
</body>
</html>
