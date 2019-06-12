<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="imgs/favicon.ico" />
        <link rel="stylesheet" media="screen, print" href="style.css"/>
        <title>Gioco d'azzardo - Gallery</title>
    </head>
    <body>
        <header>
            <div id="header">
                <a href="index.html"><img src="imgs/logo.jpg" width="200" alt="logo"></a>
                <h1>DIPENDENZA DA GIOCO D'AZZARDO</h1>
            </div>
            <div id="navbar">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="recognize.html">Sintomi</a></li>
                    <li><a href="stop.html">Smettere</a></li>
                    <li><a class="active" href="gallery.php">Gallery</a></li>
                    <li><a href="map.html">Mappa</a></li>
                    <li><a href="contactus.html">Contattaci</a></li>
                </ul>
            </div>
        </header>
        <div id="container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
                " enctype="multipart/form-data">
                Titolo:<br />
                <input name="titolo" type="text" size="20"><br />
                Descrizione:<br />
                <textarea name="descrizione" cols="20" rows="4"></textarea><br />
                Immagine:<br />
                <input type="file" name="imagefile"><br />
                <input type="submit" name="Submit" value="Submit">
                <br /><br />
                <?php
                    if(isset($_POST['Submit']))
                    {
                        @include 'config.php';
                        @require 'gallery_function.php';

                        // Creo una array con i formati accettati
                        $tipi_consentiti = array("image/gif","image/jpeg","image/png");

                        // verifico che il formato del file sia tra quelli accettati
                        if (@in_array($_FILES['imagefile']['type'], $tipi_consentiti))
                        { 
                            // copio il file nella cartella delle immagini
                            @copy ($_FILES['imagefile']['tmp_name'], $path_img . $_FILES['imagefile']['name']);

                            // recupero i dati dal form
                            $titolo = @addslashes($_POST['titolo']);
                            $descrizione = @addslashes($_POST['descrizione']);
                            $nome = @addslashes($_FILES['imagefile']['name']);
                            $path = $path_img . stripslashes($nome);
                            $tipo = @addslashes($_FILES['imagefile']['type']);

                            // creo la miniatura
                            @makeThumb($path_img,$path,$nome,$tipo);
                        
                            // aggiorno il database
                            $query = "INSERT INTO images (Titolo,Descrizione,Nome,Tipo) VALUES('$titolo','$descrizione','$nome','$tipo')";
                            $res = @mysql_query($query) or die (mysql_error());
                            @mysql_close($cn);

                            // Stampo a video un po' di informazioni
                            echo "Nome: ".$_FILES['imagefile']['name']."<br />"; 
                            echo "Dimensione: ".$_FILES['imagefile']['size']."<br />"; 
                            echo "Tipo: ".$_FILES['imagefile']['type']."<br />"; 
                            echo "Copia eseguita con successo."; 
                        }
                        else
                        {
                            // stampo un messaggio di errore nel caso in cui il file sia di un formato non consentito
                            echo "Impossibile eseguire l'upload.";
                        }
                    } 
                ?>
            </form>
        </div>
        <footer>
            <div class="container">
                <p style="text-align: center">Copyright© 2019 - Nome società che non so.</p>
            </div>
        </footer>
    </body>
</html>