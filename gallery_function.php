<!-- La funzione si occuperà essenzialmente di creare delle miniature sulla base di informazioni prelevate da un'immagine sorgente. 
Per la creazione dei thumbnails verrà sempre tenuto conto di una 'ratio' per la quale larghezza e lunghezza di ognuno di essi non dovranno superare la dimensione massima di 100px. -->
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
            if ($t == 'image/jpeg'){@imagejpeg($thumb,"$dir/tb_".$n, 75);}  //jpg  fattore compressione da 0 a 100 
            elseif ($t == 'image/gif'){@imagegif($thumb,"$dir/tb_".$n);}    //gif  non prevede un fattore di compressione 
            elseif ($t == 'image/png'){@imagepng($thumb,"$dir/tb_".$n, 7);} //png  fattore compressione da 0 a 9     
        }
    }
?>