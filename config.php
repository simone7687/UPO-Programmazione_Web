<?php
    $db_host = "localhost";
    $db_user = "pweb1819massaros";
    $db_name = "my_pweb1819massaros";

    $db = mysql_connect($db_host, $db_user);
    if ($db == FALSE)
    die ("Errore nella connessione. Verificare i parametri nel file config.php");
    $ris = mysql_select_db($db_name, $db);
    if ($ris == false) die ("Errore nella selezione del database. Verificare i parametri nel file config.php");

    // Cartella fisica in cui andremo ad inserire le immagini
    $path_img = 'gallery/';
?>
