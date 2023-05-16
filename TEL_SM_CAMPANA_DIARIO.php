<?php
// errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
// Fin
//Conexión
require "../db/dbs.php";
  $query = "SELECT * FROM BITACORA.BITACORA_TEL_MCE_AT WHERE (extract(day from FECHA_INSERT) = DAY( current_date()));";
  $select1 = $db->query($query);


  while($row = $select1->fetch_assoc()) {
    $flagToDay = $row['FLAG'];
      }
      if(!isset($flagToDay)){
        $flagToDay = 'Variable name is not set';
      } 
      if ($flagToDay > 0){
        $flagToDayTrue = true;
      }else{
        $flagToDayTrue = false;
  }

  //solicita fecha para insertar
  $queryAyer = "SELECT * FROM DBCLARO.AYER;";
  $resulAyer = $db->query($queryAyer);
  $fechaAyer = $resulAyer->fetch_array(MYSQLI_NUM);

  if($flagToDayTrue != true){
    /* Fechas para parametros del API*/ 
        $StartDay = $fechaAyer['0'];
        $EndDay = $fechaAyer['0'];
    /* Fechas para parametros del API ingreso de forma manual*/ 
        $StartDay_OFF = "2023-02-01";
        $EndDay_OFF = "2023-02-01";
    /* Fechas para parametros del API*/ 


    // Lectura de apis
    $url =  "https://api.supermetrics.com/enterprise/v2/query/data/json?json=%7B%22ds_id%22%3A%22GAWA%22%2C%22ds_accounts%22%3A%22312280652%2C313194337%2C313197438%2C313225970%2C313235558%2C258685345%2C258714624%2C258723616%2C258727454%2C258733415%22%2C%22ds_user%22%3A%22Clarocenam.analytics.omd%40gmail.com%22%2C%22start_date%22%3A%22".$StartDay."%22%2C%22end_date%22%3A%22".$EndDay."%22%2C%22fields%22%3A%22propertyName%2CitemCategory%2CitemName%2CsessionSource%2CsessionMedium%2CsessionCampaignName%2CsessionManualTerm%2CsessionDefaultChannelGrouping%2Cdate%2CtotalUsers%2Csessions%2CitemsAddedToCart%2CitemPurchaseQuantity%2CitemRevenue%22%2C%22settings%22%3A%7B%22blanks_to_zero%22%3Atrue%2C%22allow_sum_unique%22%3Atrue%7D%2C%22max_rows%22%3A1000000%2C%22api_key%22%3A%22api_6Zu872pqQTdMha8EG9t1_q3OLImELChXyMwTpl5HYyl_IOQEtVnWv8GFmRML4vTGjlDe_dBkRh0P9A9R2hYlYqwxCCVHoyj04K%22%7D";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      
    $resp = curl_exec($curl);
    curl_close($curl);
   $jsomp =  json_decode ($resp, true);
   $json_pretty = json_encode($jsomp, JSON_PRETTY_PRINT);


  //  Datos del User
  $mi_ip = $_SERVER["REMOTE_ADDR"];
  $mi_host = $_SERVER["HTTP_HOST"];
  
    //Crea el archivo JSON
    $myfile = fopen("TEL_DIARIO_ANALYTICS_CLARO.json", "w") or die("Error archivo");
    $txt = $json_pretty;
    fwrite($myfile, $txt);
    fclose($myfile);
    //Leemos el archivo creado
    $JsonParser = file_get_contents("TEL_DIARIO_ANALYTICS_CLARO.json");
    $jsomp2 =  json_decode ($JsonParser, true);
    $valorMax = count($jsomp2["data"], COUNT_RECURSIVE);
    $valorMaximoJson = (count($jsomp2["data"]));
    $valorNetoTotal = $valorMaximoJson - 2;
    var_dump($valorNetoTotal);
    echo "Fecha insertada".$EndDay;

    $id_1 = 0;

//inserta bandera en bitacora
            //Conección
        // $servername = "122.8.178.249";
        // $database = "DBCLARO";
        // $username = "automatizacion";
        // $password = "Aut0m4_u23";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        $insert_bitacora = "INSERT INTO `BITACORA`.`BITACORA_TEL_MCE_AT` (`FLAG`, `NOMBRE_JSON`) VALUES ('1', 'TEL_DIARIO_ANALYTICS_CLARO');";
          if (mysqli_query($conn, $insert_bitacora))
          {
            echo "<br>"; echo "BITACORA_CREADA_".$id_1;
            echo "<br>";
          } else {
            echo "Error: " . $insert_bitacora . "<br>" . mysqli_error($conn);
          }
  //Fin inserta bandera en bitacora


    
    while($id_1 <= $valorNetoTotal){
      $id_1++;
      foreach ($jsomp2["data"][$id_1] as $value1) {
          $dato0=$jsomp2["data"][$id_1]["0"];
          $dato1=$jsomp2["data"][$id_1]["1"];
          $dato2=$jsomp2["data"][$id_1]["2"];
          $dato3=$jsomp2["data"][$id_1]["3"];
          $dato4=$jsomp2["data"][$id_1]["4"];
          $dato5=$jsomp2["data"][$id_1]["5"];
          $dato6=$jsomp2["data"][$id_1]["6"];
          $dato7=$jsomp2["data"][$id_1]["7"];
          $dato8=$jsomp2["data"][$id_1]["8"];
          $dato9=$jsomp2["data"][$id_1]["9"];
          $dato10=$jsomp2["data"][$id_1]["10"];
          $dato11=$jsomp2["data"][$id_1]["11"];
          $dato12=$jsomp2["data"][$id_1]["12"];
          $dato13=$jsomp2["data"][$id_1]["13"];
          $dato14=$jsomp2["data"][$id_1]["14"];
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


          $sql = " INSERT INTO `DBCLARO`.`TEL_MCE_AT` (`GA4 property`, `Item category`, `Item name`, 
          `Session source`, `Session medium`, `Session campaign name`, `Session manual term`, 
          `Session default channel grouping`, `Month`, `Year`, `Total users`, `Sessions`, 
          `Items added to cart`, `Item purchase quantity`, `Item revenue`) 
            VALUES ('$dato0' ,'$dato1' ,'$dato2' ,'$dato3' ,'$dato4' ,
            '$dato5'  ,'$dato6'   ,'$dato7'   ,'$dato8'    ,'$dato9'   ,'$dato10'  ,
            '$dato11' ,'$dato12'  ,'$dato13'  ,'$dato14'  );";

          if (mysqli_query($conn, $sql)) 
          {
            $RepInsertSF =  "New_SM".$id_1;
          //  echo "<br>"; 
          //  echo  $RepInsertSF;
           
          } else {
            $RepInsertER =  "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo $RepInsertER;
          }
          mysqli_close($conn);
      // FIN DE INSERT DE LOS DATOS
      // INSERTAR LOG

        $sqlLog = "INSERT INTO `BITACORA`.`LOG_TEL_DIA_AT` (`nombre_api`, `respuesta`, `respuesta_error`) 
        VALUES ('TEL_DIARIO_ANALYTICS_CLARO', '".$RepInsertSF."', '".$RepInsertER."');";
        
        $db->query($sqlLog);
       // $db->close();
      //FIN INSERT LOG
    }

    
  echo "FIN INSERT TOTAL FILAS:_".$id_1;
  
  }else{
    echo "<p>
            Datos ya fueron ingresados hoy.
          </p>";
  }

?>


