<?php
declare(strict_types=1);

require_once __DIR__ . "/fonctions.php";

echo "=== OPERATIONS ===\n";

echo "12 + 8 = " . additionner(12, 8) . PHP_EOL;
echo "12 - 8 = " . soustraire(12, 8) . PHP_EOL;
echo "12 * 8 = " . multiplier(12, 8) . PHP_EOL;

try {
    echo "10 / 0 = " . diviser(10, 0) . PHP_EOL;
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}

echo "\n=== LOGIQUE ===\n";

echo "7 est pair ? " . (estPair(7) ? "oui" : "non") . PHP_EOL;
echo "5 est positif ? " . (estPositif(5) ? "oui" : "non") . PHP_EOL;

echo "Maximum : " . maximum(10, 25, 15) . PHP_EOL;
echo "Maximum avec max : " . maximumAvecMax(10, 25, 15) . PHP_EOL;

echo "7 est premier ? " . (estPremier(7) ? "oui" : "non") . PHP_EOL;

echo "\n=== COMMERCIAL ===\n";

echo "TTC : " . calculerTTC(100) . PHP_EOL;
echo "Prix apres remise : " . calculerRemise(100, 10) . PHP_EOL;

$facture = calculerFacture(100, 10, 10, 20);

echo "Facture : " .
    number_format($facture, 2, ",", " ") . " MAD" . PHP_EOL;

echo "\n=== STATISTIQUES ===\n";

echo "Moyenne : " . moyenne(12, 15, 18) . PHP_EOL;
echo "Aire cercle : " . aireCercle(5) . PHP_EOL;
echo "Perimetre : " . perimetreCercle(5) . PHP_EOL;

echo "25 C = " . celsiusVersFahrenheit(25) . " F" . PHP_EOL;
echo "77 F = " . fahrenheitVersCelsius(77) . " C" . PHP_EOL;

echo "100 MAD = " . convertirDevise(100, 0.092) . " EUR" . PHP_EOL;

echo "\n=== BOUCLES ===\n";

echo "5! = " . factorielle(5) . PHP_EOL;

echo "Fibonacci(8) : " . implode(", ", fibonacci(8)) . PHP_EOL;

echo "PGCD(48,18) = " . pgcd(48, 18) . PHP_EOL;

echo "Puissance boucle : " . puissance(2, 3) . PHP_EOL;

echo "Puissance recursive : " . puissanceRecursive(2, 3) . PHP_EOL;
