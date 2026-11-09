<?php
declare(strict_types=1);

require_once __DIR__ . "/CompteBancaire.php";
require_once __DIR__ . "/CompteEpargne.php";
require_once __DIR__ . "/CompteCourant.php";
require_once __DIR__ . "/Banque.php";

echo "<h1>GESTION BANCAIRE — Exercice 5</h1>";

// Fonction utilitaire polymorphe (Étape 4.4)
function tenterRetrait(CompteBancaire $compte, float $montant): void
{
    try {
        $compte->retirer($montant);
        echo sprintf(
            "Retrait de %.2f : %s accepté (%.2f)<br>",
            $montant,
            $compte->getType(),
            $compte->getSolde()
        );
    } catch (RuntimeException | InvalidArgumentException $e) {
        echo sprintf(
            "Retrait de %.2f : %s refusé (%.2f) — %s<br>",
            $montant,
            $compte->getType(),
            $compte->getSolde(),
            $e->getMessage()
        );
    }
}

try {
    // 1. Création des comptes
    $epargne = new CompteEpargne("CB000001", "Sara Alami", 2000.0, 3.0);
    $courant = new CompteCourant("CB000002", "Omar Benani", 800.0, 1000.0);

    // 2. Tentative d'instanciation d'une classe abstraite (doit échouer)
    // new CompteBancaire("CB000003", "X", 0); // Erreur fatale

    // 3. Banque + ajout
    $banque = new Banque("Ma Banque");
    $banque->ajouterCompte($epargne);
    $banque->ajouterCompte($courant);

    echo "<h2>1. Liste des comptes</h2>";
    $banque->afficherComptes();

    // 4. Intérêts (uniquement sur épargne)
    echo "<h2>2. Crédit des intérêts</h2>";
    $nb = $banque->crediterInterets();
    echo "Comptes épargne crédités : $nb<br>";
    echo "Nouveau solde épargne : " . number_format($epargne->getSolde(), 2) . " DH<br>";

    // 5. Tests de retraits via fonction polymorphe
    echo "<h2>3. Tests des retraits</h2>";
    $comptes = [$epargne, $courant];

    foreach ($comptes as $compte) {
        tenterRetrait($compte, 1700);
    }
    foreach ($comptes as $compte) {
        tenterRetrait($compte, 300);
    }

    // 6. Virement
    echo "<h2>4. Virement bancaire</h2>";
    try {
        $courant->virerVers($epargne, 50);
        echo "Virement de 50 DH effectué.<br>";
    } catch (Throwable $e) {
        echo "Virement refusé : " . $e->getMessage() . "<br>";
    }

    // 7. Recherche
    echo "<h2>5. Recherche d'un compte</h2>";
    $trouve = $banque->trouverCompte("CB000001");
    echo $trouve !== null
        ? "Compte trouvé : " . $trouve . "<br>"
        : "Compte introuvable.<br>";

    // 8. Statistiques
    echo "<h2>6. Statistiques</h2>";
    echo "Nombre de comptes dans la banque : " . $banque->getNombreComptes() . "<br>";
    echo "Nombre total de comptes créés : " . CompteBancaire::getNombreComptes() . "<br>";
    echo "Total des dépôts : " . number_format($banque->totalDepots(), 2) . " DH<br>";

    echo "Comptes par type : ";
    foreach ($banque->comptesParType() as $type => $n) {
        echo "$type = $n | ";
    }
    echo "<br>";

    // 9. État final
    echo "<h2>7. État final</h2>";
    $banque->afficherComptes();

} catch (Throwable $e) {
    echo "<h2 style='color:red'>Erreur</h2>";
    echo $e->getMessage();
}