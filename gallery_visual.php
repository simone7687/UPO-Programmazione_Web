<!-- permette la visualizzazione della galleria di immagini.
Per rendere l'output più elegante e facile da navigare incolonneremo per 3 le immagini, questo valore può naturalmente essere modificato a piacimento.
Ogni miniatura sarà anche un link collegato alla pagina per l'ingrandimento dell'immagine stessa, cioè il file grafico originale. -->
<?php
    if(isset($_GET['id']))
    {
        @include 'config.php';
      
        // apro la tabella
        echo "<table><tr><td>";
      
        // recupero dalla querystring l'ID dell'immagine da visualizzare
        $id_vis = $_GET['id'];
      
        // verifico la presenza dell'immagine sul DB
        $query = "SELECT * FROM images WHERE id = '$id_vis'";
        $res = @mysql_query($query) or die (mysql_error());
        $n_img = @mysql_num_rows($res);
      
        // se l'id specificato esiste procedo con la visualizzazione
        if($n_img == 1 )
        {
            // recupero i dati dell'immagine selezionata
            $f = @mysql_fetch_array($res) or die (mysql_error());
            $titolo = stripslashes($f['titolo']);
            $nome = stripslashes($f['nome']);
            $descrizione = stripslashes($f['descrizione']);
        
            // stampo a video l'imagine e le relative informazioni
            echo $titolo . "<br />";
            echo "<img src=\"" . $path_img . $nome . "\" border=\"0\">";
            echo "<br />" . $descrizione . "<br><br>";
        
            // estraggo dal DB il primo e l'ultimo ID
            $sql_count = @mysql_query("SELECT MIN(id) AS min, MAX(id) AS max FROM images") or die (mysql_error());
            $id_max = @mysql_fetch_array($sql_count) or die (mysql_error());
            $min = $id_max['min'];
            $max = $id_max['max'];
        
            // calcolo e stampo il link per l'immagine precedente
            if($_GET['id'] != $min)
            {
                $query_prev = @mysql_query("SELECT id FROM images WHERE id < '$id_vis' ORDER BY id DESC LIMIT 1") or die (mysql_error());
                $f_prev = @mysql_fetch_array($query_prev)or die (mysql_error());
                $id_prev = $f_prev['id'];
                echo "<a href=\"gallery_visual.php?id=$id_prev\">&lt;&lt; Precedente</a>";
            }
        
            // calcolo e stampo il link per l'immagine successiva
            if($_GET['id'] < $max)
            {
                $query_next = @mysql_query("SELECT id FROM images WHERE id > '$id_vis' ORDER BY id ASC LIMIT 1") or die (mysql_error());
                $f_next = @mysql_fetch_array($query_next)or die (mysql_error());
                $id_next = $f_next['id'];
                echo "<a href=\"gallery_visual.php?id=$id_next\">Successiva &gt;&gt;</a>";
            }
        }
        else
        {
          // stampo un errore se l'immagine non esiste
          echo "Nessuna immagine inserita.";
        }
        // chiudo la tabella
        echo "</td></tr></table>";
    }
?>