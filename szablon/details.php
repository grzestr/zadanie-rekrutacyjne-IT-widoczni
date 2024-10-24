<?php
@include_once 'header.php';
?>
<div class="container-xxl py-5">
    <div class="row">
        <h1>Szczegóły klienta "<?php echo $klient['klient']['nazwa']; ?>"</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/"><?php echo CMS_NAME; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $klient['klient']['nazwa']; ?></a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xl-5">
            <div class="card my-1">
                <div class="card-header">
                    <h2>Dane klienta</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="table-active">
                                <th scope="row">Nazwa:</th>
                                <td><h5><?php echo $klient['klient']['nazwa']; ?></h5></td>
                            </tr>
                            <tr>
                                <th scope="row">Strona:</th>
                                <td><a target="_blank" href="http://<?php echo preg_replace('~^(?:https?:)?//~Usmi','',$klient['klient']['strona']); ?>"><?php echo $klient['klient']['strona']; ?></a></td>
                            </tr>
                            <tr>
                                <th scope="row">Uwagi:</th>
                                <td><?php echo $klient['klient']['uwagi']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card my-1">
                <div class="card-header">
                    <h2>Kontakty</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped<?php if(count($klient['kontakty'])>10){ echo ' dttable';} ?>">
                        <thead>
                            <tr>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>Mail</th>
                                <th>Telefon</th>
                                <th>Adres</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($klient['kontakty'] as $kontakt): ?>
                                <tr>
                                    <td><?php echo $kontakt['imie']; ?></td>
                                    <td><?php echo $kontakt['nazwisko']; ?></td>
                                    <td><a href="mailto:<?php echo $kontakt['mail']; ?>"><?php echo $kontakt['mail']; ?></a></td>
                                    <td><a href="tel:<?php echo $kontakt['telefon']; ?>"><?php echo $kontakt['telefon']; ?></a></td>
                                    <td><?php echo $kontakt['adres']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card my-1">
                <div class="card-header">
                    <h2>Opiekunowie klienta</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped<?php if(count($klient['opiekunowie'])>10){ echo ' dttable';} ?>">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Telefon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($klient['opiekunowie'] as $opiekun): ?>
                                <tr>
                                    <th scope="row"><?php echo $opiekun['stanowisko_nazwa']; ?></th>
                                    <td><?php echo $opiekun['imie']; ?></td>
                                    <td><?php echo $opiekun['nazwisko']; ?></td>
                                    <td><a href="mailto:<?php echo $opiekun['mail']; ?>"><?php echo $opiekun['mail']; ?></a></td>
                                    <td><a href="tel:<?php echo $opiekun['telefon']; ?>"><?php echo $opiekun['telefon']; ?></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card my-1">
                <div class="card-header">
                    <h2>Pakiety klienta</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped<?php if(count($klient['pakiety'])>10){ echo ' dttable';} ?>">
                        <thead>
                            <tr>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Data zakupu</th>
                                <th scope="col">Data wygaśnięcia</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Sprzedawca</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($klient['pakiety'] as $pakiet): ?>
                                <tr>
                                    <td><?php echo $pakiet['pakiet_nazwa']; ?></td>
                                    <td><?php echo $pakiet['data_zakupu']; ?></td>
                                    <td><?php echo $pakiet['data_wygasniecia']; ?></td>
                                    <td><?php echo $pakiet['pakiet_cena']; ?></td>
                                    <td><?php echo $pakiet['imie'].' '.$pakiet['nazwisko'].' ('.$pakiet['stanowisko_nazwa'].')'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo "<pre>";
echo "Klient:\n";
var_dump($klient);


echo "</pre>";
?>
<?php @include_once 'footer.php'; ?>