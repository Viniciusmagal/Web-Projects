<?php
session_start();

// Verificar se o admin está logado
if (!isset($_SESSION["administrador"])) {
    // Redirecionar para a página de login se o admin não estiver logado
    header("Location: loginadm.php");
    exit; // Certifique-se de sair após o redirecionamento
}

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"]) && isset($_POST["id"])) {
    // Conexão com o banco de dados (substitua os valores de host, usuário, senha e nome_do_banco)
    $conn = mysqli_connect("localhost", "root", "usbw", "jornal_etec");

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Definir a codificação de caracteres
    mysqli_set_charset($conn, "utf8");

    $noticiaId = $_POST["id"];
    $titulo = $_POST["titulo"];
    $conteudo = $_POST["conteudo"];
    $conteudoAdicional = $_POST["conteudo_adicional"];

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['error'] == UPLOAD_ERR_OK) {
        // Lê o conteúdo da nova imagem em binário
        $novaImagemBinaria = file_get_contents($_FILES['nova_imagem']['tmp_name']);
        // Atualiza a imagem no banco de dados
        $sql = "UPDATE tb02_noticias SET tb02_titulo = ?, tb02_conteudo = ?, tb02_imagem = ?, tb02_conteudo_adicional = ? WHERE tb02_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $conteudo, $novaImagemBinaria, $conteudoAdicional, $noticiaId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Notícia editada com sucesso.";
            } else {
                echo "Erro ao editar a notícia: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }
    } else {
        // Se nenhuma nova imagem foi enviada, atualize a notícia sem modificar a imagem
        $sql = "UPDATE tb02_noticias SET tb02_titulo = ?, tb02_conteudo = ?, tb02_conteudo_adicional = ? WHERE tb02_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $titulo, $conteudo, $conteudoAdicional, $noticiaId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Notícia editada com sucesso.";
            } else {
                echo "Erro ao editar a notícia: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // Redireciona de volta para a página de administração se o formulário não for enviado corretamente
    header("Location: admin.php");
    exit();
}
?>
