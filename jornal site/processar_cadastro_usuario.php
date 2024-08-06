<?php
session_start();
include 'conexao.php'; 

// Definir a codificação de caracteres
mysqli_set_charset($conn, "utf8");

// Obtém os dados do formulário
$nomeUsuario = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Defina as variáveis de sessão
$_SESSION['nomeUsuario'] = $nomeUsuario;
$_SESSION['email'] = $email;
$_SESSION['senha'] = $senha;

// Verifica se o email já está cadastrado
$sqlVerificaEmail = "SELECT * FROM tb01_usuarios WHERE tb01_email = '$email'";
$resultadoVerificaEmail = mysqli_query($conn, $sqlVerificaEmail);
if (mysqli_num_rows($resultadoVerificaEmail) > 0) {
    echo "<div class='message'>Email já cadastrado.</div>";
    mysqli_close($conn);
    exit;
}

// Verifica se o email contém "@etec.sp.gov.br"
if (strpos($email, '@etec.sp.gov.br') === false) {
    echo "<div class='message'>O email deve ser do domínio @etec.sp.gov.br.</div>";
    mysqli_close($conn);
    exit;
}

// Prepara a consulta SQL para inserir o usuário
$sqlCadastro = "INSERT INTO tb01_usuarios (tb01_nome, tb01_email, tb01_senha) VALUES ('$nomeUsuario', '$email', '$senha')";

// Executa a consulta SQL
if (mysqli_query($conn, $sqlCadastro)) {
    // Fazer login automaticamente
    $sqlLogin = "SELECT * FROM tb01_usuarios WHERE tb01_email = '$email'";
    $resultadoLogin = mysqli_query($conn, $sqlLogin);

    if (mysqli_num_rows($resultadoLogin) == 1) {
        // Iniciar a sessão e armazenar os dados do usuário
        $row = mysqli_fetch_assoc($resultadoLogin);
        session_start();
        $_SESSION['email'] = $row['tb01_email'];
        $_SESSION['senha'] = $row['tb01_senha'];

        echo "<div class='success-message'>Cadastro realizado com sucesso. Você está logado.</div>";
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='message'>Erro ao realizar o cadastro. Não foi possível fazer o login automaticamente.</div>";
    }
} else {
    echo "<div class='message'>Erro ao realizar o cadastro: " . mysqli_error($conn) . "</div>";
}
?>
