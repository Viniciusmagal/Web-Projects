<?php include 'nav.php'; ?>
<link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
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

        // Mostrar/ocultar senha
        function togglePasswordVisibility() {
            const campoSenha2 = document.getElementById("campoSenha2");
            const botaoMostrarSenha2 = document.getElementById("botaoMostrarSenha2");

            if (campoSenha2.type === "password") {
                campoSenha2.type = "text";
                botaoMostrarSenha2.classList.remove("fa-eye");
                botaoMostrarSenha2.classList.add("fa-eye-slash");
            } else {
                campoSenha2.type = "password";
                botaoMostrarSenha2.classList.remove("fa-eye-slash");
                botaoMostrarSenha2.classList.add("fa-eye");
            }
        }
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <style>
        /* Estilos do ícone de olho para mostrar/ocultar senha */
        .password-toggle {
            position: absolute;
            right: 5px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .password-toggle i {
            color: #888;
        }

        .password-toggle i:hover {
            color: #333;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            flex-direction: column;
            min-height: 100vh;
            display: flex;
            
        }

        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 40px;
            border: 2px solid #0a51ae;
            position: relative; /* Adicionado para posicionamento absoluto do ícone de olho */
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

        .logo_login_usuario {
            max-width: 200px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .logo_login_usuario:hover {
            transform: scale(1.1); /* Aumenta a escala ao passar o mouse */
        }
        .cad-link {
            color: #555;
            text-decoration: underline;
            cursor: pointer;
        }

        .email-icon {
            position: absolute;
            top: 49.7%;
            right: 50px;
            transform: translateY(-50%);
            color: #888;
        }

        .cad-link, .admin-link {
            color: #0a51ae;
            text-decoration: none;
            font-weight: bold;
        }

        .cad-link:hover, .admin-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body style="overflow-x: hidden;">
    <div class="wrapper">
        <div class="content">
            <div class="container">
                <img src="Imagens/logo.png" alt="Logo do Site" class="logo_login_usuario">
                <h1>Login de Usuário</h1>
                <form action="processar_login_usuario.php" method="post" onsubmit="return validarFormulario();">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="seuemail@etec.sp.gov.br" required>
                    <i class="far fa-envelope email-icon"></i>


                    <label for="senha">Senha:</label>
                    <div style="position: relative;">
                        <input type="password" name="senha" placeholder="Digite sua senha" name="senha" id="campoSenha2" required>
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
                            <i id="botaoMostrarSenha2" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <input type="submit" value="Entrar">
                    <p>Ainda não possui uma conta? <a href="cadastro_usuario.php" class="cad-link">Crie aqui</a></p>
                    <p>Você é um Administrador? <a href="loginadm.php" class="admin-link">Clique aqui</a></p>

                </form>
                <!-- Alerta para credenciais inválidas -->
                <div id="login-alert" style="display:none; color:red;">
                    Email ou senha inválidos.
                </div>
                <!-- Alerta fim -->
            </div>
        </div>
        <?php include 'rodape.php'; ?>
    </div>
</body>
</html>