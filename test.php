<?php
    @include 'config.php';

    $sql = "SELECT * FROM punti_incontro WHERE id = 2";
    $result = mysql_query($sql);

    $lol = mysql_fetch_array($result);
    echo $lol[nome];
?>