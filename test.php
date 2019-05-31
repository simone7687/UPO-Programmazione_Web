<?php
$db_host = "localhost";
$db_user = "pweb1819massaros";
$db_name = "my_pweb1819massaros";

$db = mysql_connect($db_host, $db_user);
if ($db == FALSE)
die ("Errore nella connessione. Verificare i parametri nel file config.php");
$ris = mysql_select_db($db_name, $db);
if ($ris == false) die ("Errore nella selezione del database. Verificare i parametri nel file config.php"); 

$sql = "SELECT * FROM punti_incontro WHERE id = 2";
$result = mysql_query($sql);

$lol = mysql_fetch_array($result);
echo $lol[nome];
?>