```php
<?php
declare(strict_types=1);

$stagiaire = [
    'nom' => 'Alami',
    'prenom' => 'Sara',
    'age' => 21,
    'filiere' => 'Développement digital',
    'notes' => [
        'php' => 16,
        'js' => 14,
        'sql' => 15
    ]
];

echo $stagiaire['prenom'] . " " .
    strtoupper($stagiaire['nom']) . ", " .
    $stagiaire['age'] . " ans, filière " .
    $stagiaire['filiere'] . PHP_EOL;

$stagiaire['ville'] = 'Casablanca';
$stagiaire['age'] = 22;

echo $stagiaire['email'] ?? 'non renseigné';

$stagiaire['telephone'] = null;

var_dump(isset($stagiaire['telephone']));
var_dump(array_key_exists('telephone', $stagiaire));

unset($stagiaire['ville']);

echo $stagiaire['notes']['php'] . PHP_EOL;

$moyenne = array_sum($stagiaire['notes'])
    / count($stagiaire['notes']);

echo "Moyenne : $moyenne\n";

foreach ($stagiaire['notes'] as $matiere => $note) {
    echo "$matiere : $note/20\n";
}

$panier = [
    'Clavier' => 250,
    'Souris' => 90,
    'Ecran' => 1400,
    'Casque' => 320
];

echo "Total : " . array_sum($panier) . PHP_EOL;
echo "Articles : " . count($panier) . PHP_EOL;

$maxPrix = max($panier);
$minPrix = min($panier);

$plusCher = array_search($maxPrix, $panier, true);
$moinsCher = array_search($minPrix, $panier, true);

echo "Plus cher : $plusCher ($maxPrix)\n";
echo "Moins cher : $moinsCher ($minPrix)\n";

// Remise de 10 %
$prixRemise = array_map(
    fn($prix) => $prix * 0.9,
    $panier
);

print_r($prixRemise);

// Articles > 200 MAD
$chers = array_filter(
    $panier,
    fn($prix) => $prix > 200
);

print_r($chers);

// Tri par nom
$parNom = $panier;
ksort($parNom);
print_r($parNom);

// Tri par prix croissant
$croissant = $panier;
asort($croissant);
print_r($croissant);

// Tri par prix décroissant
$decroissant = $panier;
arsort($decroissant);
print_r($decroissant);

// Ajout Webcam
if (!isset($panier['Webcam'])) {
    $panier['Webcam'] = 180;
}

// Quantités
$quantites = [
    'Clavier' => 1,
    'Souris' => 2,
    'Ecran' => 1,
    'Casque' => 1,
    'Webcam' => 1
];

foreach ($panier as $produit => $prix) {
    printf("%-10s %8.2f MAD\n", $produit, $prix);
}

$stagiaires = [
    ['nom' => 'Alami', 'filiere' => 'Développement', 'notes' => [16, 14, 15]],
    ['nom' => 'Benani', 'filiere' => 'Infrastructure', 'notes' => [11, 13, 12]],
    ['nom' => 'Chraibi', 'filiere' => 'Développement', 'notes' => [18, 17, 19]],
    ['nom' => 'Daoudi', 'filiere' => 'Infrastructure', 'notes' => [9, 10, 8]]
];

// Calcul des moyennes
foreach ($stagiaires as &$s) {
    $s['moyenne'] = array_sum($s['notes']) / count($s['notes']);
}
unset($s);

// Liste des noms
$noms = array_column($stagiaires, 'nom');
print_r($noms);

// Nom => moyenne
$parNom = array_column($stagiaires, 'moyenne', 'nom');
print_r($parNom);

// Classement décroissant
usort(
    $stagiaires,
    fn($a, $b) => $b['moyenne'] <=> $a['moyenne']
);

foreach ($stagiaires as $i => $s) {
    echo ($i + 1) . ". " . $s['nom'] .
        " (" . number_format($s['moyenne'], 2) . ")\n";
}

// Meilleur stagiaire
$meilleur = $stagiaires[0];

echo "Meilleur : " . $meilleur['nom'] . PHP_EOL;

// Moyenne générale
$moyennes = array_column($stagiaires, 'moyenne');

echo "Moyenne générale : " .
    array_sum($moyennes) / count($moyennes) . PHP_EOL;

// Stagiaires admis
$admis = array_filter(
    $stagiaires,
    fn($s) => $s['moyenne'] >= 10
);

print_r($admis);

// Regroupement par filière
$parFiliere = [];

foreach ($stagiaires as $s) {
    $filiere = $s['filiere'];
    $parFiliere[$filiere][] = $s;
}

foreach ($parFiliere as $filiere => $liste) {
    $moyennesFiliere = array_column($liste, 'moyenne');

    echo $filiere .
        " | Effectif : " . count($liste) .
        " | Moyenne : " .
        array_sum($moyennesFiliere) / count($moyennesFiliere) .
        PHP_EOL;
}

// Fonction mention
function mention(float $moyenne): string {
    if ($moyenne < 10) {
        return "Ajourné";
    } elseif ($moyenne < 14) {
        return "Passable";
    } elseif ($moyenne < 16) {
        return "Assez bien";
    }

    return "Bien";
}

foreach ($stagiaires as &$s) {
    $s['mention'] = mention($s['moyenne']);
}
unset($s);

print_r($stagiaires);

$stock = [
    'P001' => [
        'designation' => 'Clavier',
        'prix' => 250.0,
        'quantite' => 12
    ],
    'P002' => [
        'designation' => 'Souris',
        'prix' => 90.0,
        'quantite' => 40
    ],
    'P003' => [
        'designation' => 'Ecran',
        'prix' => 1400.0,
        'quantite' => 5
    ]
];

function ajouterProduit(
    array &$stock,
    string $ref,
    string $designation,
    float $prix,
    int $qte
): bool {
    if (isset($stock[$ref])) {
        return false;
    }

    $stock[$ref] = [
        'designation' => $designation,
        'prix' => $prix,
        'quantite' => $qte
    ];

    return true;
}

function retirerStock(
    array &$stock,
    string $ref,
    int $qte
): bool {
    if (!isset($stock[$ref]) || $qte <= 0) {
        return false;
    }

    if ($stock[$ref]['quantite'] < $qte) {
        return false;
    }

    $stock[$ref]['quantite'] -= $qte;

    return true;
}

function valeurTotale(array $stock): float {
    $total = 0;

    foreach ($stock as $produit) {
        $total += $produit['prix'] * $produit['quantite'];
    }

    return $total;
}

function produitsEnRupture(
    array $stock,
    int $seuil = 10
): array {
    return array_filter(
        $stock,
        fn($p) => $p['quantite'] < $seuil
    );
}

function afficherStock(array $stock): void {
    foreach ($stock as $ref => $p) {
        printf(
            "%-6s %-12s %8.2f MAD Quantité : %d\n",
            $ref,
            $p['designation'],
            $p['prix'],
            $p['quantite']
        );
    }
}

// Tests
ajouterProduit($stock, 'P004', 'Webcam', 180, 8);

echo "Ajout doublon : ";
var_dump(ajouterProduit($stock, 'P004', 'Webcam', 180, 8));

retirerStock($stock, 'P001', 3);

echo "Retrait 100 écrans : ";
var_dump(retirerStock($stock, 'P003', 100));

echo "Valeur totale : " . valeurTotale($stock) . PHP_EOL;

echo "Produits en rupture :\n";
print_r(produitsEnRupture($stock));

afficherStock($stock);
