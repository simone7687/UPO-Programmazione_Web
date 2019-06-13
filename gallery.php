<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="imgs/favicon.ico" />
        <link rel="stylesheet" media="screen, print" href="style.css"/>
        <link rel="stylesheet" media="screen, print" href="style.css"/>
        <title>Gioco d'azzardo - Gallery</title>
    </head>
    <body>
        <?php
            @include 'config.php';
            // recupero i dati dal DB
            $query = "SELECT * FROM images ORDER By id";
            $res = mysql_query($query) or die (mysql_error());
            // numero delle immagini presenti nel DB
            $n_img = mysql_num_rows($res);
        ?>
        <header>
            <div id="header">
                <a href="index.html"><img src="imgs/logo.jpg" width="200" alt="logo"></a>
                <h1>DIPENDENZA DA GIOCO D'AZZARDO</h1>
            </div>
            <div id="navbar">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="recognize.html">Info</a></li>
                    <!-- <li><a href="stop.html">Smettere</a></li> -->
                    <li><a class="active" href="gallery.php">Gallery</a></li>
                    <li><a href="map.php">Mappa</a></li>
                    <li><a href="contactus.php">Contattaci</a></li>
                </ul>
            </div>
        </header>
            <div id="container">
                <div id="slidercontainer">
                    <?php
                        if($n_img >= 1 )
                        {
                            while ($f=@mysql_fetch_array($res))
                            {
                                $id = $f['id'];
                                $titolo = stripslashes($f['titolo']);
                                $nome = stripslashes($f['nome']);
                                $descrizione = stripslashes($f['descrizione']);
                                echo "<div class=\"showSlide fade\">";
                                    echo "<img src=\"gallery/" . $nome . "\" />";
                                    echo "<div class=\"content\">" . $titolo . "</div>";
                                echo "</div>";
                            }
                        }
                        else
                        {
                            // stampo un messaggio se il DB è vuoto
                            echo "Nessuna immagine inserita.";
                        }
                    ?>
                    <!-- navigazione immagini con le frecce -->
                    <a class="left" onclick="nextSlide(-1)">❮</a>
                    <a class="right" onclick="nextSlide(1)">❯</a>
                </div>
            </div>
        <script type="text/javascript">
            var slide_index = 1;
            displaySlides(slide_index);

            function nextSlide(n) {
                displaySlides(slide_index += n);
            }

            function currentSlide(n) {
                displaySlides(slide_index = n);
            }

            function displaySlides(n) {
                var i;
                var slides = document.getElementsByClassName("showSlide");
                if (n > slides.length) { slide_index = 1 }
                if (n < 1) { slide_index = slides.length }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slides[slide_index - 1].style.display = "block";
            }
        </script>
        <footer>
            <div id="container">
                <p style="text-align: center">Copyright© 2019 - Bast'azzardo</p>
            </div>
        </footer>
    </body>
</html>