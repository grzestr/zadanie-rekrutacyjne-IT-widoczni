<?php
@include_once 'header.php';
?>
<div class="container-xxl py-5">
    <div class="row">
        <h1>Szczegóły klienta "<?php echo $klient['klient']['nazwa']; ?>"</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 18">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg> <?php echo CMS_NAME; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $klient['klient']['nazwa']; ?></a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xl-5">
            <div class="card my-1">
                <div class="card-header">
                    <h2>Dane klienta <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg></h2>
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
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
</svg> <a href="mailto:<?php echo $kontakt['mail']; ?>"><?php echo $kontakt['mail']; ?></a></td>
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg> <a href="tel:<?php echo $kontakt['telefon']; ?>"><?php echo $kontakt['telefon']; ?></a></td>
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
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
</svg> <a href="mailto:<?php echo $opiekun['mail']; ?>"><?php echo $opiekun['mail']; ?></a></td>
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg> <a href="tel:<?php echo $opiekun['telefon']; ?>"><?php echo $opiekun['telefon']; ?></a></td>
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
/*echo "<pre>";
echo "Klient:\n";
var_dump($klient);


echo "</pre>"; */
?>
<?php @include_once 'footer.php'; ?>