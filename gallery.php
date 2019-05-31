<?php
    //https://www.mrwebmaster.it/php/galleria-d-immagini-php-gd2-mysql_7244.html
    $db_host = "localhost";
    $db_user = "pweb1819massaros";
    $db_name = "my_pweb1819massaros";

    $db = mysql_connect($db_host, $db_user);
    if ($db == FALSE)
    die ("Errore nella connessione. Verificare i parametri nel file config.php");
    $ris = mysql_select_db($db_name, $db);
    if ($ris == false) die ("Errore nella selezione del database. Verificare i parametri nel file config.php"); 

    $path_img = 'files/';
    
    // Da inserire in my sql
    // CREATE TABLE images (
    //     Id int(11) NOT NULL auto_increment,
    //     Titolo varchar(255) NOT NULL default '',
    //     Descrizione varchar(255) NOT NULL default '',
    //     Nome varchar(255) NOT NULL default '',
    //     Tipo varchar(255) NOT NULL default '',
    //     PRIMARY KEY (Id)
    //   );
?>