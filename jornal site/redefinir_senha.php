<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Redefinir Senha</title>
    <?php include 'nav.php'; include 'conexao.php';?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Estilo compartilhado */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            flex-direction: column;
            min-height: 100vh;
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
        }

        input[type="email"],
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

        .logo_login_usuario {
            max-width: 200px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body style="overflow-x: hidden;">
    <div class="wrapper">
        <div class="content">
            <div class="container redefinir-senha">
                <img src="Imagens/logo.png" alt="Logo do Site" class="logo_login_usuario">
                <h1>Redefinir Senha</h1>
                <!-- Formulário para redefinir a senha -->
                <form action="processar_redefinicao.php" method="post">
                    <label for="codigo">Código de Confirmação:</label>
                    <input type="text" name="codigo" placeholder="Código de Confirmação" required>
                    <label for="nova_senha">Nova Senha:</label>
                    <input type="password" name="nova_senha" placeholder="Digite a nova senha" required>
                    <input type="submit" value="Redefinir Senha">
                </form>
                <!-- Formulário de redefinição de senha fim -->
            </div>
        </div>
    </div>
    <?php include 'rodape.php'; ?>
</body>
</html>
