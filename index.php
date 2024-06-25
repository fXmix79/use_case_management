<?php

require_once "vendor/autoload.php";

use App\Classes\Osoba;
use App\Classes\Student;
use App\Classes\Asistent;
use App\Classes\Profesor;
use App\Classes\Dekan;
use App\Enums\VrstaStudenta;
use App\Classes\Dokument;
use App\Classes\Kolegij;

// Stvori studente
$studenti = [
    new Student('Ivan', 'Ivić', VrstaStudenta::Redovni),
    new Student('Jana', 'Janić', VrstaStudenta::Vanredni),
    new Student('Emilija', 'Anić', VrstaStudenta::Redovni)
];

// prikaži studente
foreach ($studenti as $student) {
    echo "ID: {$student->getId()}, naziv: {$student->getime()} {$student->getprezime()}, tip: {$student->gettip()->value}\n";
}

// sortiraj po id - default
usort($studenti, fn($a, $b) => $a->getId() <=> $b->getId());
echo "\nSortirano po ID:\n";
foreach ($studenti as $student) {
    echo "ID: {$student->getId()}, naziv: {$student->getime()} {$student->getprezime()}, tip: {$student->gettip()->value}\n";
}

// sortiraj po prezimenu
usort($studenti, fn($a, $b) => $a->getprezime() <=> $b->getprezime());
echo "\nSortirano po prezimenu:\n";
foreach ($studenti as $student) {
    echo "ID: {$student->getId()}, naziv: {$student->getime()} {$student->getprezime()}, tip: {$student->gettip()->value}\n";
}

// stvori kolegij
$kolegij = new kolegij(123, 'OOP', 20);
echo "\nKolegij: {$kolegij}\n";

// stvori profesora i asistenta
$profesor = new Profesor('Dr.', 'Mikula', 'OOP');
$asistent = new Asistent('Mr.', 'Bronštajn', 'OOP');
echo "\nProfesor: {$profesor->getime()} {$profesor->getprezime()}, kolegij: {$profesor->getkolegij()}\n";
echo "Asistent: {$asistent->getime()} {$asistent->getprezime()}, kolegij: {$asistent->getkolegij()}\n";

// stvori dekana
$dekan = new Dekan('Dr.', 'Heisenberg', 'Dekan Fakulteta');
echo "\nDekan: {$dekan->getime()} {$dekan->getprezime()}, titula: Dekan Fakulteta\n\n";

// napravi popis broja zasebnih instanca tipa objekata 
foreach(Osoba::getInstanceKlasa() as $key => $value){
    echo "$key: $value\n";
}


// stvori nepotpisani dokument
$dokument = new Dokument('Teza', 'ovo je teza...');

// lista nepotpisanih stavaka i poziv dekanu da ih potpiše

$dekan->setStavkeZaPotpis($kolegij);
$dekan->setStavkeZaPotpis($dokument);
foreach ($dekan->getStavkeZaPotpis() as $stavka) {
    echo "\n{$stavka}";
    $stavka->potpis();
}

echo "\n";

// prikaz stavaka nakon potpisa
foreach ($dekan->getStavkeZaPotpis() as $stavka) {
    echo "\n{$stavka}";
}


?>