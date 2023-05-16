<?php
  // errores
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL ^ E_NOTICE);
  // Fin
  //Conexión
  require "../db/dbs.php";
  $query = "SELECT * FROM BITACORA.BITACORA_LINK_CAMPANA_AT WHERE (extract(day from FECHA_INSERT) = DAY( current_date()));";
  $select1 = $db->query($query);


  while ($row = $select1->fetch_assoc()) {
    $flagToDay = $row['FLAG'];
  }
  if (!isset($flagToDay)) {
    $flagToDay = 'Variable name is not set';
  }
  if ($flagToDay > 0) {
    $flagToDayTrue = true;
  } else {
    $flagToDayTrue = false;
  }

  //solicita fecha para insertar
  $queryMes = "SELECT * FROM DBCLARO.AYER;";
  $resultMes = $db->query($queryMes);
  $fechaAyer = $resultMes->fetch_array(MYSQLI_NUM);
  // Vista del mes en curso
  $queryMes = "SELECT * FROM DBCLARO.MES_ACTUAL;";
  $resultMes = $db->query($queryMes);
  $fechaMes = $resultMes->fetch_array(MYSQLI_NUM);
  // Vista año en curso
  $queryAño = "SELECT * FROM DBCLARO.AÑO_ACTUAL;";
  $resultAño = $db->query($queryAño);
  $añoActual = $resultAño->fetch_array(MYSQLI_NUM);

// /* PRUEBAS */  
// echo  "****_____****";
// //print_r($fechaMes);
// echo $fechaMes[0];
//  echo  "****___|___****";
//  //var_dump($añoActual);
//  echo $añoActual[0];
//  echo  "****_____****";
//  $StartDay = $fechaAyer['0'];
//  $EndDay = $fechaAyer['0'];
//  $url = "https://aws1-api-default.supermetrics.com/enterprise/v2/query/data/json?json=%7B%22ds_id%22%3A%22LIA%22%2C%22ds_accounts%22%3A%22506826859%2C506921931%2C506924860%2C506959428%2C506967337%2C507160827%2C508329927%2C510060900%22%2C%22ds_user%22%3A%22xtHWhYnlIX%22%2C%22start_date%22%3A%22" . $StartDay . "%22%2C%22end_date%22%3A%22" . $EndDay . "%22%2C%22fields%22%3A%22accountName%2CaccountId%2CcampaignName%2CcampaignStatus%2CcampaignStartDate%2CcampaignEndDate%2CcampaignTotalBudget%2CcampaignObjectiveType%2CcampaignCostType%2CcampaignGroupName%2CcampaignGroupStatus%2CcampaignGroupStartDate%2CcampaignGroupEndDate%2CcampaignGroupTotalBudget%2CyearMonth%2Cdate%2Cimpressions%2Cclicks%2Cctr%2Ccpc%2Ccpm%2Cspend_usd%2Copens%2Csends%2CactionClicks%2Cconversions%2CconversionCost%2CvideoThirdQuartileCompletions%2CvideoViews%22%2C%22settings%22%3A%7B%22blanks_to_zero%22%3Atrue%2C%22allow_sum_unique%22%3Atrue%7D%2C%22filter%22%3A%22campaignGroupName+%3D%40+_".$fechaMes[0]."_+AND+campaignGroupName+%3D%40+_".$añoActual[0]."_%22%2C%22max_rows%22%3A1000000%2C%22api_key%22%3A%22api_6Zu872pqQTdMha8EG9t1_q3OLImELChXyMwTpl5HYyl_IOQEtVnWv8GFmRML4vTGjlDe_dBkRh0P9A9R2hYlYqwxCCVHoyj04K%22%7D";
//  echo "<br>";
//  echo $url;
//  echo "<br>";
//  var_dump( $StartDay);
//  echo "<br> ---------++++++++++----------";
//  echo $EndDay;
//  echo "<br> ---------++++++++++----------";
// /* FIN PRUEBAS */


  if ($flagToDayTrue != true) {
    /* Fechas para parametros del API*/
    $StartDay = $fechaAyer['0'];
    $EndDay = $fechaAyer['0'];
    /* Fechas para parametros del API ingreso de forma manual*/
    $StartDay_OFF = "2023-02-01";
    $EndDay_OFF = "2023-02-01";
    /* Fechas para parametros del API*/





    // Lectura de apis
    $url = "https://aws1-api-default.supermetrics.com/enterprise/v2/query/data/json?json=%7B%22ds_id%22%3A%22LIA%22%2C%22ds_accounts%22%3A%22506826859%2C506921931%2C506924860%2C506959428%2C506967337%2C507160827%2C508329927%2C510060900%22%2C%22ds_user%22%3A%22xtHWhYnlIX%22%2C%22start_date%22%3A%22" . $StartDay . "%22%2C%22end_date%22%3A%22" . $EndDay . "%22%2C%22fields%22%3A%22accountName%2CaccountId%2CcampaignName%2CcampaignStatus%2CcampaignStartDate%2CcampaignEndDate%2CcampaignTotalBudget%2CcampaignObjectiveType%2CcampaignCostType%2CcampaignGroupName%2CcampaignGroupStatus%2CcampaignGroupStartDate%2CcampaignGroupEndDate%2CcampaignGroupTotalBudget%2CyearMonth%2Cdate%2Cimpressions%2Cclicks%2Cctr%2Ccpc%2Ccpm%2Cspend_usd%2Copens%2Csends%2CactionClicks%2Cconversions%2CconversionCost%2CvideoThirdQuartileCompletions%2CvideoViews%22%2C%22settings%22%3A%7B%22blanks_to_zero%22%3Atrue%2C%22allow_sum_unique%22%3Atrue%7D%2C%22filter%22%3A%22campaignGroupName+%3D%40+_".$fechaMes[0]."_+AND+campaignGroupName+%3D%40+_".$añoActual[0]."_%22%2C%22max_rows%22%3A1000000%2C%22api_key%22%3A%22api_6Zu872pqQTdMha8EG9t1_q3OLImELChXyMwTpl5HYyl_IOQEtVnWv8GFmRML4vTGjlDe_dBkRh0P9A9R2hYlYqwxCCVHoyj04K%22%7D";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $jsomp =  json_decode($resp, true);
    $json_pretty = json_encode($jsomp, JSON_PRETTY_PRINT);


    //  Datos del User
    $mi_ip = $_SERVER["REMOTE_ADDR"];
    $mi_host = $_SERVER["HTTP_HOST"];

    //Crea el archivo JSON
    $myfile = fopen("LK_DIARIO_CAMPANA_CLARO.json", "w") or die("Error archivo");
    $txt = $json_pretty;
    fwrite($myfile, $txt);
    fclose($myfile);
    //Leemos el archivo creado
    $JsonParser = file_get_contents("LK_DIARIO_CAMPANA_CLARO.json");
    $jsomp2 =  json_decode($JsonParser, true);
    $valorMax = count($jsomp2["data"], COUNT_RECURSIVE);
    $valorMaximoJson = (count($jsomp2["data"]));
    $valorNetoTotal = $valorMaximoJson - 2;
    var_dump($valorNetoTotal);
    echo "Fecha insertada" . $EndDay;

    $id_1 = 0;

    //inserta bandera en bitacora
    //Conección
    // $servername = "122.8.178.249";
    // $database = "DBCLARO";
    // $username = "automatizacion";
    // $password = "Aut0m4_u23";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    $insert_bitacora = "INSERT INTO `BITACORA`.`BITACORA_LINK_CAMPANA_AT` (`FLAG`, `NOMBRE_JSON`) VALUES ('1', 'LK_DIARIO_CAMPANA_CLARO');";
    if (mysqli_query($conn, $insert_bitacora)) {
      echo "<br>";
      echo "BITACORA_CREADA_" . $id_1;
      echo "<br>";
    } else {
      echo "Error: " . $insert_bitacora . "<br>" . mysqli_error($conn);
    }
    //Fin inserta bandera en bitacora



    while ($id_1 <= $valorNetoTotal) {
      $id_1++;
      foreach ($jsomp2["data"][$id_1] as $value1) {
        $dato0 = $jsomp2["data"][$id_1]["0"];
        $dato1 = $jsomp2["data"][$id_1]["1"];
        $dato2 = $jsomp2["data"][$id_1]["2"];
        $dato3 = $jsomp2["data"][$id_1]["3"];
        $dato4 = $jsomp2["data"][$id_1]["4"];
        $dato5 = $jsomp2["data"][$id_1]["5"];
        $dato6 = $jsomp2["data"][$id_1]["6"];
        $dato7 = $jsomp2["data"][$id_1]["7"];
        $dato8 = $jsomp2["data"][$id_1]["8"];
        $dato9 = $jsomp2["data"][$id_1]["9"];
        $dato10 = $jsomp2["data"][$id_1]["10"];
        $dato11 = $jsomp2["data"][$id_1]["11"];
        $dato12 = $jsomp2["data"][$id_1]["12"];
        $dato13 = $jsomp2["data"][$id_1]["13"];
        $dato14 = $jsomp2["data"][$id_1]["14"];
        $dato15 = $jsomp2["data"][$id_1]["15"];
        $dato16 = $jsomp2["data"][$id_1]["16"];
        $dato17 = $jsomp2["data"][$id_1]["17"];
        $dato18 = $jsomp2["data"][$id_1]["18"];
        $dato19 = $jsomp2["data"][$id_1]["19"];
        $dato20 = $jsomp2["data"][$id_1]["20"];
        $dato21 = $jsomp2["data"][$id_1]["21"];
        $dato22 = $jsomp2["data"][$id_1]["22"];
        $dato23 = $jsomp2["data"][$id_1]["23"];
        $dato24 = $jsomp2["data"][$id_1]["24"];
        $dato25 = $jsomp2["data"][$id_1]["25"];
        $dato26 = $jsomp2["data"][$id_1]["26"];
        $dato27 = $jsomp2["data"][$id_1]["27"];
        $dato28 = $jsomp2["data"][$id_1]["28"];
      }
      // INSERT DE LOS DATOS
      //Conección
      // $servername = "122.8.178.249";
      // $database = "DBCLARO";
      // $username = "automatizacion";
      // $password = "Aut0m4_u23";
      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $database);
      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      //require './db.php';
      //echo "Connected successfully";


      $sql = " INSERT INTO `DBCLARO`.`LINK_CAMPANA_AT` (`Fecha_insert`, `Account name`, 
          `Account ID`, `Campaign name`, `Campaign status`, `Campaign start date`,
          `Campaign end date`, `Campaign total budget`, `Campaign objective type`, 
          `Campaign cost type`, `Campaign group name`, `Campaign group status`, 
          `Campaign group start date`, `Campaign group end date`, `Campaign group total budget`,
          `Year & month`, `Impressions`, `Clicks`, `CTR`, `CPC`, `CPM`, `Total spent (USD)`,
          `Opens`, `Sends`, `Action clicks`, `Conversions`, `Cost per conversion`, 
          `Video views at 75%`, `Video views`) 
            VALUES ('$dato15', '$dato0' ,'$dato1' ,'$dato2' ,'$dato3' ,'$dato4'   ,
            '$dato5'  ,'$dato6'   ,'$dato7'   ,'$dato8'   ,'$dato9'   ,'$dato10'  ,
            '$dato11' ,'$dato12'  ,'$dato13'  ,'$dato14'  ,'$dato16'  ,
            '$dato17' ,'$dato18'  ,'$dato19'  ,'$dato20'  ,'$dato21'  ,'$dato22'  ,
            '$dato23' ,'$dato24'  ,'$dato25'  ,'$dato26'  ,'$dato27'  ,'$dato28'  );";

      if (mysqli_query($conn, $sql)) 
      {
        $RepInsertSF =  "New_SM".$id_1;
        echo "<br>"; 
        echo  $RepInsertSF;

      } else {
        $RepInsertER =  "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo $RepInsertER;
      }
      mysqli_close($conn);
      // FIN DE INSERT DE LOS DATOS
      // INSERTAR LOG

      $sqlLog = "INSERT INTO `BITACORA`.`LOG_GENERAL_AT` (`nombre_api`, `respuesta`, `respuesta_error`) 
        VALUES ('LK_DIARIO_CAMPANA_CLARO', '" . $RepInsertSF . "', '" . $RepInsertER . "');";

      $db->query($sqlLog);

      //FIN INSERT LOG
    }
  } else {
    echo "Datos ya fueron ingresados hoy.";
  }
?>