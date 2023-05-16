<?php

    Create connection

    $db = new mysqli("122.8.178.249", "automatizacion", "Aut0m4_u23", "DBCLARO", 3306);
    if ($db->connect_error) {
        die('Error de Conexión (' . $db->connect_errno . ') '
               . $db->connect_error);
    }

    $db_excel = new mysqli("122.8.178.249", "automatizacion", "Aut0m4_u23", "EXCEL", 3306);
    if ($db_excel->connect_error) {
       die('Error de Conexión (' . $db_excel->connect_errno . ') '
               . $db_excel->connect_error);
    }

   
// $db = new mysqli("10.10.2.51", "sistemas", "#Tum@dre!", "medios", 3306);
// if ($db->connect_error) {
//     die('Error de Conexión (' . $db->connect_errno . ') '
//             . $db->connect_error);
// }

    $servername = "122.8.178.249";
    $database = "EXCEL";
    $username = "automatizacion";
    $password = "Aut0m4_u23";

    $servername = "122.8.178.249";
    $database = "DBCLARO";
    $username = "automatizacion";
    $password = "Aut0m4_u23";

    

// $servername = "dbwol.crgpm7pxclx2.us-east-2.rds.amazonaws.com";
// $database = "OMDSM";
// $username = "datasc";
// $password = "D4t4.2022sc";

?>
