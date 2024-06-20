<?php

namespace App\Classes;

use App\Interfaces\Potpis;

class Kolegij implements Potpis {
    private $kod;
    private $naziv;
    private $ects;
    private $ovjereno = false;

    public function __construct($kod, $naziv, $ects) {
        $this->kod = $kod;
        $this->naziv = $naziv;
        $this->ects = $ects;
    }

    public function potpis() {
        $this->ovjereno = true;
    }

    public function __toString() {
        return "Šifra: {$this->kod}, Naziv: {$this->naziv}, Bodovi: {$this->ects}ects, Potvrđen: " . ($this->ovjereno ? 'da' : 'ne');
    }

}