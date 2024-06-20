<?php

namespace App\Classes;

use App\Interfaces\Potpis;

class Dokument implements Potpis {
    private $naziv;
    private $tekst;
    private $ovjereno = false;

    public function __construct($naziv, $tekst) {
        $this->naziv = $naziv;
        $this->tekst = $tekst;
    }

    public function potpis() {
        $this->ovjereno = true;
    }

    public function __toString() {
        return "Naziv: {$this->naziv}, Tekst: {$this->tekst}, Potvrđen: " . ($this->ovjereno ? 'da' : 'ne');
    }

}