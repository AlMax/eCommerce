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
				$results = $connection->query("INSERT INTO `clienti` (`codice_cliente`, `cognome`, `nome`, `indirizzo`, `citta`, `CAP`, `telefono`, `username`, `password`) VALUES (NULL, '" . $Rcognome . "', '" .  $Rnome . "', '" . $Rindirizzo . "', '" . $Rcitta . "', '" . $Rcap . "', '" .
																			$Rtelefono . "', '" . $Rusername . "', '" . $Rpassword . "');");
				echo "fatto";
				}
		}
    else {
    	$Lusername=$_POST["Lusername"];
 		 	$Lpassword=$_POST["Lpassword"];
      $results = $connection->query("SELECT * FROM clienti WHERE username='$Lusername' LIMIT 1");
			$data=$results->fetch();
			if($data["username"]==$Lusername && $data["password"]==$Lpassword)
				echo "connesso " . $data["cognome"];
			else
				echo "Nope";
		}
	} catch(PDOException $e){
		echo "errore: " . $e->getMessage();
	}
	$connection=null;
?>
