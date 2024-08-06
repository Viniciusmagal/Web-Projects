<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <?php include 'nav.php';?>
    <meta charset="utf-8">
    <title>Inicio</title>
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
        }

        h1 {
            margin: 0 0 20px;
            color: #333;
            font-size: 24px;
            text-align: center; /* Centraliza o título */
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
            max-height: 300px;
            display: block;
        }

        /* Estilos adicionais para o layout de notícias */
        .news-container {
            flex: 0 0 calc(100% - 40px);
            margin: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            position: relative; /* Adicionado para posicionamento absoluto */
            overflow: hidden; /* Para garantir que a imagem não transborde */
            flex-grow: 1; /* Expande o conteúdo para preencher o espaço restante */

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
    font-family: 'Arial', sans-serif; /* Escolha a fonte desejada */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Adiciona uma sombra ao texto */
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
            bottom: -5px; /* Ajuste a posição vertical conforme necessário */
            left: 30px; /* Ajuste a posição horizontal conforme necessário */
            background-color: rgba(0, 0, 0, 0.7); /* Fundo semitransparente para legibilidade */
            color: white; /* Cor do texto */
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 16px;
            z-index: 1; /* Coloque a data sobre a imagem */
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

        @media only screen and (min-width: 768px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .news-content {
                font-size: 18px;
            }
        }

        @media only screen and (min-width: 992px) {
            .news-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media only screen and (max-width: 992px) {
    .news-header {
        height: 250px; /* Altura ajustada para telas médias */
    }
}

        .news-title a {
            color: #fff;
            text-decoration: none;
        }

        .news-container:hover .news-header {
            transform: scale(1.05);
            transition: transform 0.3s;
            z-index: 0;
        }
        .likes-overlay {
    position: absolute;
    bottom: 4px; /* ou qualquer valor que você achar adequado para a posição vertical */
    right: 70px; /* ajuste para não ficar muito à direita */
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 10px; /* ajuste o padding se necessário para mais espaço interno */
    border-radius: 4px;
    font-size: 16px;
    z-index: 2;
}
.date-overlay,
.likes-overlay {
    position: absolute;
    padding: 0.3125rem 0.625rem; /* 5px 10px convertido para rem */
    border-radius: 0.25rem; /* 4px convertido para rem */
    font-size: 1rem; /* 16px convertido para rem */
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    z-index: 10;
}

@media only screen and (max-width: 768px) {
    .date-overlay, .likes-overlay {
        font-size: 0.75rem; /* Fonte menor para telas pequenas */
        padding: 3px 6px; /* Padding reduzido para economizar espaço */
    }

    .news-header {
        height: 200px; /* Altura ajustada para telas pequenas */
    }
}@media only screen and (max-width: 768px) {
    .date-overlay, .likes-overlay {
        font-size: 0.75rem; /* Fonte menor para telas pequenas */
        padding: 3px 6px; /* Padding reduzido para economizar espaço */
    }

    .news-header {
        height: 200px; /* Altura ajustada para telas pequenas */
    }
}

@media only screen and (max-width: 576px) {
    .news-title {
        font-size: 1.5rem; /* Título com fonte menor para telas pequenas */
        padding: 5px; /* Padding reduzido para economizar espaço */
    }

    .news-header {
        height: 150px; /* Altura ainda menor para telas muito pequenas */
    }
}
@media only screen and (max-width: 768px) {
    .news-header {
        height: 25vh; /* Altura ajustada para telas médias */
        min-height: 150px; /* Altura mínima ajustada para telas médias */
    }
}

@media only screen and (max-width: 576px) {
    .news-header {
        height: 20vh; /* Altura ajustada para telas pequenas */
        min-height: 120px; /* Altura mínima ajustada para telas pequenas */
    }
}
    </style>
</head>
<body style="overflow-x: hidden;">

    <!-- Loop para exibir as notícias -->
    <?php
    // Aqui, você precisa fazer a conexão com o banco de dados e obter os dados das notícias
    include 'conexao.php';
    $sql = "SELECT tb02_id, tb02_titulo, tb02_data_publicacao, tb02_imagem, tb02_curtidas FROM tb02_noticias ORDER BY tb02_data_publicacao DESC";
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
        <p class="empty-news-message">Nenhuma notícia disponível no momento.</p>
    </div>';
    }
    $conn->close();
    include 'rodape.php'
    ?>
</body>
</html>