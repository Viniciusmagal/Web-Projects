<meta charset="utf-8">
<?php
    date_default_timezone_set('America/Sao_Paulo');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o formulário foi submetido via método POST
    // Obtém os dados do formulário
    $noticiaId = $_POST['noticiaId'];
    $comentario = $_POST['comentario'];
    include 'conexao.php';
    // Prepara a consulta SQL para inserir o comentário na tabela de comentários
    $inserirComentarioSql = "INSERT INTO tb03_comentarios (tb03_id_noticia, tb03_comentario) VALUES (?, ?)";
    $stmtInserirComentario = $conn->prepare($inserirComentarioSql);

    if ($stmtInserirComentario) {
        // Vincula os parâmetros à instrução preparada
        $stmtInserirComentario->bind_param("is", $noticiaId, $comentario);

        // Executa a instrução preparada
        if ($stmtInserirComentario->execute()) {
            echo '<p>Comentário adicionado com sucesso!</p>';
        } else {
            echo '<p>Erro ao adicionar o comentário: ' . $conn->error . '</p>';
        }

        // Fecha a instrução preparada
        $stmtInserirComentario->close();
    } else {
        echo '<p>Erro na preparação da consulta para adicionar o comentário: ' . $conn->error . '</p>';
    }

    $conn->close();
} else {
    echo '<p>O formulário foi enviado incorretamente.</p>';
}
?>