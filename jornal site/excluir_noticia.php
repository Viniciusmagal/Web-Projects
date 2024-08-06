<?php
include 'conexao.php';
// Verifique se a solicitação é um POST e contém 'noticiaId'
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["noticiaId"])) {
    // Obtém o ID da notícia a ser excluída
    $noticiaId = $_POST["noticiaId"];
    // Query para excluir a notícia com o ID fornecido
    $sql = "DELETE FROM tb02_noticias WHERE tb02_id = $noticiaId";
    if (mysqli_query($conn, $sql)) {
        // A exclusão foi bem-sucedida
        echo "Notícia excluída com sucesso!";
    } else {
        // Ocorreu um erro ao excluir a notícia
        echo "Erro ao excluir a notícia: " . mysqli_error($conn);
    }
} else {
    // Se a solicitação não contiver 'noticiaId', retorne uma mensagem de erro adequada
    echo "A solicitação de exclusão é inválida.";
}

mysqli_close($conn);
?>
