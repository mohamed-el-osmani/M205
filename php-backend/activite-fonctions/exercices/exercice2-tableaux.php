
<?php
declare(strict_types=1);

$notes = [12, 15, 8, 17, 9, 14, 11];
$prenoms = ['Sara', 'Youssef', 'Imane', 'Omar', 'Khadija'];

echo "Premier : " . $notes[0] . PHP_EOL;
echo "Dernier : " . $notes[array_key_last($notes)] . PHP_EOL;
echo "Nombre de notes : " . count($notes) . PHP_EOL;

for ($i = 0; $i < count($notes); $i++) {
    echo "Note n°" . ($i + 1) . " : " . $notes[$i] . PHP_EOL;
}

foreach ($prenoms as $i => $prenom) {
    echo ($i + 1) . ". " . $prenom . PHP_EOL;
}

$t = $notes;

$t[] = 16;
array_push($t, 16);

array_unshift($t, 10);

$dernier = array_pop($t);
$premier = array_shift($t);

echo "Dernier retire : $dernier\n";
echo "Premier retire : $premier\n";

array_splice($t, 2, 0, [13]);

unset($t[1]);

echo "Avec trou :\n";
print_r($t);

$t = array_values($t);

echo "Apres reindexation :\n";
print_r($t);

echo in_array(17, $notes)
    ? "17 existe\n" : "17 n'existe pas\n";

$indice = array_search(9, $notes);

if ($indice !== false) {
    echo "9 trouve a l'indice $indice\n";
} else {
    echo "9 introuvable\n";
}

echo in_array("Omar", $prenoms)
    ? "Omar existe\n" : "Omar n'existe pas\n";

echo "Somme : " . array_sum($notes) . PHP_EOL;

echo "Moyenne : " .
    round(array_sum($notes) / count($notes), 2) . PHP_EOL;

echo "Min : " . min($notes) . PHP_EOL;
echo "Max : " . max($notes) . PHP_EOL;

$nombreAdmis = 0;

foreach ($notes as $note) {
    if ($note >= 10) {
        $nombreAdmis++;
    }
}

echo "Admis avec boucle : $nombreAdmis\n";

$admis = array_filter($notes, fn($n) => $n >= 10);
$admis = array_values($admis);

echo "Admis avec filter : " . count($admis) . PHP_EOL;

$pourcentage = ($nombreAdmis / count($notes)) * 100;

echo "Reussite : " . round($pourcentage, 2) . "%\n";

$copie = $notes;
sort($copie);

$milieu = intdiv(count($copie), 2);

if (count($copie) % 2 === 0) {
    $mediane = ($copie[$milieu - 1] + $copie[$milieu]) / 2;
} else {
    $mediane = $copie[$milieu];
}

echo "Mediane : $mediane\n";

$croissant = $notes;
sort($croissant);

$decroissant = $notes;
rsort($decroissant);

echo "Croissant : ";
print_r($croissant);

echo "Decroissant : ";
print_r($decroissant);

$meilleures = $notes;
rsort($meilleures);

echo "3 meilleures : ";
print_r(array_slice($meilleures, 0, 3));

$prenomsTries = $prenoms;
sort($prenomsTries);

echo "Prenoms alphabetiques : ";
print_r($prenomsTries);

echo "Prenoms inverses : ";
print_r(array_reverse($prenoms));


$bonus = array_map(
    fn($n) => min($n + 1, 20),
    $notes
);

echo "Bonus : ";
print_r($bonus);

$admis = array_values(
    array_filter($notes, fn($n) => $n >= 10)
);

echo "Admis : ";
print_r($admis);

$total = array_reduce(
    $notes,
    fn($cumul, $n) => $cumul + $n,
    0
);

echo "Total reduce : $total\n";

$majuscules = array_map("strtoupper", $prenoms);

print_r($majuscules);

$mentions = array_map(function ($n) {
    if ($n < 10) {
        $mention = "Ajourné";
    } elseif ($n < 14) {
        $mention = "Passable";
    } elseif ($n < 16) {
        $mention = "Assez bien";
    } else {
        $mention = "Bien";
    }

    return "$n -> $mention";
}, $notes);

print_r($mentions);

echo implode(", ", $prenoms) . PHP_EOL;

$chaine = "php,js,sql,php,html,js";

$langages = explode(",", $chaine);
$langages = array_unique($langages);

print_r($langages);

$a1 = ["php", "sql"];
$b1 = ["js", "sql"];

$fusion = array_unique(array_merge($a1, $b1));

print_r($fusion);

$a = ["php", "js", "sql"];
$b = ["js", "html", "sql"];

print_r(array_intersect($a, $b));
print_r(array_diff($a, $b));

print_r(array_chunk(range(1, 10), 3));

function moyenneNotes(array $notes): float {
    if (count($notes) === 0) {
        return 0;
    }

    return array_sum($notes) / count($notes);
}

function mediane(array $notes): float {
    if (count($notes) === 0) {
        return 0;
    }

    sort($notes);
    $n = count($notes);
    $m = intdiv($n, 2);

    if ($n % 2 === 0) {
        return ($notes[$m - 1] + $notes[$m]) / 2;
    }

    return (float) $notes[$m];
}

function admis(array $notes, float $seuil = 10): array {
    return array_values(
        array_filter($notes, fn($n) => $n >= $seuil)
    );
}

function meilleures(array $notes, int $n = 3): array {
    rsort($notes);
    return array_slice($notes, 0, $n);
}

function histogramme(array $notes): void {
    foreach ($notes as $note) {
        echo $note . " : " . str_repeat("*", (int) $note) . PHP_EOL;
    }
}

echo "Moyenne : " . moyenneNotes($notes) . PHP_EOL;
echo "Mediane : " . mediane($notes) . PHP_EOL;

print_r(admis($notes));
print_r(meilleures($notes));

histogramme($notes);

$vide = [];

echo "Moyenne vide : " . moyenneNotes($vide) . PHP_EOL;
echo "Mediane vide : " . mediane($vide) . PHP_EOL;
print_r(admis($vide));
print_r(meilleures($vide));
histogramme($vide);