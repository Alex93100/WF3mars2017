<?php
require_once("inc/init.inc.php");

$tab=array();
$tab['resultat'] = "";
$tab['pseudo'] = "disponible";

$erreur = false; // variable de contrle en fin de script. Si sa valeur est passé à true alors il y a eu une erreur (exemple le pseudo indisponible)



// extract($_POST);

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';

// action = condition ? condition vrai(if) : condition fausse(else)
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$mode = isset($_POST['civilite']) ? $_POST['civilite'] : '';
$mode = isset($_POST['vile']) ? $_POST['vile'] : '';
$mode = isset($_POST['date_de_naissance']) ? $_POST['date_de_naissance'] : '';

if($mode == "connexion"){
    //  traitement de la connexion/inscription
    // requete pour tester si le pseudo est déjà présent dans la BDD
    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");
    $membre = $resultat->fetch(PDO::FETCH_ASSOC);
    if($membre->rowCount() == 0){ // s'il n'y a pas de ligne alors le pseudo est libre car inexistant en BDD
        
        $time = time(); // on récupère le timestamp
        $pdo->query("INSERT INTO membre (pseudo, civilite, ville, date_de_naissance, ip, date_connexion) VALUES ('$pseudo', '$civilite', '$ville', '$date_de_naissance', '$_SERVER[REMOTE_ADDR]', $time)");

    }

}
echo json_encode($tab);