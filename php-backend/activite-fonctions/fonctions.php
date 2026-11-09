<?php
declare(strict_types=1);
function additionner(float $a, float $b): float {
    return $a + $b;
}

function soustraire(float $a, float $b): float {
    return $a - $b;
}

function multiplier(float $a, float $b): float {
    return $a * $b;
}

function diviser(float $a, float $b): float {
    if ($b == 0) {
        throw new InvalidArgumentException("Division par zéro impossible");
    }
    return $a / $b;
}

function estPair(int $n): bool {
    return $n % 2 === 0;
}

function estPositif(float $n): bool {
    return $n > 0;
}

function maximum(float $a, float $b, float $c): float {
    $max = $a;

    if ($b > $max) {
        $max = $b;
    }

    if ($c > $max) {
        $max = $c;
    }

    return $max;
}

function maximumAvecMax(float $a, float $b, float $c): float {
    return max($a, $b, $c);
}

function estPremier(int $n): bool {
    if ($n < 2) {
        return false;
    }

    for ($i = 2; $i <= floor(sqrt($n)); $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }

    return true;
}
function calculerTTC(float $ht, float $tva = 20.0): float {
    return $ht * (1 + $tva / 100);
}

function calculerRemise(float $prix, float $pourcentage): float {
    return round($prix * (1 - $pourcentage / 100), 2);
}

function calculerFacture(
    float $prixUnitaire,
    int $quantite,
    float $remise = 0,
    float $tva = 20.0
): float {
    $totalHT = $prixUnitaire * $quantite;
    $totalApresRemise = calculerRemise($totalHT, $remise);

    return calculerTTC($totalApresRemise, $tva);
}
function moyenne(float ...$notes): float {
    if (count($notes) === 0) {
        return 0;
    }

    return array_sum($notes) / count($notes);
}

function aireCercle(float $rayon): float {
    return round(M_PI * $rayon ** 2, 2);
}

function perimetreCercle(float $rayon): float {
    return round(2 * M_PI * $rayon, 2);
}

function celsiusVersFahrenheit(float $c): float {
    return $c * 9 / 5 + 32;
}

function fahrenheitVersCelsius(float $f): float {
    return ($f - 32) * 5 / 9;
}

function convertirDevise(float $montant, float $taux): float {
    return $montant * $taux;
}
function factorielle(int $n): int {
    if ($n < 0) {
        throw new InvalidArgumentException("Nombre négatif interdit");
    }

    $resultat = 1;

    for ($i = 1; $i <= $n; $i++) {
        $resultat *= $i;
    }

    return $resultat;
}

function fibonacci(int $n): array {
    if ($n < 0) {
        throw new InvalidArgumentException("Nombre négatif interdit");
    }

    $suite = [];

    for ($i = 0; $i < $n; $i++) {
        if ($i === 0) {
            $suite[] = 0;
        } elseif ($i === 1) {
            $suite[] = 1;
        } else {
            $suite[] = $suite[$i - 1] + $suite[$i - 2];
        }
    }

    return $suite;
}

function pgcd(int $a, int $b): int {
    $a = abs($a);
    $b = abs($b);

    while ($b !== 0) {
        $reste = $a % $b;
        $a = $b;
        $b = $reste;
    }

    return $a;
}

function puissance(float $x, int $n): float {
    if ($x == 0 && $n < 0) {
        throw new InvalidArgumentException("Puissance impossible");
    }

    $resultat = 1;
    $exposant = abs($n);

    for ($i = 0; $i < $exposant; $i++) {
        $resultat *= $x;
    }

    return $n < 0 ? 1 / $resultat : $resultat;
}

function puissanceRecursive(float $x, int $n): float {
    if ($x == 0 && $n < 0) {
        throw new InvalidArgumentException("Puissance impossible");
    }

    if ($n === 0) {
        return 1;
    }

    if ($n < 0) {
        return 1 / puissanceRecursive($x, -$n);
    }

    return $x * puissanceRecursive($x, $n - 1);
}
