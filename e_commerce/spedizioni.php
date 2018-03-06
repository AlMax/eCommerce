<html>
  <title>Spedizioni</title>
  <head>
    <script src="bootstrap-3.3.7/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.1.0/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="css/spedizioni.css" type="text/css">
    <script src="js/spedizioni.js"></script>
    <script></script>
    <?php
      $server="localhost";
      $user="AlMax";
      $password="";
      $database="e_commerce";

      try{
          $connection = new PDO("mysql:host=$server;dbname=$database",$user,$password);
          $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          if ($_POST["Lusername"]="ResponsabileSpedizioni" && $_POST["Lpassword"]="Spedizioni"){
              $Lusername=$_POST["Lusername"];
              $Lpassword=$_POST["Lpassword"];

              if(isset($_POST["sCodice"])){
                $sCodice=$_POST["sCodice"];
                $logging = $connection->query("UPDATE `acquisti` SET `data_spedizione` = NOW() WHERE `acquisti`.`codice_acquisto` = " . $sCodice);
              }

              $results = $connection->query("SELECT * FROM `acquisti` where data_spedizione IS NULL");

      				echo '<form id="form1" method="post" action="spedizioni.php" style="margin-bottom:0;">
                      <div class="container" width="100%">
    	                   <div class="row" width="100%">
                            <div width="100%">
				                       <div class="panel panel-success" style="border-color:#b3f0ff; width="100%">
					                        <div class="panel-heading" style="background-color:#b3f0ff;border-color:#b3f0ff;color:#005266;">
                                     <h3 class="panel-title" display= "inline-block">Gestione Spedizioni</h3>
                                     <div class="pull-right">
  							                       <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
  								                        <i class="glyphicon glyphicon-filter"></i>
  							                       </span>
                                     </div>
					                        </div>
					                        <div class="panel-body">
						                         <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
					                        </div>
                                  <table class="table table-hover" id="task-table" >
                                    <thead>
  							                       <tr>
  								                        <th>ID Acquisto</th>
                                          <th>Data Spedizione</th>
                                          <th>Inserisci</th>
  							                       </tr>
  						                      </thead>
                                    <tbody id="bodyT">';

              $value=0;
              foreach($results as $data)
                  echo "<tr>
          								<td><span id='codice" . ++$value . "' value='" . $data['codice_acquisto'] . "'>" . $data['codice_acquisto'] . "</span></td>
                          <td><input name='data" . $data['codice_acquisto'] . "' type='date' style='line-height:18px;' ></td>
          								<td>
                             <span>
            							      <div class='btn-group btn-group-xs' role='group' aria-label='...'>
              							       <button type='button' class='btn btn-default' id='inserisci" . $value . "' value='" .  $data['codice_acquisto'] . "' onclick='spedisci(this.id)'>Spedito</button>
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
