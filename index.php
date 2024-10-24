<?php
@require_once 'config.php';
@include_once 'szablon/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'start';

// Połączenie z bazą danych
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_error) {
    die('Błąd połączenia z bazą danych: ' . $db->connect_error);
}

$isddtable = false;
$pname = CMS_NAME;

switch ($action) {
    case 'start':
        @require_once 'szablon/start.php';
        break;
    case 'showc':
        $pname = 'Lista klientów';
        $isddtable = true;
        $q = $db->prepare('SELECT * FROM klienci');
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $klienci = [];
        while ($row) {
            $klienci[] = $row;
            $row = $r->fetch_assoc();
        }
        @require_once 'szablon/showc.php';
        break;
    case 'details':
        $pname = 'Szczegóły klienta';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($id == 0) {
            die('Nieprawidłowe ID klienta');
        }
        
        $klient = [
            'klient' => [],
            'kontakty' => [],
            'opiekunowie' => [],
            'pakiety' => []
        ];

        // Pobierz dane klienta
        $q = $db->prepare('SELECT id, nazwa, strona, uwagi FROM klienci WHERE id = ?');
        $q->bind_param('i', $id);
        $q->execute();
        $r = $q->get_result();
        if ($row = $r->fetch_assoc()) {
            $klient['klient'] = $row;
        }

        // Pobierz kontakty klienta
        $q = $db->prepare('
            SELECT 
            ko.id AS kontakt_id, ko.aktywny AS kontakt_aktywny,
            o.id AS osoba_id, o.imie, o.nazwisko, o.mail, o.telefon, o.adres
            FROM kontakty ko
            LEFT JOIN osoby o ON o.id = ko.osoba
            WHERE ko.klient = ?
        ');
        $q->bind_param('i', $id);
        $q->execute();
        $r = $q->get_result();
        while ($row = $r->fetch_assoc()) {
            $klient['kontakty'][] = $row;
        }

        // Pobierz opiekunów klienta
        $q = $db->prepare('
            SELECT 
            op.id AS opiekun_id,
            p.id AS pracownik_id, p.aktywny AS pracownik_aktywny,
            o.id AS osoba_id, o.imie, o.nazwisko, o.mail, o.telefon, o.adres,
            s.nazwa AS stanowisko_nazwa
            FROM opiekunowie op
            LEFT JOIN pracownicy p ON p.id = op.pracownik
            LEFT JOIN osoby o ON o.id = p.osoba
            LEFT JOIN stanowiska s ON s.id = p.stanowisko
            WHERE op.klient = ?
        ');
        $q->bind_param('i', $id);
        $q->execute();
        $r = $q->get_result();
        while ($row = $r->fetch_assoc()) {
            $klient['opiekunowie'][] = $row;
        }

        // Pobierz pakiety klienta
        $q = $db->prepare('
            SELECT 
            sp.id AS sprzedany_pakiet_id, sp.data_zakupu, sp.data_wygasniecia, sp.cena AS sprzedany_pakiet_cena,
            pa.id AS pakiet_id, pa.nazwa AS pakiet_nazwa, pa.cena AS pakiet_cena,
            p.id AS sprzedawca_id, p.aktywny AS sprzedawca_aktywny,
            o.id AS osoba_id, o.imie, o.nazwisko, o.mail, o.telefon, o.adres,
            s.nazwa AS stanowisko_nazwa
            FROM sprzedane_pakiety sp
            LEFT JOIN pakiety pa ON pa.id = sp.pakiet
            LEFT JOIN pracownicy p ON p.id = sp.sprzedawca
            LEFT JOIN osoby o ON o.id = p.osoba
            LEFT JOIN stanowiska s ON s.id = p.stanowisko
            WHERE sp.klient = ?
        ');
        $q->bind_param('i', $id);
        $q->execute();
        $r = $q->get_result();
        while ($row = $r->fetch_assoc()) {
            $klient['pakiety'][] = $row;
        }

        @require_once 'szablon/details.php';
        break;
    }

$db->close();
@include_once 'szablon/footer.php';
?>