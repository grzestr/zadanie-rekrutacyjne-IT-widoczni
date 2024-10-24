<?php include_once 'header.php'; ?>
<div class="container py-5 text-center">
    <div class="row">
        <h1><?php echo $pname; ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="/"><?php echo $pname; ?></a></li>
            </ol>
        </nav>
        <div class="list-group">
            <a href="/?action=showc" class="list-group-item list-group-item-action">Wyświetl klientów</a>
            <a href="/?action=addc" class="list-group-item list-group-item-action">Dodaj klienta</a>
        </div>
    </div>
</div>