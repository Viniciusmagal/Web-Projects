<?php
session_start();

// Verificar se o admin está logado
if (!isset($_SESSION["administrador"])) {
    // Redirecionar para a página de login se o admin não estiver logado
    header("Location: loginadm.php");
    exit; // Certifique-se de sair após o redirecionamento
}

date_default_timezone_set('America/Sao_Paulo');

// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados da notícia a ser adicionada
    $titulo = $_POST["titulo"];
    $conteudo = $_POST["conteudo"];

    // Verifica se um arquivo foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        // Lê o conteúdo do arquivo em binário
        $imagemBinaria = file_get_contents($_FILES['imagem']['tmp_name']);
    } else {
        // Se nenhuma imagem foi enviada, defina $imagemBinaria como nulo
        $imagemBinaria = null;
    }

    // Recupere o valor do campo "conteudo_adicional" do formulário
    $conteudoAdicional = $_POST["conteudo_adicional"];

    // Prepara a consulta SQL para adicionar a notícia com ou sem imagem e com "conteudo_adicional"
    if ($imagemBinaria !== null) {
        $sql = "INSERT INTO tb02_noticias (tb02_titulo, tb02_conteudo, tb02_imagem, tb02_conteudo_adicional) VALUES (?, ?, ?, ?)";
    } else {
        $sql = "INSERT INTO tb02_noticias (tb02_titulo, tb02_conteudo, tb02_conteudo_adicional) VALUES (?, ?, ?)";
    }
    // Prepara a instrução SQL
    $stmt = mysqli_prepare($conn, $sql);
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincula os parâmetros à instrução preparada com base na presença de imagem
        if ($imagemBinaria !== null) {
            mysqli_stmt_bind_param($stmt, "sssb", $titulo, $conteudo, $imagemBinaria, $conteudoAdicional);
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $titulo, $conteudo, $conteudoAdicional);
        }

        // Executa a instrução preparada
        if (mysqli_stmt_execute($stmt)) {
            echo "Notícia adicionada com sucesso.";
        } else {
            echo "Erro ao adicionar a notícia: " . mysqli_error($conn);
        }

        // Fecha a instrução preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conn);
    }
}
// Fecha a conexão com o banco de dados
mysqli_close($conn);
// Redireciona para outra página após 5 segundos
header("refresh:5;url=admin.php");
exit;
?>