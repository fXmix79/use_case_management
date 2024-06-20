<?php

namespace App\Classes;

class Osoba {
    protected $id;
    protected $ime;
    protected $prezime;

    public function __construct($ime, $prezime) {
        static $idCounter = 1;
        $this->id = $idCounter++;
        $this->ime = $ime;
        $this->prezime = $prezime;
    }

    public function getId() {
        return $this->id;
    }

    public function getime() {
        return $this->ime;
    }

    public function getprezime() {
        return $this->prezime;
    }
}