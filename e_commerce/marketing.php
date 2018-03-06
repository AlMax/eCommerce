<html>
  <title>Marketing</title>
  <head>
    <script src="bootstrap-3.3.7/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.1.0/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="css/marketing.css" type="text/css">
    <script src="js/marketing.js"></script>
    <script></script>
    <?php
      $server="localhost";
      $user="AlMax";
      $password="";
      $database="e_commerce";

      try{
          $connection = new PDO("mysql:host=$server;dbname=$database",$user,$password);
          $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          if ($_POST["Lusername"]="ResponsabileMarketing" && $_POST["Lpassword"]="Marketing"){
              $Lusername=$_POST["Lusername"];
              $Lpassword=$_POST["Lpassword"];

              if(isset($_POST["pElimina"])){
                $pElimina = $_POST["pElimina"];
                $logging = $connection->query("DELETE FROM `prodotti` WHERE `prodotti`.`codice_prodotto` ="  . $pElimina . "");
              } else if(isset($_POST["aDenominazione"])){
                $aDenominazione=$_POST["aDenominazione"];
                $aDescrizione=$_POST["aDescrizione"];
                $aPrezzo=$_POST["aPrezzo"];
                $aQuantita=$_POST["aQuantita"];
                $logging = $connection->query("INSERT INTO `prodotti` (`codice_prodotto`, `denominazione`, `descrizione`, `prezzo`, `quantita`) VALUES (NULL, '" . $aDenominazione . "', '" . $aDescrizione . "', '" . $aPrezzo . "', '" . $aQuantita . "');");
              }

              $results = $connection->query("SELECT * FROM prodotti");
      				echo '<form id="form1" method="post" action="marketing.php" style="margin-bottom:0;">
                      <div class="container" width="100%">
    	                   <div class="row" width="100%">
                            <div width="100%">
				                       <div class="panel panel-success" width="100%">
					                        <div class="panel-heading">
                							       <button type="button" style="background-color:green;color:#d6e9c6;display: inline-block;align: left;height:24px;padding-top:0%;" class="btn btn-default" onclick="aggiungiProdotto();">Aggiungi</button>
						                         <div style="display: inline-block;margin-left:30%"><h3 class="panel-title">Gestione Marketing</h3></div>
							                       <span class="clickable filter" data-toggle="tooltip" style="float: right;vertical-align: middle;" title="Toggle table filter" data-container="body">
								                        <i class="glyphicon glyphicon-filter"></i>
							                       </span>
					                        </div>
					                        <div class="panel-body">
						                         <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
					                        </div>
                                  <table class="table table-hover" id="task-table" >
                                    <thead>
  							                       <tr>
  								                        <th>ID</th>
  								                        <th>Denominazione</th>
  								                        <th>Descrizione</th>
  								                        <th>Prezzo(€)</th>
                                          <th>Quantita</th>
                                          <th>Opzioni</th>
  							                       </tr>
  						                      </thead>
                                    <tbody id="bodyT">';

              $value=0;
              foreach($results as $data)
                  echo "<tr>
          								<td><span id='codice" . ++$value . "' value='" . $data['codice_prodotto'] . "'>" . $data['codice_prodotto'] . "</span></td>
          								<td><span id='denominazione" . $value . "' value='" . $data['denominazione'] . "'><a target='_blank' href='img/".strtolower($data['denominazione']).".jpg'><font color='green'>" . $data['denominazione'] . "</a></span></td>
          								<td><span id='descrizione" . $value . "'>" . $data['descrizione'] . "</span></td>
          								<td><span id='prezzo" . $value . "'>" . $data['prezzo'] . "</span></td>
          								<td><span id='quantita" . $value . "'>" . $data['quantita'] . "</span></td>
          								<td>
                             <span>
            							      <div class='btn-group btn-group-xs' role='group' aria-label='...'>
              							       <button type='submit' class='btn btn-default' id='elimina" . $value . "' value='" . $value . "' onclick='elimina(this.id);'>Elimina</button>
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
