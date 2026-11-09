<?php
declare(strict_types=1);

require_once __DIR__ . "/CompteBancaire.php";
require_once __DIR__ . "/CompteEpargne.php";

class Banque
{
    /** @var array<string, CompteBancaire> */
    private array $comptes = [];

    public function __construct(private string $nom) {}

    public function getNom(): string { return $this->nom; }

    public function ajouterCompte(CompteBancaire $compte): void
    {
        $num = $compte->getNumero();
        if (isset($this->comptes[$num])) {
            throw new InvalidArgumentException("Le compte $num existe déjà.");
        }
        $this->comptes[$num] = $compte;
    }

    public function trouverCompte(string $numero): ?CompteBancaire
    {
        return $this->comptes[$numero] ?? null;
    }

    public function totalDepots(): float
    {
        $total = 0.0;
        foreach ($this->comptes as $c) {
            $total += $c->getSolde();
        }
        return $total;
    }

    // Crédite les intérêts uniquement sur les comptes épargne
    public function crediterInterets(): int
    {
        $n = 0;
        foreach ($this->comptes as $c) {
            if ($c instanceof CompteEpargne) {
                $c->ajouterInterets();
                $n++;
            }
        }
        return $n;
    }

    public function getNombreComptes(): int
    {
        return count($this->comptes);
    }

    public function afficherComptes(): void
    {
        if (empty($this->comptes)) {
            echo "Aucun compte dans la banque.<br>";
            return;
        }
        foreach ($this->comptes as $c) {
            echo $c . "<br>";
        }
    }

    // Ex. ["Épargne" => 2, "Courant" => 1]
    public function comptesParType(): array
    {
        $stats = [];
        foreach ($this->comptes as $c) {
            $type = $c->getType();
            $stats[$type] = ($stats[$type] ?? 0) + 1;
        }
        return $stats;
    }
}