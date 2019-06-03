<!-- La pagina destinata alla visualizzazione degli ingrandimenti, che poi non sono altro che i file originariamente uploddati, 
permetterà non soltanto di vedere le immagini nelle loro dimensioni reali, ma anche di muoversi tra di esse tramite i classici link 'precedente' e 'successiva' utilizzati 
solitamente per scorrere le slides -->
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
                    <li><a class="active" href="gallery.html">Gallery</a></li>
                    <li><a href="map.html">Mappa</a></li>
                    <li><a href="contactus.html">Contattaci</a></li>
                </ul>
            </div>
        </header>
        <div class="container">
            <?php
                @include 'config.php';
                // apro la tabella che ci servirà per l'impaginazione
                echo "<table>";

                // recupero i dati dal DB
                $query = "SELECT * FROM images ORDER By Id";
                $res = mysql_query($query) or die (mysql_error());

                // numero delle immagini presenti nel DB
                $n_img = mysql_num_rows($res);

                // verifico che il DB ospiti almeno un'immagine
                if($n_img >= 1 )
                {
                    // stabilisco il numero di riche e colonne della nostra tabella per l'impagninazione
                    $colonne = 4;
                    $righe=0;

                    // ciclo tutti i record recuperati attraverso la nostra query
                    while ($f=@mysql_fetch_array($res))
                    {
                        $righe++;
                        $id = $f['Id'];
                        $titolo = stripslashes($f['Titolo']);
                        $nome = stripslashes($f['Nome']);
                        $descrizione = stripslashes($f['Descrizione']);

                        // stampo la cella contenente l'immagine
                        echo "<td width=\"33%\">\n";
                        echo $titolo . "<br />";
                        echo "<a href=\"gallery_visual.php?id=" . $id . "\">";
                        echo "<img src=\"" . $path_img . "tb_" . $nome . "\" border=\"0\"></a>";
                        echo "<br />" . $descrizione;
                        echo "</td>\n";

                        // quando il numero di righe equivale al valore impostato nella variabile $righe
                        // procedo a chiudere la linea e ad azzerare il valore di $righe
                        if ($righe == $colonne)
                        {
                            echo "</tr><tr>\n";
                            $righe = 0;
                        }
                    }
                }
                else
                {
                    // stampo un messaggio se il DB è vuoto
                    echo "Nessuna immagine inserita.";
                }
                @mysql_close($cn);
                echo "</table>";
            ?>
        </div>
        <footer>
            <div class="container">
                <p style="text-align: center">Copyright© 2019 - Nome società che non so.</p>
            </div>
        </footer>
    </body>
</html>