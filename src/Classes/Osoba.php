<?php

namespace App\Classes;

class Osoba {
    protected $id;
    protected $ime;
    protected $prezime;
    protected static $instanceKlasa = [];

    public function __construct($ime, $prezime) {
        static $idCounter = 1;
        $this->id = $idCounter++;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $tip = basename(get_called_class());
        self::setInstanceKlasa($tip); 
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

    public static function getInstanceKlasa() {
        return self::$instanceKlasa;
    }

    public static function setInstanceKlasa($tip) {
        if(array_key_exists($tip, self::$instanceKlasa)){
            self::$instanceKlasa[$tip]++;
        } else {
            self::$instanceKlasa[$tip] =  1;
        }
    }


}