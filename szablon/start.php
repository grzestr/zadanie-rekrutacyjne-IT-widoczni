<?php include_once 'header.php'; ?>
<div class="container py-5 text-center">
    <div class="row">
        <h1><?php echo $pname; ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 18">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg> <?php echo $pname; ?></a></li>
            </ol>
        </nav>
        <div class="list-group">
            <a href="/?action=showc" class="list-group-item list-group-item-action">Wyświetl klientów</a>
            <a href="/?action=addc" class="list-group-item list-group-item-action">Dodaj klienta</a>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>