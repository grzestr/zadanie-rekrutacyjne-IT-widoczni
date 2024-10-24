<div class="container py5">
    <div class="row">
        <h1>Lista klientów</h1>
        <table id="dttable" class="table table-striped">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Strona</th>
                    <th>Szczegóły</th>                    
                    <th>Edytuj</th>
                    <th>Usuń</th>
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