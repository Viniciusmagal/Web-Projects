<?php
include 'conexao.php';
session_start();

// Verificar a autenticação do usuário
if (isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] === true) {
    $usuarioEmail = $_SESSION['email'];

    if (isset($_POST['noticiaId'])) {
        $noticiaId = $_POST['noticiaId'];

        // Verificar se o usuário já curtiu esta notícia
        $sqlCheckLike = "SELECT tb02_curtidas, tb02_usuarios_curtiram FROM tb02_noticias WHERE tb02_id = ?";
        $stmtCheckLike = $conn->prepare($sqlCheckLike);

        if ($stmtCheckLike) {
            $stmtCheckLike->bind_param("i", $noticiaId);
            $stmtCheckLike->execute();
            $stmtCheckLike->bind_result($curtidas, $usuariosCurtiram);
            $stmtCheckLike->fetch();
            $stmtCheckLike->close();

            // Verifica se o usuário já curtiu a notícia
            $usuariosCurtiramArray = $usuariosCurtiram ? explode(',', $usuariosCurtiram) : [];

            if (in_array($usuarioEmail, $usuariosCurtiramArray)) {
                // O usuário já curtiu a notícia, então vamos descurtir
                $curtidas--;
                $usuariosCurtiramArray = array_diff($usuariosCurtiramArray, array($usuarioEmail));
            } else {
                // O usuário ainda não curtiu, então vamos curtir
                $curtidas++;
                $usuariosCurtiramArray[] = $usuarioEmail;
            }

            // Atualizar o número de curtidas na notícia e a lista de usuários que curtiram
            $usuariosCurtiramAtualizado = implode(',', $usuariosCurtiramArray);
            $sqlUpdateLikes = "UPDATE tb02_noticias SET tb02_curtidas = ?, tb02_usuarios_curtiram = ? WHERE tb02_id = ?";
            $stmtUpdateLikes = $conn->prepare($sqlUpdateLikes);

            if ($stmtUpdateLikes) {
                $stmtUpdateLikes->bind_param("isi", $curtidas, $usuariosCurtiramAtualizado, $noticiaId);

                if ($stmtUpdateLikes->execute()) {
                    echo $curtidas; // Retorna o novo número de curtidas
                } else {
                    echo "Erro ao atualizar as curtidas da notícia. Detalhes do erro: " . $conn->error;
                }
                $stmtUpdateLikes->close();
            } else {
                echo "Erro na preparação da atualização de curtidas da notícia.";
            }
        } else {
            echo "Erro na preparação da verificação de curtida.";
        }
    } else {
        echo "ID da notícia não especificado.";
    }
} else {
    echo "Usuário não autenticado. Faça login para curtir esta notícia.";
}

$conn->close();
?>
