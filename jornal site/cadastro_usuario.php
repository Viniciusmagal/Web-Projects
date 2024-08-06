<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon">
    <?php 
        include 'nav.php'; 
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        // Mostrar/ocultar senha
        function togglePasswordVisibility() {
            const campoSenha = document.getElementById("campoSenha");
            const botaoMostrarSenha = document.getElementById("botaoMostrarSenha");

            if (campoSenha.type === "password") {
                campoSenha.type = "text";
                botaoMostrarSenha.classList.remove("fa-eye");
                botaoMostrarSenha.classList.add("fa-eye-slash");
            } else {
                campoSenha.type = "password";
                botaoMostrarSenha.classList.remove("fa-eye-slash");
                botaoMostrarSenha.classList.add("fa-eye");
            }
        }

        // Valida o formulário
        function validarFormulario() {
            var emailInput = document.querySelector('input[name="email"]');
            var email = emailInput.value.trim().toLowerCase();

            if (!email.endsWith("@etec.sp.gov.br") && !email.endsWith("@outlook.com") && !email.endsWith("@hotmail.com")) {
                alert("O e-mail deve ser um e-mail válido da ETEC.");
                emailInput.focus();
                return false;
            }
        }
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 2px solid #0a51ae; /* Linha azul em volta do formulário */
            background: rgba(255, 255, 255, 0.1);

        }

        h1 {
            color: #0a51ae;
            margin-top: 0;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 36%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .password-toggle i {
            color: #888;
        }

        .password-toggle i:hover {
            color: #333;
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
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #357ae8;
        }

        .logo-cadastro {
            max-width: 200px;
            margin-bottom: 20px;
            transition: transform 0.2s;

        }
        .logo-cadastro:hover {
            transform: scale(1.1); /* Aumenta a escala ao passar o mouse */

        }

        .login_link {
            color: #0a51ae;
            text-decoration: none;
            font-weight: bold;
        }

        .email-icon {
            position: absolute;
            top: 35%;
            right: 10px;
            transform: translateY(-50%);
            color: #888;
        }

        .login_link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body style="overflow-x: hidden;">
    <div class="container">
        <img src="Imagens/logo.png" alt="Logo do Site" class="logo-cadastro">
        <h1>Cadastro de Usuário</h1>
        <!-- Formulário de Cadastro -->
        <form action="processar_cadastro_usuario.php" method="post" onsubmit="return validarFormulario();">
            <label for="nome">Nome:</label>
            <input type="text" placeholder="Digite seu nome" name="nome" required><br>
            <label for="email">Email:</label>
            <div style="position: relative;">
                <input type="email" name="email" placeholder="seumail@etec.sp.gov.br" required>
                <i class="far fa-envelope email-icon"></i>
            </div>
            <div class="password-container">
                <label for="senha">Senha:</label>
                <div style="position: relative;">
                    <input type="password" placeholder="Digite sua senha" name="senha" id="campoSenha" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
                        <i id="botaoMostrarSenha" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
        <!-- Formulário de Cadastro fim -->
        <!-- Link de Login -->
        <p>Já possui uma conta? <a href="login_usuario.php" class="login_link">Clique aqui</a> e faça login</p>
        <!-- Link de Login fim -->
    </div>
    <?php include 'rodape.php'; ?>
</body>
</html>
