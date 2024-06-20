<?php

namespace App\Classes;

use App\Interfaces\Potpis;

class Dekan extends Osoba {
    private $titula;
    private $stavkeZaPotpis = [];

    public function __construct($ime, $prezime, $titula) {
        parent::__construct($ime, $prezime);
        $this->titula = $titula;
    }


    public function potpisStavka(Potpis $stavka) {
        $stavka->potpis();
    }

    public function setStavkeZaPotpis($stavka){
        $this->stavkeZaPotpis[] = $stavka; 
    }

    public function getStavkeZaPotpis():array{
        return $this->stavkeZaPotpis;
    }
}