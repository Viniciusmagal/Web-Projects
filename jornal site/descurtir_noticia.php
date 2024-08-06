<?php
include 'conexao.php';
session_start();

if (isset($_POST['noticiaId'], $_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] === true) {
    $noticiaId = $_POST['noticiaId'];
    $usuarioEmail = $_SESSION['email'];

    // Primeiro, obtém a lista atual de usuários que curtiram a notícia
    $sqlGetLikes = "SELECT tb02_usuarios_curtiram FROM tb02_noticias WHERE tb02_id = ?";
    $stmtGetLikes = $conn->prepare($sqlGetLikes);
    if ($stmtGetLikes) {
        $stmtGetLikes->bind_param("i", $noticiaId);
        $stmtGetLikes->execute();
        $stmtGetLikes->bind_result($usuariosCurtiram);
        $stmtGetLikes->fetch();
        $stmtGetLikes->close();

        // Remove o email do usuário da lista
        $usuariosCurtiramArray = explode(',', $usuariosCurtiram);
        if (($key = array_search($usuarioEmail, $usuariosCurtiramArray)) !== false) {
            unset($usuariosCurtiramArray[$key]);
        }
        $usuariosCurtiramAtualizado = implode(',', $usuariosCurtiramArray);

        // Atualiza a notícia com a nova lista de usuários que curtiram
        $sqlUpdateLikes = "UPDATE tb02_noticias SET tb02_usuarios_curtiram = ? WHERE tb02_id = ?";
        $stmtUpdateLikes = $conn->prepare($sqlUpdateLikes);
        if ($stmtUpdateLikes) {
            $stmtUpdateLikes->bind_param("si", $usuariosCurtiramAtualizado, $noticiaId);
            if ($stmtUpdateLikes->execute()) {
                echo 'sucesso';
            } else {
                echo 'erro';
            }
            $stmtUpdateLikes->close();
        } else {
            echo 'erro';
        }
    } else {
        echo 'erro';
    }
    $conn->close();
} else {
    echo 'erro';
}
?>
