<?php
// Verifica se a solicitação é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se a variável "noticiaId" foi enviada via POST
    if (isset($_POST['noticiaId'])) {
        // Você deve fazer a conexão com o banco de dados aqui
        include 'conexao.php';

        // Sanitize (evitar injeção de SQL) a variável noticiaId
        $noticiaId = mysqli_real_escape_string($conn, $_POST['noticiaId']);

        // Iniciar uma transação
        $conn->begin_transaction();

        // Verifique se a notícia com o ID fornecido existe no banco de dados
        $sql = "SELECT tb02_curtidas FROM tb02_noticias WHERE tb02_id = $noticiaId FOR UPDATE";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $curtidas = $row['tb02_curtidas'];

            // Verifique se há curtidas para remover (maior que zero)
            if ($curtidas > 0) {
                // Reduza o número de curtidas em 1
                $novaQuantidadeCurtidas = $curtidas -- 1;

                // Atualize o número de curtidas no banco de dados
                $sqlUpdate = "UPDATE tb02_noticias SET tb02_curtidas = $novaQuantidadeCurtidas WHERE tb02_id = $noticiaId";
                if ($conn->query($sqlUpdate) === TRUE) {
                    // A curtida foi removida com sucesso
                    echo "Curtida removida com sucesso!";
                    $conn->commit(); // Commit da transação
                } else {
                    // Ocorreu um erro ao atualizar o banco de dados
                    echo "Erro ao remover a curtida: " . $conn->error;
                    $conn->rollback(); // Rollback da transação
                }
            } else {
                // Não há curtidas para remover, mantenha o número de curtidas em 0
                echo "Esta notícia não possui curtidas para remover.";
                $conn->rollback(); // Rollback da transação
            }
        } else {
            // A notícia com o ID fornecido não foi encontrada
            echo "Notícia não encontrada.";
            $conn->rollback(); // Rollback da transação
        }

        // Feche a conexão com o banco de dados
        $conn->close();
    } else {
        // A variável noticiaId não foi enviada via POST
        echo "Parâmetro noticiaId não encontrado na solicitação.";
    }
} else {
    // A solicitação não é do tipo POST
    echo "Acesso não autorizado.";
}
?>
