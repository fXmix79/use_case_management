<?php

namespace App\Classes;

use App\Enums\VrstaStudenta;

class Student extends Osoba {
    private $tip;

    public function __construct($ime, $prezime, VrstaStudenta $tip) {
        parent::__construct($ime, $prezime);
        $this->tip = $tip;
    }

    public function gettip() {
        return $this->tip;
    }

}