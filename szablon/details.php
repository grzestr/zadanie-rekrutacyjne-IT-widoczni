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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcontact">
                    Dodaj kontakt
                </button>

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
                                <th scope="col">Usuń</th>
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
                                    <td><a href="/?action=deletecg&idc=<?php echo $klient['klient']['id']; ?>&idop=<?php echo $opiekun['opiekun_id']; ?>" title="Usuń opiekuna"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addguardian">
                    Dodaj opiekuna
                </button>
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
                                <th scope="col">Usuń</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($klient['pakiety'] as $pakiet): ?>
                                <tr>
                                    <td><?php echo $pakiet['pakiet_nazwa']; ?></td>
                                    <td><?php echo $pakiet['data_zakupu']; ?></td>
                                    <td><?php echo $pakiet['data_wygasniecia']=='1970-01-01'?'Bezterminowy':$pakiet['data_wygasniecia']; ?></td>
                                    <td><?php echo $pakiet['pakiet_cena']; ?></td>
                                    <td><?php echo $pakiet['imie'].' '.$pakiet['nazwisko'].' ('.$pakiet['stanowisko_nazwa'].')'; ?></td>
                                    <td><a href="/?action=deletecp&idc=<?php echo $klient['klient']['id']; ?>&idspa=<?php echo $pakiet['sprzedany_pakiet_id']; ?>" title="Usuń pakiet"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpackage">
                    Dodaj pakiet
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="addcontact" tabindex="-1" aria-labelledby="addcontactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodaj kolejną osobę kontaktową</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/?action=addcontact&idc=<?php echo $klient['klient']['id']; ?>" method="post" onsubmit="return validateForm()">
                    <label for="kontakt_checkbox" class="form-label">Wybierz istniejący kontakt:</label>
                    <input type="checkbox" class="form-check-input" id="kontakt_checkbox" name="kontakt_checkbox" onclick="toggleKontaktFields()"><br>
                    
                    <div id="kontakt_select" style="display:none;">
                        <label for="kontakt" class="form-label">Wybierz osobę kontaktową:</label>
                        <select id="kontakt" class="form-select" name="kontakt">
                            <!-- Opcje zostaną załadowane dynamicznie -->
                        </select><br>
                    </div>
                    <div id="kontakt_fields">
                        <div class="mb-3">
                            <label for="imie" class="form-label">Imię</label>
                            <input type="text" class="form-control" id="imie" name="imie" data-req="req" required>
                        </div>
                        <div class="mb-3">
                            <label for="nazwisko" class="form-label">Nazwisko</label>
                            <input type="text" class="form-control" id="nazwisko" name="nazwisko" data-req="req" required>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Mail</label>
                            <input type="email" class="form-control" id="mail" name="mail">
                        </div>
                        <div class="mb-3">
                            <label for="telefon" class="form-label">Telefon</label>
                            <input type="tel" class="form-control" id="telefon" name="telefon">
                        </div>
                        <div class="mb-3">
                            <label for="adres" class="form-label">Adres</label>
                            <input type="text" class="form-control" id="adres" name="adres">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj kontakt</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="addguardian" tabindex="-1" aria-labelledby="addguardianLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodaj kolejnego opiekuna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/?action=addguardian&idc=<?php echo $klient['klient']['id']; ?>" method="post" onsubmit="return validateForm()">
                    <label class="form-label" for="opiekun_checkbox">Dodaj nowego opiekuna:</label>
                    <input type="checkbox" class="form-check-input" id="opiekun_checkbox" name="opiekun_checkbox" onclick="toggleOpiekunFields()"><br>
                    
                    <div id="opiekun_select">
                        <label class="form-label" for="opiekun">Wybierz opiekuna:</label>
                        <select class="form-select" id="opiekun" name="opiekun">
                        <!-- Opcje zostaną załadowane dynamicznie -->
                        </select><br>
                    </div>
                    <div id="opiekun_fields" style="display:none;">
                        <div class="mb-3">
                            <label for="imie" class="form-label">Imię</label>
                            <input type="text" class="form-control" id="imie" name="imie" data-req="req">
                        </div>
                        <div class="mb-3">
                            <label for="nazwisko" class="form-label">Nazwisko</label>
                            <input type="text" class="form-control" id="nazwisko" name="nazwisko" data-req="req">
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Mail</label>
                            <input type="email" class="form-control" id="mail" name="mail">
                        </div>
                        <div class="mb-3">
                            <label for="telefon" class="form-label">Telefon</label>
                            <input type="tel" class="form-control" id="telefon" name="telefon">
                        </div>
                        <div class="mb-3">
                            <label for="stanowisko" class="form-label">Stanowisko</label>
                            <label class="form-label" for="opiekun_stanowisko_checkbox">Dodaj nowe stanowisko:</label>
                            <input type="checkbox" class="form-check-input" id="opiekun_stanowisko_checkbox" name="opiekun_stanowisko_checkbox" onclick="toggleStanowiskoFields()"><br>
                            <div id="stanowisko_select">
                                <label class="form-label" for="stanowisko_opiekun">Wybierz stanowisko:</label>
                                <select class="form-select" id="stanowisko_opiekun" name="stanowisko_opiekun">
                                <!-- Opcje zostaną załadowane dynamicznie -->
                                </select><br>
                            </div>
                            <div id="opiekun_stanowisko_fields" style="display:none;">
                                <label class="form-label" for="opiekun_nowe_stanowisko">Dodaj nowe stanowisko:</label><br>
                                <input class="form-control" type="text" id="opiekun_nowe_stanowisko" name="opiekun_nowe_stanowisko"><br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj opiekuna</button>
                </form>
                <script>
                function toggleOpiekunFields() {
                    var checkbox = document.getElementById('opiekun_checkbox');
                    var opiekunSelect = document.getElementById('opiekun_select');
                    var opiekunFields = document.getElementById('opiekun_fields');
                    var requiredFields = opiekunFields.querySelectorAll('[data-req="req"]');
                    
                    if (checkbox.checked) {
                        opiekunSelect.style.display = 'none';
                        opiekunFields.style.display = 'block';
                        requiredFields.forEach(function(field) {
                            field.setAttribute('required', 'required');
                        });
                    } else {
                        opiekunSelect.style.display = 'block';
                        opiekunFields.style.display = 'none';
                        requiredFields.forEach(function(field) {
                            field.removeAttribute('required');
                        });
                        loadWorkers();
                    }
                }

                function toggleStanowiskoFields() {
                    var checkbox = document.getElementById('opiekun_stanowisko_checkbox');
                    var stanowiskoSelect = document.getElementById('stanowisko_select');
                    var stanowiskoFields = document.getElementById('opiekun_stanowisko_fields');
                    var requiredField = document.getElementById('opiekun_nowe_stanowisko');
                    
                    if (checkbox.checked) {
                        stanowiskoSelect.style.display = 'none';
                        stanowiskoFields.style.display = 'block';
                        requiredField.setAttribute('required', 'required');
                    } else {
                        stanowiskoSelect.style.display = 'block';
                        stanowiskoFields.style.display = 'none';
                        requiredField.removeAttribute('required');
                        loadStanowiska();
                    }
                }

                function loadStanowiska() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/index.php?action=getstanowiska', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var stanowiska = JSON.parse(xhr.responseText);
                            var select = document.getElementById('stanowisko_opiekun');
                            select.innerHTML = ''; // Clear existing options
                            stanowiska.forEach(function(stanowisko) {
                                var option = document.createElement('option');
                                option.value = stanowisko.id;
                                option.textContent = stanowisko.nazwa;
                                select.appendChild(option);
                            });
                        } else {
                            console.error('Failed to load stanowiska');
                        }
                    }
                    xhr.send();
                }

                function loadWorkers() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/index.php?action=getworkers', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var workers = JSON.parse(xhr.responseText);
                            var opiekunSelect = document.getElementById('opiekun');
                            opiekunSelect.innerHTML = ''; // Clear existing options
                            workers.forEach(function(worker) {
                                var option = document.createElement('option');
                                option.value = worker.id;
                                option.textContent = worker.imie + ' ' + worker.nazwisko + ' (' + worker.stanowisko + ')';
                                opiekunSelect.appendChild(option);
                            });
                        } else {
                            console.error('Failed to load workers');
                        }
                    };
                    xhr.send();
                }
                </script>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="addpackage" tabindex="-1" aria-labelledby="addpackageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodaj pakiet dla klienta "<?php echo $klient['klient']['nazwa']; ?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/?action=addpackage&idc=<?php echo $klient['klient']['id']; ?>" method="post" onsubmit="return validateForm()">
                    <label class="form-label" for="pakiet_checkbox">Dodaj nowy pakiet:</label>
                    <input type="checkbox" class="form-check-input" id="pakiet_checkbox" name="pakiet_checkbox" onclick="togglePakietFields()"><br>
                    
                    <div id="pakiet_select">
                        <label class="form-label" for="pakiet">Wybierz pakiet:</label>
                        <select class="form-select" id="pakiet" name="pakiet">
                            <!-- Opcje zostaną załadowane dynamicznie -->
                        </select><br>
                    </div>
                    
                    <div id="pakiet_fields" style="display:none;">
                        <label class="form-label" for="nowy_pakiet">Dodaj nowy pakiet:</label><br>
                        <label class="form-label" for="nazwa_pakiet">Nazwa:</label>
                        <input class="form-control" type="text" id="nazwa_pakiet" name="nazwa_pakiet" data-req="req"><br>
                        <label class="form-label" for="cena_pakiet">Cena:</label>
                        <input class="form-control" type="number" step="0.01" id="cena_pakiet" name="cena_pakiet"><br>
                        <label class="form-label" for="czas_trwania_pakiet">Czas trwania (w miesiącach):</label>
                        <input class="form-control" type="number" id="czas_trwania_pakiet" name="czas_trwania_pakiet" onchange="updatePakietDates()"><br>
                        <label class="form-label" for="data_sprzedazy_pakiet">Data sprzedaży:</label>
                        <input class="form-control" type="date" id="data_sprzedazy_pakiet" name="data_sprzedazy_pakiet" value="<?php echo date('Y-m-d'); ?>"><br>
                        <label class="form-label" for="data_wygasniecia_pakiet">Data wygaśnięcia:</label>
                        <input class="form-control" type="date" id="data_wygasniecia_pakiet" name="data_wygasniecia_pakiet" readonly><br>
                    </div>
                
                    <legend>Sprzedawca pakietu</legend>
                    <label class="form-label" for="sprzedawca_checkbox">Dodaj nowego sprzedawcę:</label>
                    <input type="checkbox" class="form-check-input" id="sprzedawca_checkbox" name="sprzedawca_checkbox" onclick="toggleSprzedawcaFields()"><br>
                    
                    <div id="sprzedawca_select">
                        <label class="form-label" for="sprzedawca">Wybierz sprzedawcę:</label>
                        <select class="form-select" id="sprzedawca" name="sprzedawca">
                            <!-- Opcje zostaną załadowane dynamicznie -->
                        </select><br>
                    </div>
                    
                    <div id="sprzedawca_fields" style="display:none;">
                        <label class="form-label" for="nowy_sprzedawca">Dodaj nowego sprzedawcę:</label><br>
                        <label class="form-label" for="imie_sprzedawca">Imię:</label>
                        <input class="form-control" type="text" id="imie_sprzedawca" name="imie_sprzedawca" data-req="req"><br>
                        <label class="form-label" for="nazwisko_sprzedawca">Nazwisko:</label>
                        <input class="form-control" type="text" id="nazwisko_sprzedawca" name="nazwisko_sprzedawca" data-req="req"><br>
                        <label class="form-label" for="mail_sprzedawca">Email:</label>
                        <input class="form-control" type="email" id="mail_sprzedawca" name="mail_sprzedawca"><br>
                        <label class="form-label" for="telefon_sprzedawca">Telefon:</label>
                        <input class="form-control" type="tel" id="telefon_sprzedawca" name="telefon_sprzedawca"><br>
                        <label class="form-label" for="adres_sprzedawca">Adres:</label>
                        <textarea class="form-control" id="adres_sprzedawca" name="adres_sprzedawca"></textarea><br>
                        <label class="form-label" for="stanowisko_sprzedawca">Stanowisko:</label>
                        <legend>Stanowisko</legend>
                        <label class="form-label" for="sprzedawca_stanowisko_checkbox">Dodaj nowe stanowisko:</label>
                        <input type="checkbox" class="form-check-input" id="sprzedawca_stanowisko_checkbox" name="sprzedawca_stanowisko_checkbox" onclick="toggleStanowiskoFields()"><br>
                        <div id="sprzedawca_stanowisko_select">
                            <label class="form-label" for="stanowisko_sprzedawca">Wybierz stanowisko:</label>
                            <select class="form-select" id="stanowisko_sprzedawca" name="stanowisko_sprzedawca">
                                <!-- Opcje zostaną załadowane dynamicznie -->
                            </select><br>
                        </div>
                        <div id="sprzedawca_stanowisko_fields" style="display:none;">
                            <label class="form-label" for="sprzedawca_nowe_stanowisko">Dodaj nowe stanowisko:</label><br>
                            <input class="form-control" type="text" id="sprzedawca_nowe_stanowisko" name="sprzedawca_nowe_stanowisko" data-req="req"><br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj pakiet</button>
                </form>

                <script>
                function togglePakietFields() {
                    var checkbox = document.getElementById('pakiet_checkbox');
                    var pakietSelect = document.getElementById('pakiet_select');
                    var pakietFields = document.getElementById('pakiet_fields');
                    var requiredFields = pakietFields.querySelectorAll('[data-req="req"]');
                    
                    if (checkbox.checked) {
                        pakietSelect.style.display = 'none';
                        pakietFields.style.display = 'block';
                        requiredFields.forEach(function(field) {
                            field.setAttribute('required', 'required');
                        });
                    } else {
                        pakietSelect.style.display = 'block';
                        pakietFields.style.display = 'none';
                        requiredFields.forEach(function(field) {
                            field.removeAttribute('required');
                        });
                        loadPakiety();
                    }
                }

                function toggleSprzedawcaFields() {
                    var checkbox = document.getElementById('sprzedawca_checkbox');
                    var sprzedawcaSelect = document.getElementById('sprzedawca_select');
                    var sprzedawcaFields = document.getElementById('sprzedawca_fields');
                    var requiredFields = sprzedawcaFields.querySelectorAll('[data-req="req"]:not(#sprzedawca_nowe_stanowisko)');
                    
                    if (checkbox.checked) {
                        sprzedawcaSelect.style.display = 'none';
                        sprzedawcaFields.style.display = 'block';
                        requiredFields.forEach(function(field) {
                            field.setAttribute('required', 'required');
                        });
                    } else {
                        sprzedawcaSelect.style.display = 'block';
                        sprzedawcaFields.style.display = 'none';
                        requiredFields = sprzedawcaFields.querySelectorAll('[data-req="req"]');
                        requiredFields.forEach(function(field) {
                            field.removeAttribute('required');
                        });
                        loadWorkers();
                    }
                }

                function toggleStanowiskoFields() {
                    var checkbox = document.getElementById('opiekun_stanowisko_checkbox');
                    var checkboxSprzedawca = document.getElementById('sprzedawca_stanowisko_checkbox');
                    var stanowiskoSelect = document.getElementById('stanowisko_select');
                    var stanowiskoSprzedawcaSelect = document.getElementById('sprzedawca_stanowisko_select');
                    var stanowiskoFields = document.getElementById('opiekun_stanowisko_fields');
                    var stanowiskoSprzedawcaFields = document.getElementById('sprzedawca_stanowisko_fields');
                    var requiredFields = stanowiskoFields.querySelectorAll('[data-req="req"]');
                    var requiredFieldsSprzedawca = stanowiskoSprzedawcaFields.querySelectorAll('[data-req="req"]');
                    
                    if (checkbox.checked) {
                        stanowiskoSelect.style.display = 'none';
                        stanowiskoFields.style.display = 'block';
                        requiredFields.forEach(function(field) {
                            field.setAttribute('required', 'required');
                        });
                    } else {
                        stanowiskoSelect.style.display = 'block';
                        stanowiskoFields.style.display = 'none';
                        requiredFields.forEach(function(field) {
                            field.removeAttribute('required');
                        });
                        loadStanowiska();
                    }
                    if (checkboxSprzedawca.checked) {
                        stanowiskoSprzedawcaSelect.style.display = 'none';
                        stanowiskoSprzedawcaFields.style.display = 'block';
                        requiredFieldsSprzedawca.forEach(function(field) {
                            field.setAttribute('required', 'required');
                        });
                    } else {
                        stanowiskoSprzedawcaSelect.style.display = 'block';
                        stanowiskoSprzedawcaFields.style.display = 'none';
                        requiredFieldsSprzedawca.forEach(function(field) {
                            field.removeAttribute('required');
                        });
                        loadStanowiska();
                    }
                }

                function updatePakietDates() {
                    var dataSprzedazy = document.getElementById('data_sprzedazy_pakiet').value;
                    var czasTrwania = document.getElementById('czas_trwania_pakiet').value;
                    if (dataSprzedazy && czasTrwania) {
                        var dataSprzedazyDate = new Date(dataSprzedazy);
                        dataSprzedazyDate.setMonth(dataSprzedazyDate.getMonth() + parseInt(czasTrwania));
                        var dataWygasniecia = dataSprzedazyDate.toISOString().split('T')[0];
                        document.getElementById('data_wygasniecia_pakiet').value = dataWygasniecia;
                    }
                }

                document.getElementById('data_sprzedazy_pakiet').addEventListener('change', updatePakietDates);

                function loadPakiety() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/index.php?action=getpakiety', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var pakiety = JSON.parse(xhr.responseText);
                            var select = document.getElementById('pakiet');
                            select.innerHTML = ''; // Clear existing options
                            pakiety.forEach(function(pakiet) {
                                var option = document.createElement('option');
                                option.value = pakiet.id;
                                option.textContent = pakiet.nazwa + ' (' + pakiet.cena + ' PLN)';
                                select.appendChild(option);
                            });
                        } else {
                            console.error('Failed to load pakiety');
                        }
                    };
                    xhr.send();
                }

                function loadStanowiska() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/index.php?action=getstanowiska', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var stanowiska = JSON.parse(xhr.responseText);
                            var select = document.getElementById('stanowisko_opiekun');
                            var sprzedawcaSelect = document.getElementById('stanowisko_sprzedawca');
                            select.innerHTML = ''; // Clear existing options
                            sprzedawcaSelect.innerHTML = ''; // Clear existing options
                            stanowiska.forEach(function(stanowisko) {
                                var option = document.createElement('option');
                                option.value = stanowisko.id;
                                option.textContent = stanowisko.nazwa;
                                select.appendChild(option);
                                sprzedawcaSelect.appendChild(option.cloneNode(true)); // Clone the option for sprzedawca
                            });
                        } else {
                            console.error('Failed to load stanowiska');
                        }
                    }
                    xhr.send();
                }

                function loadWorkers() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/index.php?action=getworkers', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var workers = JSON.parse(xhr.responseText);
                            var opiekunSelect = document.getElementById('opiekun');
                            var sprzedawcaSelect = document.getElementById('sprzedawca');
                            opiekunSelect.innerHTML = ''; // Clear existing options
                            sprzedawcaSelect.innerHTML = ''; // Clear existing options
                            workers.forEach(function(worker) {
                                var option = document.createElement('option');
                                option.value = worker.id;
                                option.textContent = worker.imie + ' ' + worker.nazwisko + ' (' + worker.stanowisko + ')';
                                opiekunSelect.appendChild(option);
                                sprzedawcaSelect.appendChild(option.cloneNode(true)); // Clone the option for sprzedawca
                            });
                        } else {
                            console.error('Failed to load workers');
                        }
                    };
                    xhr.send();
                }
                </script>
            </div>
        </div>
    </div>
</div>

<script>
function toggleKontaktFields() {
    var checkbox = document.getElementById('kontakt_checkbox');
    var kontaktSelect = document.getElementById('kontakt_select');
    var kontaktFields = document.getElementById('kontakt_fields');
    var requiredFields = kontaktFields.querySelectorAll('[data-req="req"]');
    
    if (checkbox.checked) {
        kontaktSelect.style.display = 'block';
        kontaktFields.style.display = 'none';
        requiredFields.forEach(function(field) {
            field.removeAttribute('required');
        });
        loadContacts();
    } else {
        kontaktSelect.style.display = 'none';
        kontaktFields.style.display = 'block';
        requiredFields.forEach(function(field) {
            field.setAttribute('required', 'required');
        });
    }
}

function loadContacts() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/index.php?action=getcontacts', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var contacts = JSON.parse(xhr.responseText);
            var select = document.getElementById('kontakt');
            select.innerHTML = ''; // Wyczyść istniejące opcje
            contacts.forEach(function(contact) {
                var option = document.createElement('option');
                option.value = contact.id;
                option.textContent = contact.imie + ' ' + contact.nazwisko + ' (' + contact.telefon + ', ' + contact.mail + ')';
                select.appendChild(option);
            });
        } else {
            console.error('Failed to load contacts');
        }
    };
    xhr.send();
}

function validateForm() {
    var requiredFields = document.querySelectorAll('input[required], textarea[required]');
    for (var i = 0; i < requiredFields.length; i++) {
        if (requiredFields[i].offsetParent !== null && !requiredFields[i].value) {
            alert('Proszę wypełnić wszystkie wymagane pola.');
            return false;
        }
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
                    loadWorkers();
                    loadStanowiska();
                    loadPakiety();
                });
</script>
<?php
/*echo "<pre>";
echo "Klient:\n";
var_dump($klient);


echo "</pre>"; */
?>
<?php @include_once 'footer.php'; ?>