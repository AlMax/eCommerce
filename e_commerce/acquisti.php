<html>
  <title>Acquisti</title>
  <head>
    <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css"/>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.7/js/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" href="css/acquisti.css" type="text/css">
    <script src="js/acquisti.js"></script>
    <?php
      $server="localhost";
      $user="AlMax";
      $password="";
      $database="e_commerce";

      try{
          $connection = new PDO("mysql:host=$server;dbname=$database",$user,$password);
          $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


          if (isset($_POST["register-submit"])) {
              $Rusername=$_POST["Rusername"];
              $Rpassword=$_POST["Rpassword"];
              $results = $connection->query("SELECT * FROM clienti WHERE username='$Rusername' LIMIT 1");
              $data=$results->fetch();
              if($data["username"]==$Rusername && $data["password"]==$Rpassword)
                  echo "Nope";
              else{
                  $Rcognome=$_POST["Rcognome"];
                  $Rnome=$_POST["Rnome"];
                  $Rindirizzo=$_POST["Rindirizzo"];
                  $Rcitta=$_POST["Rcitta"];
                  $Rcap=$_POST["Rcap"];
                  $Rtelefono=$_POST["Rtelefono"];
                  $Rusername=$_POST["Rusername"];
                  $Rpassword=$_POST["Rpassword"];
                  $results = $connection->query("INSERT INTO `clienti` (`codice_cliente`, `cognome`, `nome`, `indirizzo`, `citta`, `CAP`, `telefono`, `username`, `password`) VALUES (NULL, '" . $Rcognome . "', '" .  $Rnome . "', '" . $Rindirizzo . "', '" . $Rcitta . "', '" . $Rcap . "', '" . $Rtelefono . "', '" . $Rusername . "', '" . $Rpassword . "');");
                  echo "fatto";
             }
          //Registrazione.
          } else {
              $Lusername=$_POST["Lusername"];
              $Lpassword=$_POST["Lpassword"];
              $logging = $connection->query("SELECT * FROM clienti WHERE username='$Lusername' LIMIT 1");
              $log = $logging->fetch();
              if(isset($_POST["mQuantita"])){
                $mQuantita=$_POST["mQuantita"];
                $mAcquisto=$_POST["mProdotto"];
                foreach($connection->query("SELECT prodotto FROM acquisti where codice_acquisto=".$mAcquisto."") as $codice);
                  $mCodice = $codice["prodotto"];
                foreach($connection->query("SELECT quantita FROM acquisti where codice_acquisto =" .$mAcquisto. "") as $qOrdinata){
                  $logging = $connection->query("UPDATE `e_commerce`.`acquisti` SET `quantita` = '" . $mQuantita . "' WHERE `acquisti`.`codice_acquisto` = " . $mAcquisto . "");
                  foreach ($connection->query("SELECT quantita from prodotti where codice_prodotto=" . $mCodice) as $totale){
                      if($totale['quantita']>($mQuantita-$qOrdinata['quantita']))
                        $logging = $connection->query("UPDATE `prodotti` SET `quantita` = ".$totale['quantita']."-".($mQuantita-$qOrdinata['quantita'])." WHERE `prodotti`.`codice_prodotto` =".$mCodice."");
                      else{
                        $logging = $connection->query("UPDATE `prodotti` SET `quantita` = 0 WHERE `prodotti`.`codice_prodotto` =".$mCodice."");
                        $logging = $connection->query("UPDATE `e_commerce`.`acquisti` SET `quantita` = '" . $totale['quantita'] . "+" . $qOrdinata['quantita'] . "' WHERE `acquisti`.`codice_acquisto` = " . $mAcquisto . "");
                      }
                  }
                }
              } else if(isset($_POST["aElimina"])){
                $aElimina = $_POST["aElimina"];
                $logging = $connection->query("DELETE FROM `acquisti` WHERE `acquisti`.`codice_acquisto` ="  . $aElimina . "");
              }else if(isset($_POST["aCodice"])){
                $aCodice = $_POST["aCodice"];
                $aQuantita = $_POST["aQuantita"];
                foreach ($connection->query("SELECT quantita from prodotti where codice_prodotto=" . $aCodice) as $totale){
                    if($totale['quantita']>=$aQuantita){
                        $logging = $connection->query("INSERT INTO `acquisti` (`codice_acquisto`, `data_ordine`, `data_spedizione`, `quantita`, `prodotto`, `cliente`) VALUES (NULL, NOW(), NULL, '".$aQuantita."', '".$aCodice."', '".$log['codice_cliente']."')");
                        $logging = $connection->query("UPDATE `prodotti` SET `quantita` = ".$totale['quantita']."-".$aQuantita." WHERE `prodotti`.`codice_prodotto` =".$aCodice."");
                    }else
                        echo '<script>alert("Disponibilità carente!");</script>';

                }
              }
              $results = $connection->query("SELECT a.codice_acquisto,p.codice_prodotto,p.denominazione,p.descrizione,p.prezzo,a.quantita
									                           FROM acquisti a,clienti c,prodotti p
								                             WHERE a.prodotto=p.codice_prodotto AND a.cliente=c.codice_cliente
								                             AND a.cliente=" . $log['codice_cliente']);
      				echo "<form id='form1' method='post' action='acquisti.php' style='margin-bottom:0;'>
                      <div class='container'>
            						<div class='listWrap'>
            							<ul class='list'>
            								<li>
            									<span>ID</span>
            									<span>DENOMINAZIONE</span>
            									<span>DESCRIZIONE</span>
            									<span>PREZZO</span>
            									<span>QUANTITA</span>
            									<span>OPERAZIONI</span>
            								</li>";
              $value=0;
              foreach($results as $data)
                if($log["username"]==$Lusername && $log["password"]==$Lpassword)
                  echo "<li>
          								<span>" . $data['codice_acquisto'] . "</span>
          								<span>" . $data['denominazione'] . "</span>
          								<span>" . $data['descrizione'] . "</span>
          								<span>" . $data['prezzo'] . "</span>
          								<span id='" . ++$value . "'>" . $data['quantita'] . "</span>
          								<span>
            									<div class='btn-group btn-group-xs' role='group' aria-label='...'>
                                <input type='hidden' id='acquisto" . $value . "' value='" .$data['codice_acquisto']. "'></input>
                                <input type='hidden' name='Lusername' value='" .$Lusername."'></input>
                                <input type='hidden' name='Lpassword' value='" .$Lpassword."'></input>
              									<button type='button' class='btn btn-default' id='modifica" . $value . "' value='" . $value . "' onclick='modificaQ(this.id);'>Modifica</button>
              									<button type='submit' class='btn btn-default' id='elimina" . $value . "' value='" . $value . "' onclick='eliminaA(this.id);'>Elimina</button>
            									</div>
                          </span>
          							</li>";
                else
                  echo $Lusername . $Lpassword . " Nope" . $log["username"] . $log["password"];
		          echo "</ul></div></div>";
              $results = $connection->query("SELECT * FROM prodotti");
              echo '<div class="container" width="100%">
                         <div class="row" width="100%">
                            <div width="100%">
                               <div class="panel panel-success" style="border-color:#f450ff; width="100%">
                                  <div class="panel-heading" style="background-color:#f450ff;border-color:#f450ff;color:#660066;">
                                     <h3 class="panel-title" display= "inline-block">Magazzino</h3>
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
                                          <th>Disponibilità</th>
                                          <th>Opzioni</th>
                                       </tr>
                                    </thead>
                                    <tbody id="bodyT">';

              $value=0;
              foreach($results as $data)
                  echo "<tr>
                          <td><span id='Codice" . ++$value . "' value='" . $data['codice_prodotto'] . "'>" . $data['codice_prodotto'] . "</span></td>
                          <td><span id='denominazione" . $value . "' value='" . $data['denominazione'] . "'><a target='_blank' href='img/".strtolower($data['denominazione']).".jpg'><font color='#660066'>" . $data['denominazione'] . "</a></span></td>
                          <td><span id='descrizione" . $value . "'>" . $data['descrizione'] . "</span></td>
                          <td><span id='prezzo" . $value . "'>" . $data['prezzo'] . "</span></td>
                          <td><span id='quantita" . $value . "'>" . $data['quantita'] . "</span></td>
                          <td>
                             <span>
                                <div id='bottoni' class='btn-group btn-group-xs' role='group' aria-label='...'>
                                   <button type='button' class='btn btn-default' id='aggiungi" . $value . "' value='" . $value . "' onclick='aggiungi(this.id);'>Acquista</button>
                                </div>
                             </span>
                          </td>
                        </tr>";
              echo "</tbody></table></div></div></div></div></form>";
          }
      } catch(PDOException $e){
        echo "Non sei Registrato.";
      }
      $connection=null;
    ?>
  </head>
  <body></body>
</html>
