<?php
// Inicie a sessão no início do arquivo
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $administrador = $_POST["administrador"];
    $senha = $_POST["senha"];

    // Verifica se o adm e a senha estão corretos
    if ($administrador === "admjornaletec" && $senha === "jornaletec@147") {
        // Login feito, defina a variável de sessão e redirecione
        $_SESSION["administrador"] = true;
        header("Location: admin.php");
        exit;
    } else {
        $mensagemErro = "Credenciais inválidas. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 2px solid #0a51ae;

        }
        h1 {
            color: #0a51ae;
            margin-top: 0;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: bold;
            text-align: left;
            width: 100%;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #0a51ae;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #357ae8;
        }
        .logologinadm {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .password-container {
        position: relative;
    }
        .password-toggle {
            position: absolute;
            top: 38%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
}
        .password-toggle i {
            color: #888;
        }
        .password-toggle i:hover {
            color: #333;
        }

        /* Ajuste para posicionar corretamente o ícone dentro do campo de senha */
        input[type="password"] {
            padding-right: 35px;
        }
    </style>
</head>
<body>
<?php include 'nav.php'; ?>

<div class="container">
    <img src="Imagens/logo.png" alt="Logo do Site" class="logologinadm">
    <h1>Login do Administrador</h1>
    <form method="POST">
        <label for="administrador">Administrador:</label>
        <input type="text" name="administrador" required placeholder="Digite o usuário do adm"><br>
        <label for="senha">Senha:</label>
<div class="password-container">
    <input type="password" name="senha" id="campoSenha" required placeholder="Digite a senha">
    <span class="password-toggle" onclick="togglePasswordVisibility()" id="botaoMostrarSenha">
        <i class="fas fa-eye"></i>
    </span>
</div>
        <input type="submit" value="Entrar">
    </form>
</div>
<script>
   // Mostrar/ocultar senha
   function togglePasswordVisibility() {
    const campoSenha = document.getElementById("campoSenha");
    const botaoMostrarSenha = document.getElementById("botaoMostrarSenha");

    if (campoSenha.type === "password") {
        campoSenha.type = "text";
        botaoMostrarSenha.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        campoSenha.type = "password";
        botaoMostrarSenha.innerHTML = '<i class="fas fa-eye"></i>';
    }
}
</script>
<?php include 'rodape.php'; ?>
</body>
</html>