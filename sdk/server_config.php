<?php
/*
    Configuracao do banco de dados que ira hospedar as informacoes referentes aos valores registrados pelo 
    sistema.
*/
// Nome do servidor local.
$servername = "localhost";
// Usuario do servidor local do banco de dados MySql.
$username = "php";
// Senha do usuario do banco de dados MySql.
$password = "php";
//  Nome do Schema do Banco da dados a ser utilizado.
$dbname = "bc_db";


$conn = new mysqli($servername, $username, $password);

$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
   // echo "Database created successfully";
} else {
   // echo "Error creating database: " . mysqli_error($conn);
}
$conn->close();

$conn = new mysqli($servername, $username, $password,$dbname);
?>
