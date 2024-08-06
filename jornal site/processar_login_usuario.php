<meta charset="UTF-8">
<?php
include 'conexao.php';
// Definir a codificação de caracteres
mysqli_set_charset($conn, "utf8");

// Obter os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta SQL utilizando prepared statements para verificar o usuário com base no email e senha fornecidos
$sqlLogin = "SELECT * FROM tb01_usuarios WHERE tb01_email = ? AND tb01_senha = ?";
$stmt = mysqli_prepare($conn, $sqlLogin);
mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
mysqli_stmt_execute($stmt);
$resultadoLogin = mysqli_stmt_get_result($stmt);

// Verifica se o login foi bem-sucedido
$usuarioLogado = (mysqli_num_rows($resultadoLogin) > 0);

// Armazena o estado de login na sessão e o nome do usuário (caso o login seja bem-sucedido)
session_start();
$_SESSION['usuarioLogado'] = $usuarioLogado;

if ($usuarioLogado) {
    $row = mysqli_fetch_assoc($resultadoLogin);
    $_SESSION['email'] = $row['tb01_email'];
    $_SESSION['usuarioNome'] = $row['tb01_nome'];
    header("Location: index.php");
} else {
    echo '<script>
            alert("Email ou senha inválidos.");
            window.location.href = "login_usuario.php";
          </script>';
          
}
// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
