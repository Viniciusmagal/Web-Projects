<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'nav.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Jornal Etec - Visualizar Notícia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            line-height: 1.6;
            font-size: 16px;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 60px; 
            margin-top: 20px;
            box-sizing: border-box; /* Nova linha para box-sizing */

        }
        
        h1, h2 {
            color: #333;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            color: #444;
        }
        .date {
            font-size: 14px;
            color: #0a51ae;
        }
        /* Estilos para a seção de comentários */
        .comment-section {
            margin-top: 20px;
        }
        .comentario {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            position: relative;
        }
        /* Estilos para o formulário de comentários */
        .comment-form {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .comment-form textarea {
            width: 100%;
            height: 100px;
            resize: vertical;
            margin-bottom: 10px;
        }
        .comment-form input[type="submit"] {
            background-color: #0a51ae;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }
        .comment-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-login {
            display: inline-block;
            padding: 10px 20px; 
            background-color: #007bff; 
            color: #000; 
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0056b3; 
            color: #000; 
        }
        .btn-excluir-comentario {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 6px 10px; 
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            position: absolute;
            bottom: 10px; 
            right: 10px; 
        }
        
        .btn-excluir-comentario:hover {
            background-color: #cc0000; 
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
  
}

.container {
  display: block;
  position: relative;
  cursor: pointer;
  user-select: none;
}

svg {
  position: relative;
  top: 0;
  left: 0;
  height: 30px;
  width: 30px;
  transition: all 0.3s;
  fill: #666;
}

svg:hover {
  transform: scale(1.1) rotate(-10deg);
}

.container input:checked ~ svg {
  fill: #2196F3;
}

.enviar-comentario {
            background-color: #0a51ae;
            color: white;
            border: none;
            padding: 6px 10px; 
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            position: absolute;
            bottom: 110px; 
            right: 20px; 
        }

    </style>  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<body>
    <div class="container">
        <?php
        include 'conexao.php';
        // Verifica se o parâmetro de ID da notícia está presente na URL
        if (isset($_GET['id'])) {
            // Obtém o ID da notícia da URL
            $noticiaId = $_GET['id'];

// Atualiza o contador de visualizações no banco de dados
$sqlUpdateViews = "UPDATE tb02_noticias SET tb02_visualizacoes = tb02_visualizacoes + 1 WHERE tb02_id = ?";
$stmtUpdateViews = $conn->prepare($sqlUpdateViews);

if ($stmtUpdateViews) {
    $stmtUpdateViews->bind_param("i", $noticiaId);
    $stmtUpdateViews->execute();
}

            // Prepara a consulta SQL para obter os detalhes da notícia com base no ID
            $sql = "SELECT tb02_titulo, tb02_conteudo, tb02_conteudo_adicional, tb02_data_publicacao, tb02_imagem, tb02_visualizacoes, tb02_curtidas  FROM tb02_noticias WHERE tb02_id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Vincula o parâmetro à instrução preparada como um valor inteiro
                $stmt->bind_param("i", $noticiaId);

                // Executa a instrução preparada
                $stmt->execute();

                // Armazena os resultados da consulta
                $stmt->store_result();

                // Verifica se a notícia foi encontrada
                if ($stmt->num_rows > 0) {
                    // Recupera os resultados da consulta
                    $stmt->bind_result($titulo, $conteudo, $conteudoAdicional, $data_publicacao, $imagemBinaria, $numVisualizacoes, $numCurtidas);
                    // Recupera a primeira (e única) linha de resultados
                    $stmt->fetch();
                    // Exibe os detalhes da notícia
                    echo '<h1>' . $titulo . '</h1>';
                    // Exibe a imagem da notícia, se estiver definida
                    if ($imagemBinaria) {
                        $imagemBase64 = base64_encode($imagemBinaria);
                        echo '<img src="data:image/jpeg;base64,' . $imagemBase64 . '" alt="Imagem da Notícia">';
                    }
                    echo '<p>' . $conteudo . '</p>';
                    // Exibe o conteúdo adicional, se estiver definido
                    if ($conteudoAdicional) {
                        echo '<p>' . $conteudoAdicional . '</p>';
                    }
                    // Consulta ao banco de dados para obter os comentários da notícia específica
                    $comentariosSql = "SELECT tb03_id, tb03_comentario, tb03_data, tb03_usuario_email,tb01_nome
                    FROM tb03_comentarios
                    LEFT JOIN tb01_usuarios ON tb03_usuario_email = tb01_email
                    WHERE tb03_id_noticia = ?";

                    $stmtComentarios = $conn->prepare($comentariosSql);

                    if ($stmtComentarios) {
                        // Vincula o parâmetro à instrução preparada como um valor inteiro
                        $stmtComentarios->bind_param("i", $noticiaId);

                        // Executa a instrução preparada
                        $stmtComentarios->execute();

                        // Armazena os resultados da consulta
                        $resultadoComentarios = $stmtComentarios->get_result();

                        if ($resultadoComentarios) {
                            if ($resultadoComentarios->num_rows > 0) {
                                echo '<div class="comment-section">';
                                echo '<h2>Comentários:</h2>';

                                while ($comentarioRow = $resultadoComentarios->fetch_assoc()) {
                                    $comentarioId = $comentarioRow['tb03_id'];
                                    $comentario = $comentarioRow['tb03_comentario'];
                                    $dataComentario = $comentarioRow['tb03_data'];
                                    $usuarioNome = $comentarioRow['tb01_nome']; // Adicione esta linha
                                    echo '<div class="comentario">';
                                    echo '<p>' . $comentario . '</p>';
                                    echo '<p class="date">Publicado por: ' . $usuarioNome . ' em ' . $dataComentario . '</p>';
                                    // Adicione um botão de exclusão de comentário, se necessário
                                    echo '<button class="btn-excluir-comentario" data-comentario-id="' . $comentarioId . '">Excluir</button>';
                                    
                                    echo '</div>';
                                }
                                
                                echo '</div>';
                            } else {
                                echo '<p>Nenhum comentário encontrado.</p>';
                            }
                        } else {
                            echo '<p>Erro na consulta de comentários: ' . $conn->error . '</p>';
                        }
                        $stmtComentarios->close();
                    } else {
                        echo '<p>Erro na preparação da consulta de comentários: ' . $conn->error . '</p>';
                    }
             // Exibir formulário para inserir comentários, somente se o usuário estiver logado
                    if (isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] === true) {
                        echo '<div class="comment-form">';
                        echo '<h2>Deixe um comentário:</h2>';
                        echo '<form method="POST" id="comment-form" action="inserir_comentario.php">';
                        echo '<input type="hidden" name="noticiaId" value="' . $noticiaId . '">';
                        echo '<textarea name="comentario" placeholder="Digite seu comentário" required></textarea><br>';
                        echo '<button type="submit" value="Enviar Comentário" class="enviar-comentario ">Enviar</button>';
                        echo '<br><br>';
                        echo '</form>';
                        echo '</div>';
                    } else {
                        echo '<p>Acesse sua Conta de estudante e participe da conversa</p>';
                        echo '<a href="login_usuario.php" class="btn-login">Clique aqui para fazer login</a>';
                    }
                } else {
                    echo '<div style="text-align: center; margin-top: 30px;">';
                    echo '<h2>Nenhuma notícia encontrada.</h2>';
                    echo '</div>';
                }
                // Fecha a instrução preparada
                $stmt->close();
            } else {
                echo '<p>Erro na preparação da consulta: ' . $conn->error . '</p>';
            }
            $conn->close();
        } else {
            echo '<p>ID da notícia não especificado.</p>';
        }
        // Exibir o botão "Curtir" somente se o usuário estiver logado
        if (isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] === true) {
    
          echo'  <label>';
          echo '<input type="checkbox" id="like-button">';
          echo '<svg id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M29.845,17.099l-2.489,8.725C26.989,27.105,25.804,28,24.473,28H11c-0.553,0-1-0.448-1-1V13  c0-0.215,0.069-0.425,0.198-0.597l5.392-7.24C16.188,4.414,17.05,4,17.974,4C19.643,4,21,5.357,21,7.026V12h5.002  c1.265,0,2.427,0.579,3.188,1.589C29.954,14.601,30.192,15.88,29.845,17.099z" id="XMLID_254_"></path><path d="M7,12H3c-0.553,0-1,0.448-1,1v14c0,0.552,0.447,1,1,1h4c0.553,0,1-0.448,1-1V13C8,12.448,7.553,12,7,12z   M5,25.5c-0.828,0-1.5-0.672-1.5-1.5c0-0.828,0.672-1.5,1.5-1.5c0.828,0,1.5,0.672,1.5,1.5C6.5,24.828,5.828,25.5,5,25.5z" id="XMLID_256_"></path></svg>';
          echo '<span id="likes-count">' . $numCurtidas . '</span> curtidas';
          echo '</label>';
          
        } else {
            echo '<p>Acesse sua Conta de estudante para curtir esta notícia</p>';
            echo '<a href="login_usuario.php" class="btn-login">Clique aqui para fazer login</a>';
        }
        echo '<p class="date">Publicado em: ' . date('d/m/Y H:i', strtotime($data_publicacao)) . '</p>';
        ?>
    </div>
    <?php include 'rodape.php';?>
    <script>
        $(document).ready(function () {
            var likeActive = false;
            var noticiaId = <?php echo $noticiaId; ?>;

            $('#like-button').click(function () {
                likeActive = !likeActive;
                $(this).prop('disabled', true); 


                if (likeActive) {
                    $.ajax({
                        type: 'POST',
                        url: 'atualizar_curtidas.php',
                        data: {
                            noticiaId: noticiaId
                        },
                        success: function (response) {
                            $('#likes-count').text(response);
                        },
                        error: function () {
                            alert('Erro ao curtir a notícia. Por favor, tente novamente.');
                        }
                    });
                }
            });

            $('#comment-form').submit(function (e) {
                e.preventDefault();

                var comentario = $('textarea[name="comentario"]').val();

                $.ajax({
                    type: 'POST',
                    url: 'inserir_comentario.php',
                    data: {
                        comentario: comentario,
                        noticiaId: noticiaId
                    },
                    success: function (response) {
                        $('textarea[name="comentario"]').val('');
                        var commentSection = $('.comment-section');
                        commentSection.append('<div class="comentario"><p>' + comentario + '</p>' +
                            '<button class="btn-excluir-comentario" data-comentario-id="' + response.commentId + '">Excluir</button></div>');

                        $('html, body').animate({
                            scrollTop: commentSection.offset().top + commentSection.height()
                        }, 1000);

                        alert('Comentário enviado com sucesso!');
                    },
                    error: function () {
                        alert('Erro ao enviar o comentário. Por favor, tente novamente.');
                    }
                });
            });

            $(document).on('click', '.btn-excluir-comentario', function () {
                var comentarioId = $(this).data('comentario-id');

                if (confirm('Tem certeza de que deseja excluir este comentário?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'excluir_comentario.php',
                        data: {
                            comentarioId: comentarioId
                        },
                        success: function (response) {
                            if (response === 'sucesso') {
                                $('.btn-excluir-comentario[data-comentario-id="' + comentarioId + '"]').parent().remove();
                            } else {
                                alert('Comentário excluído com sucesso');
                            }
                        },
                        error: function () {
                            alert('Erro ao excluir o comentário. Por favor, tente novamente.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>