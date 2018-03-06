<html>
  <title>Magazzino</title>
  <head>
    <script src="bootstrap-3.3.7/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.1.0/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="css/magazzino.css" type="text/css">
    <script src="js/magazzino.js"></script>
    <script></script>
    <?php
      $server="localhost";
      $user="AlMax";
      $password="";
      $database="e_commerce";

      try{
          $connection = new PDO("mysql:host=$server;dbname=$database",$user,$password);
          $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          if ($_POST["Lusername"]="ResponsabileMagazzino" && $_POST["Lpassword"]="Magazzino"){
              $Lusername=$_POST["Lusername"];
              $Lpassword=$_POST["Lpassword"];

              if(isset($_POST["mCodice"])){
                $mCodice=$_POST["mCodice"];
                $mDenominazione=$_POST["mDenominazione"];
                $mDescrizione=$_POST["mDescrizione"];
                $mPrezzo=$_POST["mPrezzo"];
                $mQuantita=$_POST["mQuantita"];
                $logging = $connection->query("UPDATE `e_commerce`.`prodotti` SET `denominazione` = '" . $mDenominazione . "' , `descrizione` = '" . $mDescrizione . "' , `prezzo` = '" . $mPrezzo . "' , `quantita` = '" . $mQuantita . "' WHERE `prodotti`.`codice_prodotto` = " . $mCodice . "");
              }

              $results = $connection->query("SELECT * FROM prodotti");
      				echo '<form id="form1" method="post" action="magazzino.php" style="margin-bottom:0;">
                      <div class="container" width="100%">
    	                   <div class="row" width="100%">
                            <div width="100%">
				                       <div class="panel panel-success" style="border-color:#ff9966; width="100%">
					                        <div class="panel-heading" style="background-color:#ff9966;border-color:#ff9966;color:#993300;">
                                     <h3 class="panel-title" display= "inline-block">Gestione Magazzino</h3>
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
          								<td><a target='_blank' href='img/".strtolower($data['denominazione']).".jpg'><font color='#993300'><span id='denominazione" . $value . "' value='" . $data['denominazione'] . "'>" . $data['denominazione'] . "</a></span></td>
          								<td><span id='descrizione" . $value . "'>" . $data['descrizione'] . "</span></td>
          								<td><span id='prezzo" . $value . "'>" . $data['prezzo'] . "</span></td>
          								<td><span id='quantita" . $value . "'>" . $data['quantita'] . "</span></td>
          								<td>
                             <span>
            							      <div class='btn-group btn-group-xs' role='group' aria-label='...'>
              							       <button type='button' class='btn btn-default' id='modifica" . $value . "' value='" . $value . "' onclick='modifica(this.id);'>Modifica</button>
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
