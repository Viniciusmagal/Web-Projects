<?php
include 'conexao.php';
date_default_timezone_set('America/Sao_Paulo');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$usuarioLogado = isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'];
// Consulta SQL para obter a notícia mais curtida
$sql = "SELECT tb02_id, tb02_titulo, tb02_curtidas FROM tb02_noticias ORDER BY tb02_curtidas DESC LIMIT 1";
$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $noticiaMaisCurtidaId = $row['tb02_id'];
    $noticiaMaisCurtidaTitulo = $row['tb02_titulo'];
    $noticiaMaisCurtidaCurtidas = $row['tb02_curtidas'];
} else {
    $noticiaMaisCurtidaId = null;
    $noticiaMaisCurtidaTitulo = "Nenhuma notícia mais curtida encontrada.";
    $noticiaMaisCurtidaCurtidas = 0;
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Etec</title>
   
    <style>
        /* Estilos da barra de navegação */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .navbar {
            position: sticky;
            top: 0;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar ul li {
            margin-right: 10px;
            display: flex;
        }

        .navbar ul li a {
            display: flex;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: color 0.3s;
        }
        .user-info {
            display: flex;
            align-items: center;
        }

        .user-name {
            margin-left: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            color: #333;
            padding: 0;
            font-size: 14px;
            text-decoration: underline;
        }

        .navbar .user-icon {
            width: 30px;
            height: 30px;
            background-image: url("imagens/usuario_icone.png");
            background-size: cover;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s;
            display: <?php echo $usuarioLogado ? 'block' : 'none'; ?>;
            
        }

        .navbar .user-text {
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: color 0.3s;
            display: <?php echo $usuarioLogado ? 'none' : 'block'; ?>;
        }

        .navbar .logo {
            width: 120px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .navbar .logo:hover {
            transform: translateY(-3px);
        }

        /* Estilos para telas com largura máxima de 991px (Tablet) */
        @media (max-width: 991px) {
            .navbar ul li {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .navbar .logo {
                width: 80px;
            }

            .navbar ul li a {
                padding: 10px 15px;
            }

            .navbar .user-icon {
                width: 25px;
                height: 25px;
            }

            .navbar .user-name {
                font-size: 12px;
            }

            .user-info {
                margin-right: 10px;
            }
        }

        .navbar ul li a:hover {
        color: #0a51ae; /* Defina a cor desejada aqui */
    }
      /* Estilos para o dropdown menu */
.dropdown-menu {
    position: absolute;
    top: 100%; /* Posicione o dropdown abaixo do nome de usuário */
    right: 0;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: none; /* Oculta o menu por padrão */
    z-index: 1001;
    width: 150px; /* Ajuste a largura conforme necessário */
    flex-direction: column;

}

.user-info {
    position: relative;
}

.user-name {
    cursor: pointer;
}

.dropdown-menu ul {
    display: block;
    padding: 0;
    margin: 0;
    list-style: none;

}

.dropdown-menu li {
    text-align:  center;
    width: 150px;
}
.dropdown-menu li a {
    display: block;
    text-decoration: none;
    padding: 10px;
    color: #333;
    width: 100%;
}
.dropdown-menu ul li {
    text-align: right;
    width: 150px;
}

.dropdown-menu ul li a {
    display: block;
    text-decoration: none;
    text-align: center;
    width: 150px;
    color: #333;
}

.dropdown-menu ul li a:hover {
    background-color: #0a51ae;
    color: #fff;
}

    .navbar .user-name:hover {
        text-decoration: none; 
        color: #0a51ae; 
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
    }
::selection{
    color: white; 
    background-color: rgba(10, 81, 174, 0.5);
}


.menu-toggle {
    display: none; /* Oculta por padrão */
    font-size: 24px; /* Tamanho do ícone do menu */
    background: none;
    border: none;
    cursor: pointer;
}

@media (max-width: 768px) {
    .menu-toggle {
        display: block; /* Mostra o menu hambúrguer */
    }

    .navbar ul,
    .dropdown-menu {
        display: none; /* Oculta o menu principal e dropdown */
        flex-direction: column;
        width: 100%; /* Ocupa a largura total da tela */
    }

    .navbar ul.active,
    .dropdown-menu.active {
        display: flex; /* Mostra o menu e dropdown quando ativo */
    }

    .navbar ul li,
    .dropdown-menu li {
        width: 100%; /* Ocupa a largura total para cada item */
        text-align: center;
    }

    .dropdown-menu {
        position: static; /* Remove o posicionamento absoluto */
        box-shadow: none; /* Remove a sombra para integrar com o menu principal */
        border-top: 1px solid #ccc; /* Adiciona uma divisão entre o menu principal e dropdown */
    }
}
@media (max-width: 768px) {
    .navbar ul.active + .user-info .dropdown-menu {
        display: none; /* Oculta o dropdown se o menu hambúrguer estiver ativo */
    }
    
    /* Estilos para o dropdown quando o menu hambúrguer estiver ativo */
    .navbar .user-info .dropdown-menu.active {
        display: flex; /* Mostra o dropdown */
        position: absolute; /* Mantém o posicionamento absoluto para o dropdown */
        right: 10px; /* Espaçamento do lado direito */
        top: 50px; /* Espaçamento do topo para não sobrepor o ícone do usuário */
    }
}
    </style>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var menuToggle = document.getElementById('menu-toggle');
    var userMenu = document.querySelector(".user-info");
    var dropdownMenu = document.querySelector(".dropdown-menu");
    var navbarUl = document.querySelector('.navbar ul');

    menuToggle.addEventListener('click', function() {
        navbarUl.classList.toggle('active');
        dropdownMenu.classList.remove('active'); // Fecha o dropdown ao abrir o menu hambúrguer
    });

    userMenu.addEventListener("click", function(event) {
        dropdownMenu.classList.toggle('active'); // Alterna a visibilidade do dropdown
        event.stopPropagation();
    });

    document.addEventListener("click", function(event) {
        if (event.target !== userMenu && event.target !== menuToggle) {
            dropdownMenu.classList.remove('active'); // Fecha o dropdown se clicar fora
            navbarUl.classList.remove('active'); // Fecha o menu hambúrguer se clicar fora
        }
    });
});

</script>

</head>
<body>
    <nav class="navbar">
    <button class="menu-toggle" id="menu-toggle">☰</button>

        <a href="index.php">
            <img src="imagens/logo.png" alt="Logo" class="logo">
        </a>
        <ul>
            <li><a href="hoje.php">Hoje</a></li>
            <li><a href="mais_curtidas.php">Mais Curtidas</a></li>
            <?php if ($noticiaMaisCurtidaId !== null && $noticiaMaisCurtidaCurtidas > 0) { ?>
        <li><a href="visualizar_noticia.php?id=<?php echo $noticiaMaisCurtidaId; ?>"><?php echo $noticiaMaisCurtidaTitulo; ?></a></li>
    <?php } else { ?>
        <li><a href="#">Nenhuma notícia mais curtida encontrada</a></li>
    <?php } ?>
</ul>
        <?php if ($usuarioLogado) { ?>
            <div class="user-info">
    <div class="user-icon"></div>
    <div class="user-name" id="user-name">
        <?php echo $_SESSION['usuarioNome']; ?>
    </div>
    <div class="dropdown-menu" id="dropdown-menu"> 
        <ul> 
            <li><a href="minhas_curtidas.php">minhas curtidas</a></li>
            <li><a href="logout.php">Sair</a></li> 
        </ul>
    </div>
</div>
        <?php } else { ?>
            <a href="login_usuario.php" class="user-text">Fazer Login</a>
        <?php } ?>
    </nav>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    var userMenu = document.querySelector(".user-info");
    var dropdownMenu = document.querySelector(".dropdown-menu");

    userMenu.addEventListener("click", function(event) {
        // Verifique se o dropdown está visível
        var isVisible = dropdownMenu.style.display === "block";

        // Se estiver visível, oculte; caso contrário, mostre
        dropdownMenu.style.display = isVisible ? "none" : "block";
        event.stopPropagation();
    });

    // Feche o dropdown quando o usuário clicar fora dele
    document.addEventListener("click", function(event) {
        if (event.target !== userMenu) {
            dropdownMenu.style.display = "none";
        }
    });
});
</script>
</body>
</html>