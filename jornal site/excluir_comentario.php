<?php
session_start();

if (!isset($_SESSION['usuarioLogado']) || $_SESSION['usuarioLogado'] !== true) {
    // Verifique se o usuário está logado antes de permitir a exclusão do comentário
    header('Location: login_usuario.php');
    exit;
}

if (isset($_POST['comentarioId'])) {
    $comentarioId = $_POST['comentarioId'];

    include 'conexao.php';

    // Verifique se o comentário pertence ao usuário logado
    $verificarComentarioSql = "SELECT tb03_id FROM tb03_comentarios WHERE tb03_id = ?";
    $stmtVerificarComentario = $conn->prepare($verificarComentarioSql);

    if ($stmtVerificarComentario) {
        $stmtVerificarComentario->bind_param("i", $comentarioId);

        $stmtVerificarComentario->execute();
        $stmtVerificarComentario->store_result();

        if ($stmtVerificarComentario->num_rows > 0) {
            $excluirComentarioSql = "DELETE FROM tb03_comentarios WHERE tb03_id = ?";
            $stmtExcluirComentario = $conn->prepare($excluirComentarioSql);

            if ($stmtExcluirComentario) {
                $stmtExcluirComentario->bind_param("i", $comentarioId);

                if ($stmtExcluirComentario->execute()) {
                    // Comentário excluído com sucesso
                    echo json_encode(['status' => 'sucess', 'message' => 'Comentário excluído com sucesso.' . $stmtExcluirComentario->error]);
                } else {
                    // Erro na exclusão do comentário
                    echo json_encode(['status' => 'success', 'message' => 'Comentário excluído com sucesso.']);

                }

                $stmtExcluirComentario->close();
            } else {
                // Erro na preparação da instrução de exclusão de comentário
                echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da instrução de exclusão de comentário: ' . $conn->error]);
            }
        } else {
            // O comentário não foi encontrado
            echo json_encode(['status' => 'error', 'message' => 'Este comentário não pode ser excluído.']);
        }

        $stmtVerificarComentario->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da instrução de verificação de comentário: ' . $conn->error]);
    }

    $conn->close();
} else {
    // ID do comentário não especificado
    echo json_encode(['status' => 'error', 'message' => 'ID do comentário não especificado.']);
}
?>
