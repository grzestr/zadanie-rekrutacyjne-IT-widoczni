<?php
@require_once 'config.php';
@include_once 'szablon/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'start';

// Połączenie z bazą danych
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

switch ($action) {
    case 'start':
        @require_once 'szablon/start.php';
        break;
    case 'showc':
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
    }

/*/ Wyświetlanie pierwszych 3 wierszy
$q = $db->prepare('SELECT * FROM klienci LIMIT 3');
$q->execute();
$r = $q->get_result();
echo "<pre>Pierwsze 3 wierszy:\n";
while ($row = $r->fetch_assoc()) {
    print_r($row);
}
echo "</pre>";

// Sprawdzanie, czy jest więcej niż 3 wierszy
$q = $db->prepare('SELECT COUNT(*) as total FROM klienci');
$q->execute();
$r = $q->get_result();
$row = $r->fetch_assoc();
$totalRows = $row['total'];

if ($totalRows > 3) {
    // Wyświetlanie kolejnych 3 wierszy
    $q = $db->prepare('SELECT * FROM klienci LIMIT 3 OFFSET 3');
    $q->execute();
    $r = $q->get_result();
    echo "<pre>Kolejne 3 wierszy:\n";
    while ($row = $r->fetch_assoc()) {
        print_r($row);
    }
    echo "</pre>";
}*/
@include_once 'szablon/footer.php';
?>