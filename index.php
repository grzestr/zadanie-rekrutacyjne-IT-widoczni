<?php
@require_once 'config.php';
// Akcja do wykonania (domyślnie start)
$action = isset($_GET['action']) ? $_GET['action'] : 'start';

// Połączenie z bazą danych
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Sprawdzenie połączenia z bazą danych i ewentualne wyświetlenie błędu
if ($db->connect_error) {
    die('Błąd połączenia z bazą danych: ' . $db->connect_error);
}

// Czy tabela ma być DataTables (domyślnie nie)
$isddtable = false;
// Zmienna przechowująca nazwę strony (domyślnie nazwa CMS)
$pname = CMS_NAME;

switch ($action) {
    case 'start':
        // Strona startowa
        @require_once 'szablon/start.php';
        break;
    case 'showc':
        // Lista klientów (showc) - wyświetla listę klientów z możliwością filtrowania po pracowniku, pakiecie lub kontakcie
        $pname = 'Lista klientów';
        // Tabela ma być DataTables
        $isddtable = true;
        $idp = isset($_GET['idp']) ? $_GET['idp'] : false;
        $idpa = isset($_GET['idpa']) ? $_GET['idpa'] : false;
        $ido = isset($_GET['ido']) ? $_GET['ido'] : false;
        if($idp!==false){
            $q = $db->prepare('
                SELECT k.*
                FROM klienci k
                INNER JOIN opiekunowie o ON k.id = o.klient
                WHERE o.pracownik = ?
            ');
            $q->bind_param('i', $idp);
            $q->execute();
        }elseif($idpa!==false){
            $q = $db->prepare('
                SELECT k.*
                FROM klienci k
                INNER JOIN sprzedane_pakiety sp ON k.id = sp.klient
                WHERE sp.pakiet = ?
            ');
            $q->bind_param('i', $idpa);
            $q->execute();
        }elseif($ido!==false){
            $q = $db->prepare('
                SELECT k.*
                FROM klienci k
                INNER JOIN kontakty ko ON k.id = ko.klient
                INNER JOIN osoby o ON ko.osoba = o.id
                WHERE o.id = ?
            ');
            $q->bind_param('i', $ido);
            $q->execute();
        }else{
            $q = $db->prepare('SELECT * FROM klienci');
            $q->execute();
        }
        $r = $q->get_result();
        $klienci = [];
        while ($row = $r->fetch_assoc()) {
            $klienci[] = $row;
        }
        if($idp!==false){
            $pracownik = getWorkerDetails($idp);
            $pname .= ' pracownika: ' . $pracownik['imie'] . ' ' . $pracownik['nazwisko'] . ' (' . $pracownik['stanowisko'] . ')';
        }elseif($idpa!==false){
            $pakiet = getPackageDetail($idpa);
            $pname .= ' z pakietem: ' . $pakiet['nazwa'];
        }elseif($ido!==false){
            $kontakt = getPersonDetail($ido);
            $pname .= ' kontaktu: ' . $kontakt['imie'] . ' ' . $kontakt['nazwisko'];
        }
        @require_once 'szablon/showc.php';
        break;
    case 'showw':
        // Lista pracowników (showw) - wyświetla listę pracowników
        $pname = 'Lista pracowników';
        // Tabela ma być DataTables
        $isddtable = true;
        $q = $db->prepare('
            SELECT 
            p.id, o.imie, o.nazwisko, o.telefon, o.mail, s.nazwa AS stanowisko
            FROM pracownicy p
            LEFT JOIN osoby o ON p.osoba = o.id
            LEFT JOIN stanowiska s ON p.stanowisko = s.id
        ');
        $q->execute();
        $r = $q->get_result();
        $row = $r->fetch_assoc();
        $pracownicy = [];
        while ($row) {
            $pracownicy[] = $row;
            $row = $r->fetch_assoc();
        }
        @require_once 'szablon/showw.php';
        break;
    case 'showp':
        // Lista pakietów (showp) - wyświetla listę pakietów
        $pname = 'Lista pakietów';
        // Tabela ma być DataTables
        $isddtable = true;
        $q = $db->prepare('SELECT * FROM pakiety');
        $q->execute();
        $r = $q->get_result();
        $pakiety = [];
        while ($row = $r->fetch_assoc()) {
            $pakiety[] = $row;
        }
        @require_once 'szablon/showp.php';
        break;
    case 'showco':
        // Lista kontaktów (showco) - wyświetla listę kontaktów
        $pname = 'Lista kontaktów';
        // Tabela ma być DataTables
        $isddtable = true;
        $q = $db->prepare('
            SELECT DISTINCT
            o.id AS osoba_id, o.imie, o.nazwisko, o.mail, o.telefon
            FROM osoby o
            INNER JOIN kontakty ko ON o.id = ko.osoba
        ');
        $q->execute();
        $r = $q->get_result();
        $kontakty = [];
        while ($row = $r->fetch_assoc()) {
            $kontakty[] = $row;
        }
        @require_once 'szablon/showco.php';
        break;
    case 'deletecp':
        // Usuwanie pakietu (deletecp) - usuwa pakiet  z klienta i przekierowuje na stronę klienta
        $idc = isset($_GET['idc']) ? $_GET['idc'] : 0;
        $idspa = isset($_GET['idspa']) ? $_GET['idspa'] : 0;
        if ($idc == 0 || $idspa == 0) {
            die('Nieprawidłowe ID klienta lub pakietu');
        }
        $q = $db->prepare('DELETE FROM sprzedane_pakiety WHERE klient = ? AND id = ?');
        $q->bind_param('ii', $idc, $idspa);
        $q->execute();
        header('Location: /?action=details&id=' . $idc);
        break;
    case 'deletecg':
        // Usuwanie opiekuna (deletecg) - usuwa opiekuna z klienta i przekierowuje na stronę klienta
        $idc = isset($_GET['idc']) ? $_GET['idc'] : 0;
        $idop = isset($_GET['idop']) ? $_GET['idop'] : 0;
        if ($idc == 0 || $idop == 0) {
            die('Nieprawidłowe ID klienta lub opiekuna');
        }
        $q = $db->prepare('DELETE FROM opiekunowie WHERE klient = ? AND id = ?');
        $q->bind_param('ii', $idc, $idop);
        $q->execute();
        header('Location: /?action=details&id=' . $idc);
        break;
    case 'deletecc':
        // Usuwanie kontaktu (deletecc) - usuwa kontakt z klienta i przekierowuje na stronę klienta
        $idc = isset($_GET['idc']) ? $_GET['idc'] : 0;
        $idk = isset($_GET['idk']) ? $_GET['idk'] : 0;
        if ($idc == 0 || $idk == 0) {
            die('Nieprawidłowe ID klienta lub kontaktu');
        }
        $q = $db->prepare('DELETE FROM kontakty WHERE klient = ? AND id = ?');
        $q->bind_param('ii', $idc, $idk);
        $q->execute();
        header('Location: /?action=details&id=' . $idc);
        break;
    case 'details':
        // Szczegóły klienta (details) - wyświetla szczegóły klienta
        $pname = 'Szczegóły klienta';
        // Tabela ma być DataTables
        $isddtable = true;
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
    case 'addc':
        // Dodawanie klienta (addc) - dodaje klienta do bazy danych
        $pname = 'Dodaj klienta';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rozpocznij transakcję (wszystko albo nic)
            $db->begin_transaction();
            try {
                // Insert klient
                $nazwa = isset($_POST['nazwa']) ? $_POST['nazwa'] : '';
                $strona = isset($_POST['strona']) ? $_POST['strona'] : '';
                $uwagi = isset($_POST['uwagi']) ? $_POST['uwagi'] : '';
                $q = $db->prepare('INSERT INTO klienci (nazwa, strona, uwagi) VALUES (?, ?, ?)');
                $q->bind_param('sss', $nazwa, $strona, $uwagi);
                $q->execute();
                $klient_id = $q->insert_id;

                // Insert kontakt
                if (isset($_POST['kontakt_checkbox']) && $_POST['kontakt_checkbox'] == 'on') {
                    $kontakt_id = isset($_POST['kontakt']) ? $_POST['kontakt'] : 0;
                } else {
                    $imie_kontakt = isset($_POST['imie_kontakt']) ? $_POST['imie_kontakt'] : '';
                    $nazwisko_kontakt = isset($_POST['nazwisko_kontakt']) ? $_POST['nazwisko_kontakt'] : '';
                    $mail_kontakt = isset($_POST['mail_kontakt']) ? $_POST['mail_kontakt'] : '';
                    $telefon_kontakt = isset($_POST['telefon_kontakt']) ? $_POST['telefon_kontakt'] : '';
                    $adres_kontakt = isset($_POST['adres_kontakt']) ? $_POST['adres_kontakt'] : '';
                    $q = $db->prepare('INSERT INTO osoby (imie, nazwisko, mail, telefon, adres) VALUES (?, ?, ?, ?, ?)');
                    $q->bind_param('sssss', $imie_kontakt, $nazwisko_kontakt, $mail_kontakt, $telefon_kontakt, $adres_kontakt);
                    $q->execute();
                    $kontakt_id = $q->insert_id;
                }
                $q = $db->prepare('INSERT INTO kontakty (osoba, klient, aktywny) VALUES (?, ?, 1)');
                $q->bind_param('ii', $kontakt_id, $klient_id);
                $q->execute();

                // Insert opiekun
                if (!isset($_POST['opiekun_checkbox']) || $_POST['opiekun_checkbox'] != 'on') {
                    $opiekun_id = isset($_POST['opiekun']) ? $_POST['opiekun'] : 0;
                } else {
                    $imie_opiekun = isset($_POST['imie_opiekun']) ? $_POST['imie_opiekun'] : '';
                    $nazwisko_opiekun = isset($_POST['nazwisko_opiekun']) ? $_POST['nazwisko_opiekun'] : '';
                    $mail_opiekun = isset($_POST['mail_opiekun']) ? $_POST['mail_opiekun'] : '';
                    $telefon_opiekun = isset($_POST['telefon_opiekun']) ? $_POST['telefon_opiekun'] : '';
                    $adres_opiekun = isset($_POST['adres_opiekun']) ? $_POST['adres_opiekun'] : '';
                    $q = $db->prepare('INSERT INTO osoby (imie, nazwisko, mail, telefon, adres) VALUES (?, ?, ?, ?, ?)');
                    $q->bind_param('sssss', $imie_opiekun, $nazwisko_opiekun, $mail_opiekun, $telefon_opiekun, $adres_opiekun);
                    $q->execute();
                    $osoba_id = $q->insert_id;
                    if(!isset($_POST['opiekun_stanowisko_checkbox']) || $_POST['opiekun_stanowisko_checkbox'] != 'on') {
                        $stanowisko_id = isset($_POST['stanowisko_opiekun']) ? $_POST['stanowisko_opiekun'] : 0;
                    } else {
                        $nazwa_stanowisko = isset($_POST['opiekun_nowe_stanowisko']) ? $_POST['opiekun_nowe_stanowisko'] : '';
                        $q = $db->prepare('INSERT INTO stanowiska (nazwa) VALUES (?)');
                        $q->bind_param('s', $nazwa_stanowisko);
                        $q->execute();
                        $stanowisko_id = $q->insert_id;
                    }
                    $q = $db->prepare('INSERT INTO pracownicy (osoba, stanowisko, aktywny) VALUES (?, ?, 1)');
                    $q->bind_param('ii', $osoba_id, $stanowisko_id);
                    $q->execute();
                    $opiekun_id = $q->insert_id;
                }
                $q = $db->prepare('INSERT INTO opiekunowie (klient, pracownik) VALUES (?, ?)');
                $q->bind_param('ii', $klient_id, $opiekun_id);
                $q->execute();

                // Insert pakiet
                if (!isset($_POST['pakiet_checkbox']) || $_POST['pakiet_checkbox'] != 'on') {
                    $pakiet_id = isset($_POST['pakiet']) ? $_POST['pakiet'] : 0;
                } else {
                    $nazwa_pakiet = isset($_POST['nazwa_pakiet']) ? $_POST['nazwa_pakiet'] : '';
                    $cena_pakiet = isset($_POST['cena_pakiet']) ? $_POST['cena_pakiet'] : 0;
                    $q = $db->prepare('INSERT INTO pakiety (nazwa, cena) VALUES (?, ?)');
                    $q->bind_param('sd', $nazwa_pakiet, $cena_pakiet);
                    $q->execute();
                    $pakiet_id = $q->insert_id;
                }
                $czas_trwania_pakiet = (isset($_POST['czas_trwania_pakiet'])&&!empty($_POST['czas_trwania_pakiet'])) ? $_POST['czas_trwania_pakiet'] : 0;
                $data_zakupu = date('Y-m-d');
                $data_wygasniecia = date('Y-m-d', strtotime("+$czas_trwania_pakiet months"));
                if(!isset($_POST['sprzedawca_checkbox']) || $_POST['sprzedawca_checkbox'] != 'on') {
                    $sprzedawca_id = isset($_POST['sprzedawca']) ? $_POST['sprzedawca'] : 0;
                } else {
                    $imie_sprzedawca = isset($_POST['imie_sprzedawca']) ? $_POST['imie_sprzedawca'] : '';
                    $nazwisko_sprzedawca = isset($_POST['nazwisko_sprzedawca']) ? $_POST['nazwisko_sprzedawca'] : '';
                    $mail_sprzedawca = isset($_POST['mail_sprzedawca']) ? $_POST['mail_sprzedawca'] : '';
                    $telefon_sprzedawca = isset($_POST['telefon_sprzedawca']) ? $_POST['telefon_sprzedawca'] : '';
                    $adres_sprzedawca = isset($_POST['adres_sprzedawca']) ? $_POST['adres_sprzedawca'] : '';
                    $q = $db->prepare('INSERT INTO osoby (imie, nazwisko, mail, telefon, adres) VALUES (?, ?, ?, ?, ?)');
                    $q->bind_param('sssss', $imie_sprzedawca, $nazwisko_sprzedawca, $mail_sprzedawca, $telefon_sprzedawca, $adres_sprzedawca);
                    $q->execute();
                    $osoba_id = $q->insert_id;
                    if(!isset($_POST['sprzedawca_stanowisko_checkbox']) || $_POST['sprzedawca_stanowisko_checkbox'] != 'on') {
                        $stanowisko_id = isset($_POST['stanowisko_sprzedawca']) ? $_POST['stanowisko_sprzedawca'] : 0;
                    } else {
                        $nazwa_stanowisko = isset($_POST['sprzedawca_nowe_stanowisko']) ? $_POST['sprzedawca_nowe_stanowisko'] : '';
                        $q = $db->prepare('INSERT INTO stanowiska (nazwa) VALUES (?)');
                        $q->bind_param('s', $nazwa_stanowisko);
                        $q->execute();
                        $stanowisko_id = $q->insert_id;
                    }
                    $q = $db->prepare('INSERT INTO pracownicy (osoba, stanowisko, aktywny) VALUES (?, ?, 1)');
                    $q->bind_param('ii', $osoba_id, $stanowisko_id);
                    $q->execute();
                    $sprzedawca_id = $q->insert_id;
                }
                $q = $db->prepare('INSERT INTO sprzedane_pakiety (pakiet, klient, data_zakupu, data_wygasniecia, cena, sprzedawca) VALUES (?, ?, ?, ?, ?, ?)');
                $q->bind_param('iissdi', $pakiet_id, $klient_id, $data_zakupu, $data_wygasniecia, $cena_pakiet, $sprzedawca_id);
                $q->execute();

                // Zakończ transakcję
                $db->commit();
                header('Location: /?action=showc');
            } catch (Exception $e) {
                // W przypadku błędu wycofaj transakcję i wyświetl błąd
                $db->rollback();
                die('Błąd podczas dodawania klienta: ' . $e->getMessage());
            }
        } else {
            @require_once 'szablon/addc.php';
        }
        break;
    case 'addcontact':
        // Dodawanie kontaktu (addcontact) - dodaje kontakt do bazy danych i przekierowuje na stronę klienta
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rozpocznij transakcję (wszystko albo nic)
            $db->begin_transaction();
            try {
                if (isset($_POST['kontakt_checkbox']) && $_POST['kontakt_checkbox'] == 'on') {
                    $kontakt_id = isset($_POST['kontakt']) ? $_POST['kontakt'] : 0;
                } else {
                    $imie_kontakt = isset($_POST['imie']) ? $_POST['imie'] : '';
                    $nazwisko_kontakt = isset($_POST['nazwisko']) ? $_POST['nazwisko'] : '';
                    $mail_kontakt = isset($_POST['mail']) ? $_POST['mail'] : '';
                    $telefon_kontakt = isset($_POST['telefon']) ? $_POST['telefon'] : '';
                    $adres_kontakt = isset($_POST['adres']) ? $_POST['adres'] : '';
                    $q = $db->prepare('INSERT INTO osoby (imie, nazwisko, mail, telefon, adres) VALUES (?, ?, ?, ?, ?)');
                    $q->bind_param('sssss', $imie_kontakt, $nazwisko_kontakt, $mail_kontakt, $telefon_kontakt, $adres_kontakt);
                    $q->execute();
                    $kontakt_id = $q->insert_id;
                }
                $q = $db->prepare('INSERT INTO kontakty (osoba, klient, aktywny) VALUES (?, ?, 1)');
                $q->bind_param('ii', $kontakt_id, $_GET['idc']);
                $q->execute();

                // Zakończ transakcję
                $db->commit();
                header('Location: /?action=details&id=' . $_GET['idc']);
            } catch (Exception $e) {
                // W przypadku błędu wycofaj transakcję i wyświetl błąd
                $db->rollback();
                die('Błąd podczas dodawania kontaktu: ' . $e->getMessage());
            }
        } else {
            header('Location: /?action=details&id=' . $_GET['idc']);
        }
        break;
    case 'addpackage':
        // Dodawanie pakietu (addpackage) - dodaje pakiet do bazy danych i przekierowuje na stronę klienta
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rozpocznij transakcję (wszystko albo nic)
            $db->begin_transaction();
            try {
                if (!isset($_POST['pakiet_checkbox']) || $_POST['pakiet_checkbox'] != 'on') {
                    $pakiet_id = isset($_POST['pakiet']) ? $_POST['pakiet'] : 0;
                } else {
                    $nazwa_pakiet = isset($_POST['nazwa_pakiet']) ? $_POST['nazwa_pakiet'] : '';
                    $cena_pakiet = isset($_POST['cena_pakiet']) ? $_POST['cena_pakiet'] : 0;
                    $q = $db->prepare('INSERT INTO pakiety (nazwa, cena) VALUES (?, ?)');
                    $q->bind_param('sd', $nazwa_pakiet, $cena_pakiet);
                    $q->execute();
                    $pakiet_id = $q->insert_id;
                }
                $czas_trwania_pakiet = (isset($_POST['czas_trwania_pakiet'])&&!empty($_POST['czas_trwania_pakiet'])) ? $_POST['czas_trwania_pakiet'] : 0;
                $data_zakupu = isset($_POST['data_sprzedazy_pakiet']) ? $_POST['data_sprzedazy_pakiet'] : date('Y-m-d');
                $data_wygasniecia = date('Y-m-d', strtotime("+$czas_trwania_pakiet months"));
                if(!isset($_POST['sprzedawca_checkbox']) || $_POST['sprzedawca_checkbox'] != 'on') {
                    $sprzedawca_id = isset($_POST['sprzedawca']) ? $_POST['sprzedawca'] : 0;
                } else {
                    $imie_sprzedawca = isset($_POST['imie_sprzedawca']) ? $_POST['imie_sprzedawca'] : '';
                    $nazwisko_sprzedawca = isset($_POST['nazwisko_sprzedawca']) ? $_POST['nazwisko_sprzedawca'] : '';
                    $mail_sprzedawca = isset($_POST['mail_sprzedawca']) ? $_POST['mail_sprzedawca'] : '';
                    $telefon_sprzedawca = isset($_POST['telefon_sprzedawca']) ? $_POST['telefon_sprzedawca'] : '';
                    $adres_sprzedawca = isset($_POST['adres_sprzedawca']) ? $_POST['adres_sprzedawca'] : '';
                    $q = $db->prepare('INSERT INTO osoby (imie, nazwisko, mail, telefon, adres) VALUES (?, ?, ?, ?, ?)');
                    $q->bind_param('sssss', $imie_sprzedawca, $nazwisko_sprzedawca, $mail_sprzedawca, $telefon_sprzedawca, $adres_sprzedawca);
                    $q->execute();
                    $osoba_id = $q->insert_id;
                    if(!isset($_POST['sprzedawca_stanowisko_checkbox']) || $_POST['sprzedawca_stanowisko_checkbox'] != 'on') {
                        $stanowisko_id = isset($_POST['stanowisko_sprzedawca']) ? $_POST['stanowisko_sprzedawca'] : 0;
                    } else {
                        $nazwa_stanowisko = isset($_POST['sprzedawca_nowe_stanowisko']) ? $_POST['sprzedawca_nowe_stanowisko'] : '';
                        $q = $db->prepare('INSERT INTO stanowiska (nazwa) VALUES (?)');
                        $q->bind_param('s', $nazwa_stanowisko);
                        $q->execute();
                        $stanowisko_id = $q->insert_id;
                    }
                    $q = $db->prepare('INSERT INTO pracownicy (osoba, stanowisko, aktywny) VALUES (?, ?, 1)');
                    $q->bind_param('ii', $osoba_id, $stanowisko_id);
                    $q->execute();
                    $sprzedawca_id = $q->insert_id;
                }
                $q = $db->prepare('INSERT INTO sprzedane_pakiety (pakiet, klient, data_zakupu, data_wygasniecia, cena, sprzedawca) VALUES (?, ?, ?, ?, ?, ?)');
                $q->bind_param('iissdi', $pakiet_id, $_GET['idc'], $data_zakupu, $data_wygasniecia, $cena_pakiet, $sprzedawca_id);
                $q->execute();

                // Zakończ transakcję
                $db->commit();
                header('Location: /?action=details&id=' . $_GET['idc']);
            } catch (Exception $e) {
                // W przypadku błędu wycofaj transakcję i wyświetl błąd
                $db->rollback();
                die('Błąd podczas dodawania pakietu: ' . $e->getMessage());
            }
        } else {
            header('Location: /?action=details&id=' . $_GET['idc']);
        }
        break;
    case 'addguardian':
        // Dodawanie opiekuna (addguardian) - dodaje opiekuna do bazy danych i przekierowuje na stronę klienta
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Rozpocznij transakcję (wszystko albo nic)
            $db->begin_transaction();
            try {
                if (!isset($_POST['opiekun_checkbox']) || $_POST['opiekun_checkbox'] != 'on') {
                    $opiekun_id = isset($_POST['opiekun']) ? $_POST['opiekun'] : 0;
                } else {
                    $imie_opiekun = isset($_POST['imie']) ? $_POST['imie'] : '';
                    $nazwisko_opiekun = isset($_POST['nazwisko']) ? $_POST['nazwisko'] : '';
                    $mail_opiekun = isset($_POST['mail']) ? $_POST['mail'] : '';
                    $telefon_opiekun = isset($_POST['telefon']) ? $_POST['telefon'] : '';
                    $adres_opiekun = isset($_POST['adres']) ? $_POST['adres'] : '';
                    $q = $db->prepare('INSERT INTO osoby (imie, nazwisko, mail, telefon, adres) VALUES (?, ?, ?, ?, ?)');
                    $q->bind_param('sssss', $imie_opiekun, $nazwisko_opiekun, $mail_opiekun, $telefon_opiekun, $adres_opiekun);
                    $q->execute();
                    $osoba_id = $q->insert_id;
                    if(!isset($_POST['opiekun_stanowisko_checkbox']) || $_POST['opiekun_stanowisko_checkbox'] != 'on') {
                        $stanowisko_id = isset($_POST['stanowisko_opiekun']) ? $_POST['stanowisko_opiekun'] : 0;
                    } else {
                        $nazwa_stanowisko = isset($_POST['opiekun_nowe_stanowisko']) ? $_POST['opiekun_nowe_stanowisko'] : '';
                        $q = $db->prepare('INSERT INTO stanowiska (nazwa) VALUES (?)');
                        $q->bind_param('s', $nazwa_stanowisko);
                        $q->execute();
                        $stanowisko_id = $q->insert_id;
                    }
                    $q = $db->prepare('INSERT INTO pracownicy (osoba, stanowisko, aktywny) VALUES (?, ?, 1)');
                    $q->bind_param('ii', $osoba_id, $stanowisko_id);
                    $q->execute();
                    $opiekun_id = $q->insert_id;
                }
                $q = $db->prepare('INSERT INTO opiekunowie (klient, pracownik) VALUES (?, ?)');
                $q->bind_param('ii', $_GET['idc'], $opiekun_id);
                $q->execute();

                // Zakończ transakcję
                $db->commit();
                header('Location: /?action=details&id=' . $_GET['idc']);
            } catch (Exception $e) {
                // W przypadku błędu wycofaj transakcję i wyświetl błąd
                $db->rollback();
                die('Błąd podczas dodawania opiekuna: ' . $e->getMessage());
            }
        } else {
            header('Location: /?action=details&id=' . $_GET['idc']);
        }
        break;
    case 'getcontacts':
        // Pobierz kontakty (getcontacts) - zwraca listę kontaktów w formacie JSON
        $q = $db->prepare('SELECT id, imie, nazwisko, telefon, mail FROM osoby');
        $q->execute();
        $r = $q->get_result();
        $contacts = [];
        while ($row = $r->fetch_assoc()) {
            $contacts[] = $row;
        }
        echo json_encode($contacts);
        break;
    case 'getworkers':
        // Pobierz pracowników (getworkers) - zwraca listę pracowników w formacie JSON
        $q = $db->prepare('
            SELECT 
            p.id, o.imie, o.nazwisko, o.telefon, o.mail, s.nazwa AS stanowisko
            FROM pracownicy p
            LEFT JOIN osoby o ON p.osoba = o.id
            LEFT JOIN stanowiska s ON p.stanowisko = s.id
        ');
        $q->execute();
        $r = $q->get_result();
        $workers = [];
        while ($row = $r->fetch_assoc()) {
            $workers[] = $row;
        }
        echo json_encode($workers);
        break;
    case 'getpakiety':
        // Pobierz pakiety (getpakiety) - zwraca listę pakietów w formacie JSON
        $q = $db->prepare('SELECT id, nazwa, cena FROM pakiety');
        $q->execute();
        $r = $q->get_result();
        $pakiety = [];
        while ($row = $r->fetch_assoc()) {
            $pakiety[] = $row;
        }
        echo json_encode($pakiety);
        break;
    case 'getstanowiska':
        // Pobierz stanowiska (getstanowiska) - zwraca listę stanowisk w formacie JSON
        $q = $db->prepare('SELECT id, nazwa FROM stanowiska');
        $q->execute();
        $r = $q->get_result();
        $stanowiska = [];
        while ($row = $r->fetch_assoc()) {
            $stanowiska[] = $row;
        }
        echo json_encode($stanowiska);
        break;
    }
    
    function getWorkerDetails($workerId) {
        // Pobierz dane pracownika
        global $db;
        $q = $db->prepare('
            SELECT 
            p.id, p.aktywny, 
            o.imie, o.nazwisko, o.telefon, o.mail, o.adres, 
            s.nazwa AS stanowisko
            FROM pracownicy p
            LEFT JOIN osoby o ON p.osoba = o.id
            LEFT JOIN stanowiska s ON p.stanowisko = s.id
            WHERE p.id = ?
        ');
        $q->bind_param('i', $workerId);
        $q->execute();
        $result = $q->get_result();
        return $result->fetch_assoc();
    }

    function getPackageDetail($idpakiet) {
        // Pobierz dane pakietu
        global $db;
        $q = $db->prepare('SELECT id, nazwa, cena FROM pakiety WHERE id = ?');
        $q->bind_param('i', $idpakiet);
        $q->execute();
        $result = $q->get_result();
        return $result->fetch_assoc();
    }

    function getPersonDetail($idperson) {
        // Pobierz dane osoby
        global $db;
        $q = $db->prepare('SELECT id, imie, nazwisko, mail, telefon, adres FROM osoby WHERE id = ?');
        $q->bind_param('i', $idperson);
        $q->execute();
        $result = $q->get_result();
        return $result->fetch_assoc();
    }

$db->close();

?>