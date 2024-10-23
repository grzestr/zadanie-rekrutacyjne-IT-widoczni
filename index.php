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

$db->close();
@include_once 'szablon/footer.php';
?>