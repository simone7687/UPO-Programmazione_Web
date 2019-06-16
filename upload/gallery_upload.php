<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="robots" content="noindex" />
        <link rel="icon" href="../imgs/favicon.ico" />
        <link rel="stylesheet" media="screen, print" href="../style.css"/>
        <title>Gioco d'azzardo - Gallery</title>
    </head>
    <body>
        <header>
            <div id="header">
                <a href="../index.html"><img src="../imgs/logo.jpg" width="200" alt="logo"></a>
                <h1>DIPENDENZA DA GIOCO D'AZZARDO</h1>
            </div>
            <div id="navbar">
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../recognize.html">Info</a></li>
                    <!-- <li><a href="stop.html">Smettere</a></li> -->
                    <li><a class="active" href="../gallery.php">Gallery</a></li>
                    <li><a href="../map.php">Mappa</a></li>
                    <li><a href="../contactus.php">Contattaci</a></li>
                </ul>
            </div>
        </header>
        <div id="container">
            <div style="text-align:center">
                <h2>Carica le tue Immagini</h2>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
                " enctype="multipart/form-data">
                Titolo:<br />
                <input name="titolo" type="text" size="20"><br />
                Descrizione:<br />
                <input name="descrizione" type="text" size="20"><br />
                Immagine:<br />
                <input type="file" name="imagefile"><br />
                <input type="submit" name="Submit" value="Submit">
                <br /><br />
                <?php
                    if(isset($_POST['Submit']))
                    {
                        @include '../config.php';
                        // Cartella fisica in cui andremo ad inserire le immagini
                        $path_img = '../gallery/';

                        // Verificare che l'upload non sovrascriva altro file
                        $target_file = $path_img . $_FILES['imagefile']['name'];
                        if (file_exists($target_file)) 
                        {
                            echo 'Il file esiste già';
                            exit;
                        }
                        // Verificare l'estensione del file caricato
                        $tipi_consentiti = array("image/gif","image/jpeg","image/png");
                        if (!@in_array($_FILES['imagefile']['type'], $tipi_consentiti))
                        {
                            echo 'Il file ha un estensione non ammessa!';
                            exit;
                        }

                        // copio il file nella cartella delle immagini
                        @copy ($_FILES['imagefile']['tmp_name'], $path_img . $_FILES['imagefile']['name']);
                        // recupero i dati dal form
                        $titolo = @addslashes($_POST['titolo']);
                        $nome = @addslashes($_FILES['imagefile']['name']);
                        $descrizione = @addslashes($_POST['descrizione']);
                        $path = $path_img . stripslashes($nome);
                        $tipo = @addslashes($_FILES['imagefile']['type']);
                        // aggiorno il database
                        $query = "INSERT INTO images (Titolo,Nome,Descrizione,Tipo) VALUES('$titolo','$nome','$descrizione','$tipo')";
                        $res = @mysql_query($query) or die (mysql_error());
                        @mysql_close($cn);
                        
                        //Verificare se il file è stato caricato
                        if (!isset($_FILES['imagefile']) || !is_uploaded_file($_FILES['imagefile']['tmp_name'])) 
                        {
                            echo "Impossibile eseguire l'upload.";
                            exit;    
                        }
                        else
                        {
                            // Stampo a video un po' di informazioni
                            echo "Nome: ".$_FILES['imagefile']['name']."<br />"; 
                            echo "Dimensione: ".$_FILES['imagefile']['size']."<br />"; 
                            echo "Tipo: ".$_FILES['imagefile']['type']."<br />"; 
                            echo "Copia eseguita con successo.";
                        }
                    } 
                ?>
            </form>
        </div>
        <footer>
            <div id="container">
                <p style="text-align: center">Copyright© 2019 - Bast'azzardo</p>
            </div>
        </footer>
    </body>
</html>