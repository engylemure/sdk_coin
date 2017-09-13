<?php
/*
    Script responsavel por efetuar a criacao da tabela que ira armazenar as informacoes
    do Ticker, utilizando as configuracoes disponibilizadas pelo server_config.php.
*/
require_once('server_config.php') ;
$sql = "CREATE TABLE TICKER (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
high DECIMAL(16,10) NOT NULL,
low DECIMAL(16,10) NOT NULL,
vol DECIMAL(16,10) NOT NULL,
last DECIMAL(16,10) NOT NULL,
buy DECIMAL(16,10) NOT NULL,
date INT(32) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    //echo "Table TICKER created successfully\n";
} else {
    //echo "Error creating table: " . $conn->error ."\n";
}
?>
