<html>
  <title>Ordinazione</title>
  <head>
    <script src="bootstrap-3.3.7/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.1.0/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="css/ordine.css" type="text/css">
    <script src="js/ordine.js"></script>
    <script></script>
    <?php
      $server="localhost";
      $user="AlMax";
      $password="";
      $database="e_commerce";

      try{
          $connection = new PDO("mysql:host=$server;dbname=$database",$user,$password);
          $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          if ($_POST["Lusername"]="ResponsabileOrdinazioni" && $_POST["Lpassword"]="Ordinazione"){
              $Lusername=$_POST["Lusername"];
              $Lpassword=$_POST["Lpassword"];

              if(isset($_POST["aNumero"])){
                $aNumero=$_POST["aNumero"];
                $aProdotto=$_POST["aProdotto"];
                $aQuantita=$_POST["aQuantita"];
                $logging = $connection->query("INSERT INTO `acquisti` (`codice_acquisto`, `data_ordine`, `data_spedizione`, `quantita`, `prodotto`, `cliente`) VALUES (NULL, NOW(), NULL, '" . $aQuantita . "', '" . $aProdotto . "', (SELECT codice_cliente FROM clienti WHERE telefono=" . $aNumero . "))");
              }

      				echo '<form id="form1" method="post" action="ordine.php" style="margin-bottom:0;">
                      <div class="container" width="100%">
    	                   <div class="row" width="100%">
                            <div width="100%">
				                       <div class="panel panel-success" style="border-color:#ffdf00; width="100%">
					                        <div class="panel-heading" style="background-color:#ffdf00;border-color:#ffdf00;color:#f76d09;">
                                     <h3 class="panel-title" align=center>Effettua Ordine</h3>
                                  </div>
					                        <div class="panel-body">
						                         <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
					                        </div>
                                  <table class="table table-hover" id="task-table" >
                                    <thead>
  							                       <tr>
  								                        <th>Numero Telefonico</th>
  								                        <th>Codice prodotto</th>
                                          <th>Quantita</th>
                                          <th>Ordina</th>
  							                       </tr>
  						                      </thead>
                                    <tbody id="bodyT">';

                  echo "<tr>
          								<td><span><input id='numeroTelefonico' name='aNumero' type='text' size='10' align='center'></input></span></td>
          								<td><span><input id='codiceProdotto' name='aProdotto' type='text' size='10' align='center'></input></span></td>
          								<td><span><input id='quantita' name='aQuantita' type='text' size='10' align='center'></input></span></td>
          								<td>
                             <span>
            							      <div class='btn-group btn-group-xs' role='group' aria-label='...'>
              							       <button type='submit' class='btn btn-default' >Conferma Ordine</button>
            								    </div>
                             </span>
                          </td>
          							</tr>";
		          echo "</tbody></table></div></div></div></div></form>";
          }
      } catch(PDOException $e){
        echo "errore: " . $e->getMessage();
      }
      $connection=null;
    ?>
  </head>
  <body></body>
</html>
