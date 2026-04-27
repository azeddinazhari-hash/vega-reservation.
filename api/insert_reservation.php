<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code_res  = $_POST['code_reservation'] ?? '';
    $nom       = $_POST['nom_client'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $arrivee   = $_POST['date_arrivee'] ?? '';
    $depart    = $_POST['date_depart'] ?? '';
    $chambre   = $_POST['type_chambre'] ?? '';

    if (!empty($code_res) && !empty($nom)) {
        try {
            $sql = "INSERT INTO reservation 
                    (code_reservation, nom_client, telephone, date_arrivee, date_depart, type_chambre) 
                    VALUES 
                    (:code, :nom, :tel, :arrivee, :depart, :chambre)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':code' => $code_res,
                ':nom' => $nom,
                ':tel' => $telephone,
                ':arrivee' => $arrivee,
                ':depart' => $depart,
                ':chambre' => $chambre
            ]);

            header("Location: lisete_reservation.php?success=1");
            exit;
        } catch (PDOException $e) {
            die("Erreur lors de l'insertion : " . $e->getMessage());
        }
    }
}

header("Location: ajouter_reservation.php?error=missing_data");
exit;

