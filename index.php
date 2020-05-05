<!-- https://codepen.io/jh3y/pen/GRpMZZG  <-- AUTHENTIFICATION EN CSS  -->

<?php 
	$Message = "";
	$Demande = "";

	if (isset($_GET['Imposer_Table'])) { 						// Si il y a la variable GET dans l'URL 
		if (empty($_GET['Imposer_Table'])) 						// si c'est vide et donc aucune table imposé
			$Demande = 'Random';								// demande table aléatoires
		else if ($_GET['Imposer_Table'] > 10 OR (!ctype_digit($_GET['Imposer_Table'])))  // si > à 10 OU n'est pas un nombre entier	
			$Message = 'Erreur_Table';							// affichage message erreur
		else	
			$Demande = 'Imposer';								// demande table imposer
	}

	if (isset($_GET['Retrouver_Multiplication']) AND ($_GET['Retrouver_Multiplication'] !== "on"))	// Si il y a la variable GET dans l'URL AND si c'est different de ON, l'user à saisi un truc dans l'url à la place de la case à cocher
			$_GET['Retrouver_Multiplication'] = "";				// on vide la variable

	if (isset($_GET['Melanger']) AND ($_GET['Melanger'] !== "on"))	// Si il y a la variable GET dans l'URL AND si c'est different de ON, l'user à saisi un truc dans l'url à la place de la case à cocher
			$_GET['Melanger'] = "";								// on vide la variable
	// print_r($_GET);	    // affiche toutes les variables GET
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>MATH</title>
		<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 		<!--  charset="iso-8859-1" -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			/*  CSS HTML lightblue */
			body {font-family: 'Sofia';font-size: 16px; background-color: hotpink;}
			a:link {color: pink;}
			a:visited {color: pink;}
			a:active {color: pink;}
			a:hover {color: lightblue;}

			/*  DIV SPOILER  background-color: lightblue; */
			<?php  
				for ($i = 1 ; $i <=10 ; $i++) {
					echo '#DIV_Spoiler_' . $i . ' {width: 100%; padding: 0px 0; text-align: center; margin-top: 0px; display: none;}';
				}
			?>
			#div_button_Bravo {display: none;}
			
			/*  BOUTON */
			.button {
			border: none;
			color: white;
			padding: 5px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			}

			.button_Bravo {background-color: #4CAF50;} /* Green */
			.button_GO {background-color: #e7e7e7; color: black;} /* Gray */
			.button_Reponse {background-color: #008CBA;} /* Blue */ 

			/*  TABLEAU #f2f2f2 */
			table {
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
			border: 2px solid #ddd;
			}

			th, td {
			text-align: center;
			padding: 10px;
			}

			tr:nth-child(even) {
			background-color: #FF85F2;
			}
		</style>

	</head>
	<body>
		<a href="index.php" target=""><h2>Apprendre les multiplications</h2></a>
		<form action="index.php">
		<label for="Imposer_Table">Imposer une table ? :</label> 
		<input type="text" id="Imposer_Table" name="Imposer_Table" value="<?php if (empty($_GET['Imposer_Table'])) {} else{echo htmlspecialchars($_GET['Imposer_Table']);} ?>"><br><br>
		<label for="Retrouver_Multiplication">Retrouver la multiplication ?</label> 
		<input type="checkbox" name="Retrouver_Multiplication" id="Retrouver_Multiplication" <?php if (isset($_GET['Retrouver_Multiplication'])) {if ($_GET['Retrouver_Multiplication'] == "on") {echo 'checked';}}?>/> <label for="Retrouver_Multiplication">(Oui)</label><br><br>
		<label for="Melanger">Mélanger ?</label> 
		<input type="checkbox" name="Melanger" id="Melanger" checked <?php if (isset($_GET['Melanger'])) {if ($_GET['Melanger'] == "on") {echo 'checked';}}?>/> <label for="Melanger">(Oui)</label><br><br>
		<input class="button button_GO" type="submit" value="C'est parti !">
		</form> 
		<br>

		<p id="demo"></p>
		<p id="demo2"></p>

		<?php 
			if ($Message == 'Erreur_Table')	{ 
				echo '<h2 style="background-color:Tomato; "color:white"> Il faut donner un nombre entre 1 et 10, vous avez mis : " ' . htmlspecialchars($_GET['Imposer_Table']) . ' "</h2>';
				goto pas_de_calcul;
			}

			if ($Demande == "Random") {																			// demande table aléatoires 
				if (isset($_GET['Retrouver_Multiplication']) AND ($_GET['Retrouver_Multiplication'] == "on")) { // Affichage table aléatoires et inversé
						echo '<b>faire Retrouver_Multiplication  </b><br>';
				}
				else {																							// Affichage table aléatoires
					echo 'Voici 10 opérations aléatoires : <br>';
					echo '<table><tr><th> Calcul </th><th> Vérification </th></tr><tr>';
					for ($i = 1 ; $i <=10 ; $i++) { 
						$n1 = rand(1, 10);
						$n2 = rand(1, 10);

						echo  '<td>' . $n1 . ' x ' . $n2 . ' = </td> <td> <img src="ressources/pokemon/coeur1.png">&nbsp;<img src="ressources/pokemon/coeur2.png">&nbsp;<img src="ressources/pokemon/coeur1.png"> <button class="button button_Reponse" onclick="Function_Spoiler(' . $i . ')"> Réponse ' . $i . '</button> <img src="ressources/pokemon/coeur1.png">&nbsp;<img src="ressources/pokemon/coeur2.png">&nbsp;<img src="ressources/pokemon/coeur1.png">
						<div id="DIV_Spoiler_' . $i . '"> <h1>' . $n1 * $n2 . ' <img src="ressources/pokemon/g5/' . rand(1,753) . '.png"></h1></div></td></tr>';
					}
					echo '<td></td><td><div id="div_button_Bravo"><button class="button button_Bravo" onclick="window.location.href=\'bravo.php\'"> <b>*** BRAVO ***</b> </button></div></td></table>';
					echo '<br><i>En aléatoire, cochez "mélanger" ne sert à rien :o)</i>';
				}
			}

			if ($Demande == "Imposer") {															// Demande table imposer 
				if ((isset($_GET['Retrouver_Multiplication']) AND ($_GET['Retrouver_Multiplication'] == "on")) AND (isset($_GET['Melanger']) AND ($_GET['Melanger'] == "on"))) {
					echo "Voici 10 opérations d'une table imposée inversées et mélangées :<br>"; 	// affichage table imposer : mélangé et inversé
				} 
				else if (isset($_GET['Retrouver_Multiplication']) AND ($_GET['Retrouver_Multiplication'] == "on"))
					echo "Voici 10 opérations d'une table imposée et inversées :<br>";				// affichage table imposer : inversé
				else if (isset($_GET['Melanger']) AND ($_GET['Melanger'] == "on")){
					echo "Voici 10 opérations d'une table imposée et mélangées :<br>";				// affichage table imposer : mélangé
					$nb_random_liste = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
					echo '<table><tr><th> Calcul </th><th> Vérification </th></tr><tr>';
					
					for ($i = 1 ; $i <=10 ; $i++) { 
						$cle_random = array_rand($nb_random_liste, 1);
						echo '<td>' . $_GET['Imposer_Table'] . ' x ' . $nb_random_liste[$cle_random] . ' = </td> <td> <img src="ressources/pokemon/coeur1.png">&nbsp;<img src="ressources/pokemon/coeur2.png">&nbsp;<img src="ressources/pokemon/coeur1.png"> <button class="button button_Reponse" onclick="Function_Spoiler(' . $i . ')">Réponse ' . $i . '</button> <img src="ressources/pokemon/coeur1.png">&nbsp;<img src="ressources/pokemon/coeur2.png">&nbsp;<img src="ressources/pokemon/coeur1.png">
						<div id="DIV_Spoiler_' . $i . '"> <h1>' . $_GET['Imposer_Table'] * $nb_random_liste[$cle_random] . ' <img src="ressources/pokemon/g5/' . rand(1,753) . '.png"></h1></div></td></tr>';
						unset($nb_random_liste[array_search($nb_random_liste[$cle_random], $nb_random_liste)]);
					}
					echo '<td></td><td><div id="div_button_Bravo"><button class="button button_Bravo" onclick="window.location.href=\'bravo.php\'"> <b>*** BRAVO ***</b> </button></div></td></table>';
				}
				else {
					echo "Voici 10 opérations d'une table imposée :<br>";							// affichage table imposer
					echo '<table><tr><th> Calcul </th><th> Vérification </th></tr><tr>';
					for ($i = 1 ; $i <=10 ; $i++) { 
						echo '<td>' . $_GET['Imposer_Table'] . ' x ' . $i . ' = </td> <td> <img src="ressources/pokemon/coeur1.png">&nbsp;<img src="ressources/pokemon/coeur2.png">&nbsp;<img src="ressources/pokemon/coeur1.png"> <button class="button button_Reponse" onclick="Function_Spoiler(' . $i . ')">Réponse ' . $i . '</button> <img src="ressources/pokemon/coeur1.png">&nbsp;<img src="ressources/pokemon/coeur2.png">&nbsp;<img src="ressources/pokemon/coeur1.png">
						<div id="DIV_Spoiler_' . $i . '"> <h1>' . $_GET['Imposer_Table'] * $i . ' <img src="ressources/pokemon/g5/' . rand(1,753) . '.png"></h1></div></td></tr>';
					}
					echo '<td></td><td><div id="div_button_Bravo"><button class="button button_Bravo" onclick="window.location.href=\'bravo.php\'"> <b>*** BRAVO ***</b> </button></div></td></table>';
				}
			}

			pas_de_calcul: // sortie goto sans faire d'affichage de calcul
		?>

		<script>
			var Array_reponse = [""];						// déclare que cette variable est un array

			function Function_Spoiler(value) {

				var pos = Array_reponse.indexOf(value); 	// recherche la position de "value" dans l'array "Array_reponse" si pas trouvé indique "-1"
				if (pos == -1) { 							// si pas trouvé "-1" 
					Array_reponse.push(value);				// j'enregistre dans l'array
				}

				Array_reponse.forEach(nb_entree);			// Appel la fonction pour savoir le nombre d'entrée dans l'array
				if (nb == 10) {								// si on a appuyer sur les 10 boutton 
					div_button_Bravo.style.display = "block";// affiche le bouton
				}

				var x = document.getElementById("DIV_Spoiler_" + value );
				if (x.style.display === "block") {
					x.style.display = "none";			// cache le DIV
				} else {
					x.style.display = "block";			// affiche le DIV
				}
			}

			function nb_entree(value, index, array) {
				nb = index ; 
			}
		</script>
	</body>
</html>



