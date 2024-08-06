<?php
date_default_timezone_set('America/Sao_Paulo');
$conn = mysqli_connect("localhost", "root", "usbw", "jornal_etec");
if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}
?>