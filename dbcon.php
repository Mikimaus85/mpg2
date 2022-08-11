<?php
   $con = mysqli_connect("localhost", "mbojanic", "MB-1285la", "solutions_mb");

   if(!$con){
        die('Verbindung fehlgeschlagen!'.mysqli_connect_error());
   }
?>