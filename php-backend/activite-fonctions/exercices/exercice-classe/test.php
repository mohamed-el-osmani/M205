```php
<?php
declare(strict_types=1);

class CompteBancaire
{
    public const DEVISE = 'MAD';
    public const PLAFOND_RETRAIT = 5000.0;

    private static int $nombreComptes = 0;

    private string $numero;
    private string $titulaire;
    private float $solde;

    public function __construct(
        string $numero,
        string $titulaire,
        float $soldeInitial = 0.0
    ) {
        if (!self::estNumeroValide($numero)) {
            throw new InvalidArgumentException(
                "Numéro de compte invalide : $numero"
            );
        }

        if ($soldeInitial < 0) {
            throw new InvalidArgumentException(
                "Solde initial négatif interdit."
            );
        }

        $this->numero = $numero;
        $this->setTitulaire($titulaire);
        $this->solde = $soldeInitial;

        self::$nombreComptes++;
    }

    // GETTERS

    public function getNumero(): string {
        return $this->numero;
    }

    public function getTitulaire(): string {
        return $this->titulaire;
    }

    public function getSolde(): float {
        return $this->solde;
    }

    // SETTER

    public function setTitulaire(string $titulaire): void {
        $titulaire = trim($titulaire);

        if ($titulaire === '') {
            throw new InvalidArgumentException(
                "Titulaire vide interdit."
            );
        }

        $this->titulaire = $titulaire;
    }

    // DEPOT

    public function deposer(float $montant): void {
        if ($montant <= 0) {
            throw new InvalidArgumentException(
                "Le montant doit être strictement positif."
            );
        }

        $this->solde += $montant;
    }

    // RETRAIT

    public function retirer(float $montant): void {
        if ($montant <= 0) {
            throw new InvalidArgumentException(
                "Montant invalide."
            );
        }

        if ($montant > self::PLAFOND_RETRAIT) {
            throw new RuntimeException(
                "Plafond de retrait dépassé."
            );
        }

        if ($montant > $this->solde) {
            throw new RuntimeException(
                "Solde insuffisant."
            );
        }

        $this->solde -= $montant;
    }

    // VIREMENT

    public function virerVers(
        CompteBancaire $destinataire,
        float $montant
    ): void {
        if ($destinataire === $this) {
            throw new InvalidArgumentException(
                "Virement vers soi-même interdit."
            );
        }

        $this->retirer($montant);
        $destinataire->deposer($montant);
    }

    // AFFICHAGE

    public function __toString(): string {
        return sprintf(
            "%s - %s : %.2f %s",
            $this->numero,
            $this->titulaire,
            $this->solde,
            self::DEVISE
        );
    }

    // METHODES STATIQUES

    public static function getNombreComptes(): int {
        return self::$nombreComptes;
    }

    public static function estNumeroValide(
        string $numero
    ): bool {
        return preg_match(
            "/^CB\d{6}$/",
            $numero
        ) === 1;
    }
}
