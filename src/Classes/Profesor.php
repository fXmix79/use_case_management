<?php

namespace App\Classes;

class Profesor extends Osoba {
    private $kolegij;

    public function __construct($ime, $prezime, $kolegij) {
        parent::__construct($ime, $prezime);
        $this->kolegij = $kolegij;
    }

    public function getkolegij() {
        return $this->kolegij;
    }
}