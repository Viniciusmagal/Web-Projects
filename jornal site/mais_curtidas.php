<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include 'nav.php';?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias Mais Acessadas - Jornal Etec</title>
    <style>
        html {
  position: relative;
  min-height: 100%;
}
        /* Estilos específicos para a página de notícias mais acessadas */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100%;

        }
        .content {
  flex: 1;
}
        
        h1 {
            margin: 0 0 20px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        /* Estilos adicionais para a lista de notícias mais acessadas */
        .news-item {
            flex: 0 0 calc(33.33% - 20px);
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            flex: 0 0 calc(33.33% - 40px);
            margin: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            flex-grow: 1;
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
            position: relative;
            background-repeat: no-repeat;
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
    font-family: Arial, sans-serif; /* Escolha a fonte desejada */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Adiciona uma sombra ao texto */
        }

        /* Estilos responsivos */
        @media only screen and (max-width: 768px) {
            .news-item {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media only screen and (max-width: 576px) {
            .news-item {
                flex: 0 0 calc(100% - 20px);
            }
        }

        /* Estilos para a lista de notícias */
       
        .news-title a {
            color: #fff;
            text-decoration: none;
        }

     /* Estilos hover de notícias */
.news-item:hover .news-header {
    transform: scale(1.05);
    transition: transform 0.3s;
}
        .date-overlay {
            position: absolute;
            bottom: 1px; /* Ajuste a posição vertical conforme necessário */
            left: 20px; /* Ajuste a posição horizontal conforme necessário */
            background-color: rgba(0, 0, 0, 0.7); /* Fundo semitransparente para legibilidade */
            color: white; /* Cor do texto */
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 16px;
            z-index: 1; /* Coloque a data sobre a imagem */
        }
.content {
    z-index: 2;
    margin-bottom: 30px; /* Ajuste a margem inferior conforme necessário */
}


.likes-overlay {
    position: absolute;
    bottom: 4px; /* ou qualquer valor que você achar adequado para a posição vertical */
    right: 20px; /* ajuste para não ficar muito à direita */
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
.empty-news-message {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: black;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="news-list">
        <?php
include 'conexao.php'; 

$sql = "SELECT tb02_id, tb02_titulo, tb02_imagem, tb02_data_publicacao, tb02_curtidas 
    FROM tb02_noticias
    WHERE tb02_curtidas >= 5
    ORDER BY tb02_curtidas DESC 
    LIMIT 5"; // Exibe as 5 notícias mais curtidas (ou menos, se houver menos de 5)

$resultado = $conn->query($sql);


if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $noticiaId = $row['tb02_id'];
        $titulo = $row['tb02_titulo'];
        $imagem = $row['tb02_imagem'];
        $curtidas = $row["tb02_curtidas"];
        $data_publicacao = $row["tb02_data_publicacao"];
        $imagemBase64 = base64_encode($imagem);
        echo '<div class="news-item">';
                    echo '<a href="visualizar_noticia.php?id=' . $noticiaId . '">'; // Abre o link aqui
                    echo '<div class="news-header" style="background-image: url(\'data:image/jpeg;base64,' . $imagemBase64 . '\');">';
                    echo '<h2 class="news-title">' . $titulo . '</h2>';
                    echo '</div>';
                    echo '</a>'; // Fecha o link aqui
                    echo '<p class="date-overlay">Publicado em: ' . $data_publicacao . '</p>';
                    echo '<div class="likes-overlay">Curtidas: ' . $curtidas . '</div>'; 
                    echo '</div>';
    }
} else {
    echo '<p class="empty-news-message">Nenhuma notícia mais curtida encontrada.</p>';
}

$conn->close();
?>
        </div>
    </div>
    <div class="footer">
    <?php include 'rodape.php';?>
    </div>
</body>
</html>