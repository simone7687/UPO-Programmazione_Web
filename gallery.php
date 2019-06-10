<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="imgs/favicon.ico" />
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
                <style type="text/css">
                    .showSlide {
                        display: none
                    }
                        .showSlide img {
                            width: 100%;
                        }
                    .slidercontainer {
                        max-width: 1000px;
                        position: relative;
                        margin: auto;
                    }
                    .left, .right {
                        cursor: pointer;
                        position: absolute;
                        top: 50%;
                        width: auto;
                        padding: 16px;
                        margin-top: -22px;
                        color: white;
                        font-weight: bold;
                        font-size: 18px;
                        transition: 0.6s ease;
                        border-radius: 0 3px 3px 0;
                    }
                    .right {
                        right: 0;
                        border-radius: 3px 0 0 3px;
                    }
                        .left:hover, .right:hover {
                            background-color: rgba(115, 115, 115, 0.8);
                        }
                    .content {
                        color: #eff5d4;
                        font-size: 30px;
                        padding: 8px 12px;
                        position: absolute;
                        top: 10px;
                        width: 100%;
                        text-align: center;
                    }
                    .active {
                        background-color: #717171;
                    }
                    /* Fading animation */
                    .fade {
                        -webkit-animation-name: fade;
                        -webkit-animation-duration: 1.5s;
                        animation-name: fade;
                        animation-duration: 1.5s;
                    }
                    @-webkit-keyframes fade {
                        from {
                            opacity: .4
                        }
                        to {
                            opacity: 1
                        }
                    }

                    @keyframes fade {
                        from {
                            opacity: .4
                        }
                        to {
                            opacity: 1
                        }
                    }
                </style>
            </div>
            <div id="navbar">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="recognize.html">Info</a></li>
                    <!-- <li><a href="stop.html">Smettere</a></li> -->
                    <li><a class="active" href="gallery.html">Gallery</a></li>
                    <li><a href="map.php">Mappa</a></li>
                    <li><a href="contactus.php">Contattaci</a></li>
                </ul>
            </div>
        </header>
            <div class="container">
                <div class="slidercontainer">
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
            <div class="container">
                <p style="text-align: center">Copyright© 2019 - Nome società che non so.</p>
            </div>
        </footer>
    </body>
</html>