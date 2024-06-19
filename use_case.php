<?php

enum VrstaStudenta: string {
    case Redovni = 'Redovni';
    case Vanredni = 'Vanredni';
}

interface Potpis {
    public function potpis();
}

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

class Asistent extends Osoba {
    private $kolegij;

    public function __construct($ime, $prezime, $kolegij) {
        parent::__construct($ime, $prezime);
        $this->kolegij = $kolegij;
    }

    public function getkolegij() {
        return $this->kolegij;
    }
}

class Dekan extends Osoba {
    private $titula;

    public function __construct($ime, $prezime, $titula) {
        parent::__construct($ime, $prezime);
        $this->titula = $titula;
    }


    public function potpisStavka(Potpis $stavka) {
        $stavka->potpis();
    }
}

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
        return "Sifra: {$this->kod}, Naziv: {$this->naziv}, Bodovi: {$this->ects}ects, Potvrđen: " . ($this->ovjereno ? 'da' : 'ne');
    }

}

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

// Stvori studente
$studenti = [
    new Student('Ivan', 'Ivić', VrstaStudenta::Redovni),
    new Student('Jana', 'Janić', VrstaStudenta::Vanredni),
    new Student('Emilija', 'Kokić', VrstaStudenta::Redovni)
];

// prikaži studente
foreach ($studenti as $student) {
    echo "ID: {$student->getId()}, naziv: {$student->getime()} {$student->getprezime()}, tip: {$student->gettip()->value}\n";
}

// sortiraj po id - default
usort($studenti, fn($a, $b) => $a->getId() <=> $b->getId());
echo "\nSorted by ID:\n";
foreach ($studenti as $student) {
    echo "ID: {$student->getId()}, naziv: {$student->getime()} {$student->getprezime()}, tip: {$student->gettip()->value}\n";
}

// sortiraj po prezimenu
usort($studenti, fn($a, $b) => $a->getprezime() <=> $b->getprezime());
echo "\nSorted by Last naziv:\n";
foreach ($studenti as $student) {
    echo "ID: {$student->getId()}, naziv: {$student->getime()} {$student->getprezime()}, tip: {$student->gettip()->value}\n";
}

// stvori kolegij
$kolegij = new kolegij(123, 'OOP', 20);
echo "\nkolegij: {$kolegij}\n";

// stvori profesora i asistenta
$profesor = new Profesor('Dr.', 'Mikula', 'OOP');
$asistent = new Asistent('Mr.', 'Bronštajn', 'OOP');
echo "\nProfesor: {$profesor->getime()} {$profesor->getprezime()}, kolegij: {$profesor->getkolegij()}\n";
echo "Asistent: {$asistent->getime()} {$asistent->getprezime()}, kolegij: {$asistent->getkolegij()}\n";

// stvori dekana
$dekan = new Dekan('Dr.', 'Heisenberg', 'Dekan Fakulteta');
echo "\nDekan: {$dekan->getime()} {$dekan->getprezime()}, titula: Dekan Fakulteta\n\n";

// napravi popis broja svih zasebnih instanca tipa objekta
$sveOsobe = array_merge($studenti, [$profesor, $asistent, $dekan]);
$pojavnost = [
    'Student' => 0,
    'Profesor' => 0,
    'Asistent' => 0,
    'Dekan' => 0
];
foreach ($sveOsobe as $osoba) {
    if ($osoba instanceof Student) {
        $pojavnost['Student']++;
    } elseif ($osoba instanceof Profesor) {
        $pojavnost['Profesor']++;
    } elseif ($osoba instanceof Asistent) {
        $pojavnost['Asistent']++;
    } elseif ($osoba instanceof Dekan) {    
        $pojavnost['Dekan']++;
    }
}  

var_dump($pojavnost);


// stvori nepotpisani dokument
$dokument = new Dokument('Teza', 'ovo je teza...');

// lista nepotpisanih stavaka i poziv dekanu da ih potpiše
// prikaz stavaka nakon potpisa
$nepotpisaniDokumenti = [$kolegij, $dokument];
foreach ($nepotpisaniDokumenti as $stavka) {
    $dekan->potpisStavka($stavka);
    echo "\n{$stavka}";
}


?>