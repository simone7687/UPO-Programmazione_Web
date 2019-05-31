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

<?php
    function makeThumb($dir,$pic,$n,$t)
    {
        @list($width, $height, $type, $attr) = @getimagesize($pic);
        $max_w = 100;
        $max_h = 100;
        $ratio = @min($max_w/$width,$max_h/$height);

        // Verifico che l'immagine originale sia più grande delle dimensioni massime 100*100pxl
        if ($ratio < 1)
        {
            // Individuo le nuove dimensioni da assegnare all'immagine
            $w = @floor($ratio*$width);
            $h = @floor($ratio*$height);

            // creo una nuova immagine con le dimensioni appena calcolate
            $thumb = @imagecreatetruecolor($w,$h);
            if ($t == 'image/jpeg'){$temp = @imagecreatefromjpeg($pic);}
            elseif ($t == 'image/gif'){$temp = @imagecreatefromgif($pic);}
            elseif ($t == 'image/png'){$temp = @imagecreatefrompng($pic);}

            // ridimensiono l'originale e salvo nella cartella di destinazione
            @imagecopyresized($thumb,$temp,0,0,0,0,$w,$h,$width,$height);
            if ($t == 'image/jpeg'){@imagejpeg($thumb,"$dir/tb_".$n, 75);} //jpg => fattore compressione da 0 a 100 
            elseif ($t == 'image/gif'){@imagegif($thumb,"$dir/tb_".$n);} //gif => non prevede un fattore di compressione 
            elseif ($t == 'image/png'){@imagepng($thumb,"$dir/tb_".$n, 7);} //png => fattore compressione da 0 a 9     
        }
    }
?>