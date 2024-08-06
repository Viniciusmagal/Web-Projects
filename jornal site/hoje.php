<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Etec - Hoje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            flex-grow: 1;
        }

        .news-container {
            flex: 0 0 calc(100% - 40px);
            margin: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .news-header {
            height: 300px;
            width: 100%;
            padding: 20px;
            color: white;
            text-align: center;
            border-radius: 4px 4px 0 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .news-header:hover {
            transform: scale(1.05);
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
        }

        .news-title a {
            color: #fff;
            text-decoration: none;
        }

        .news-content {
            padding: 20px;
        }

        .date-overlay {
            position: absolute;
            bottom: 1px;
            left: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 16px;
            z-index: 1;
        }

        .empty-news-message {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: black;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; 
    date_default_timezone_set('America/Sao_Paulo');
    ?>
    <div class="container">
        <!-- Loop para exibir as notícias -->
        <?php
            include 'conexao.php'; 
            $sql = "SELECT tb02_id, tb02_titulo, tb02_data_publicacao, tb02_imagem FROM tb02_noticias WHERE DATE(tb02_data_publicacao) = CURDATE() ORDER BY tb02_data_publicacao DESC";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $noticiaId = $row['tb02_id'];
                    $titulo = $row["tb02_titulo"];
                    $data_publicacao = $row["tb02_data_publicacao"];
                    $imagemBinaria = $row["tb02_imagem"];
                    echo '<div class="news-container">';
                    echo '<a href="visualizar_noticia.php?id=' . $noticiaId . '">';
                    echo '<div class="news-header" style="background-image: url(\'data:image/jpeg;base64,' . base64_encode($imagemBinaria) . '\'); background-size: cover;" data-link="visualizar_noticia.php?id=' . $noticiaId . '">';
                    echo '<div class="news-title"><a href="visualizar_noticia.php?id=' . $noticiaId . '">' . $titulo . '</a></div>';
                    echo '<p class="date-overlay">Publicado em: ' . $data_publicacao . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                // Exibir a mensagem "Nenhuma notícia encontrada para hoje" centralizada
                echo '<div style="display: flex; justify-content: center; align-items: center; height: 200px; margin-top: -50px;">';
                echo '<p class="empty-news-message">Nenhuma notícia encontrada para hoje</p>';
                echo '</div>';
            }
        ?>
    </div>
    <?php include 'rodape.php';?>
</body>
</html>
