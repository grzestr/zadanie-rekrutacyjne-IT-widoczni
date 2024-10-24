<?php include_once 'header.php'; ?>
<div class="container py-5">
    <div class="row">
        <h1><?php echo $pname; ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/"><?php echo CMS_NAME; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $pname; ?></a></li>
            </ol>
        </nav>
        <table class="table table-striped dttable">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Strona</th>
                    <th data-dt-order="disable">Szczegóły</th>                    
                    <th data-dt-order="disable">Edytuj</th>
                    <th data-dt-order="disable">Usuń</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($klienci as $klient): ?>
                    <tr>
                        <td><?php echo $klient['nazwa']; ?></td>
                        <td><a target="_blank" href="http://<?php echo preg_replace('~^(?:https?:)?//~Usmi','',$klient['strona']); ?>"><?php echo $klient['strona']; ?></a></td>
                        <td><a href="/?action=details&id=<?php echo $klient['id']; ?>">Szczegóły</a></td>
                        <td><a href="/?action=editc&id=<?php echo $klient['id']; ?>">Edytuj</a></td>
                        <td><a href="/?action=deletec&id=<?php echo $klient['id']; ?>">Usuń</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="container py5 text-center">
    <div class="row">
        <div class="list-group">
            <a href="/?action=addc" class="list-group-item list-group-item-action">Dodaj klienta</a>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>