<?php
// Inicia a sessão, se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Desloga o usuário, removendo os dados da sessão
$_SESSION['usuarioLogado'] = false;
unset($_SESSION['usuarioLogado']);
// Redireciona para a página de login (ou para outra página de sua escolha)
header('Location: index.php');
exit();
?>
