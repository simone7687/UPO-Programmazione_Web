<?php
    @include 'config.php';

    $sql = "SELECT * FROM punti_incontro p JOIN comuni c ON p.id_comune = c.id";
    $result = mysql_query($sql);

    $lol = mysql_fetch_array($result);
    echo $lol[nome];
?>