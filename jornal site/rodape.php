<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .footer-container {
            background-color: #0a51ae;
            color: #fff;
            padding: 20px;
            text-align: center;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -3px 6px rgba(0, 0, 0, 0.1);
            align-items: center;
            position: absolute, relative;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .footer-link {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: #4285f4;
        }

        .footer-contato p {
            margin: 5px 0;
            font-weight: bold;
            color: #ccc;
        }

        .footer-legal {
            color: #888;
            font-size: 14px;
            font-weight: bold;
            margin-top: 40px;
        }

        /* Estilos para telas menores */
        @media (max-width: 600px) {
            .footer-links {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .footer-link {
                font-size: 14px;
            }

            .footer-contato p {
                font-size: 12px;
            }

            .footer-legal {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <br>
    <div class="content">
        <!-- Conteúdo da sua página aqui -->
    </div>

    <div class="footer-container">
        <div class="footer-links">
            <a href="sobre_nos.php" class="footer-link">Sobre Nós</a>
            <a href="contato.php" class="footer-link">Feedback</a>
        </div>

        <div class="footer-contato">
            <p>Entre em Contato:</p>
            <p>Endereço: Av. Pref. Antônio Júlio Toledo Garcia Lopes, 200 - Jardim das Cerejeiras, Atibaia - SP, 12951-231</p>
            <p>Telefone: (11) 4412-1470</p>
            <p>Email: contatojornaletec@gmail.com</p>
        </div>

        <div class="footer-legal">
            <?php date_default_timezone_set('America/Sao_Paulo'); ?>
            <p style="margin: 0;">&copy; <?= date('Y'); ?> Jornal Etec. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>