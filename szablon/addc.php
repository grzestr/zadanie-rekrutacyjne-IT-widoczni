<?php
@include_once 'header.php';
?>
<div class="container-xxl py-5">
    <div class="row">
        <h1>Dodaj nowego klienta</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 18">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
</svg> <?php echo CMS_NAME; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $pname; ?></a></li>
            </ol>
        </nav>
        <form class="row g-3" action="/index.php?action=addc" method="post" onsubmit="return validateForm()">
            <div class="col-lg-4">
                <fieldset>
                    <legend>Dane klienta</legend>
                    <label for="nazwa" class="form-label">Nazwa:</label>
                    <input type="text" class="form-control" id="nazwa" name="nazwa" required><br>
                    <label for="strona" class="form-label">Strona:</label>
                    <input type="url" class="form-control" id="strona" name="strona"><br>
                    <label for="uwagi" class="form-label">Uwagi:</label>
                    <textarea id="uwagi" class="form-control" name="uwagi"></textarea><br>
                </fieldset>
            </div>
            <div class="col-lg-4">
                <fieldset>
                    <legend>Osoby kontaktowe</legend>
                    <label for="kontakt_checkbox" class="form-label">Wybierz istniejący kontakt:</label>
                    <input type="checkbox" class="form-check-input" class="form-check-input" id="kontakt_checkbox" name="kontakt_checkbox" onclick="toggleKontaktFields()"><br>
                    
                    <div id="kontakt_select" style="display:none;">
                    <label for="kontakt" class="form-label">Wybierz osobę kontaktową:</label>
                    <select id="kontakt" class="form-select" name="kontakt">
                    <!-- Opcje zostaną załadowane dynamicznie -->
                    </select><br>
                    </div>
                    
                    <div id="kontakt_fields">
                    <label for="nowy_kontakt" class="form-label">Dodaj nową osobę kontaktową:</label><br>
                    <label for="imie_kontakt" class="form-label">Imię:</label>
                    <input type="text" class="form-control" id="imie_kontakt" name="imie_kontakt" data-req="req" required><br>
                    <label for="nazwisko_kontakt" class="form-label">Nazwisko:</label>
                    <input type="text" class="form-control" id="nazwisko_kontakt" name="nazwisko_kontakt" data-req="req" required><br>
                    <label for="mail_kontakt" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="mail_kontakt" name="mail_kontakt"><br>
                    <label for="telefon_kontakt" class="form-label">Telefon:</label>
                    <input type="tel" class="form-control" id="telefon_kontakt" name="telefon_kontakt"><br>
                    <label for="adres_kontakt" class="form-label">Adres:</label>
                    <textarea id="adres_kontakt" class="form-control" name="adres_kontakt"></textarea><br>
                    </div>
                </fieldset>
            </div>
            <div class="col-lg-4">
                <fieldset>
                    <legend>Opiekunowie</legend>
                    <label class="form-label" for="opiekun_checkbox">Dodaj nowego opiekuna:</label>
                    <input type="checkbox" class="form-check-input" class="form-check-input" id="opiekun_checkbox" name="opiekun_checkbox" onclick="toggleOpiekunFields()"><br>
                    
                    <div id="opiekun_select">
                    <label class="form-label" for="opiekun">Wybierz opiekuna:</label>
                    <select class="form-select" id="opiekun" name="opiekun">
                    <!-- Opcje zostaną załadowane dynamicznie -->
                    </select><br>
                    </div>
                    
                    <div id="opiekun_fields" style="display:none;">
                    <label class="form-label" for="nowy_opiekun">Dodaj nowego opiekuna:</label><br>
                    <label class="form-label" for="imie_opiekun">Imię:</label>
                    <input class="form-control" type="text" id="imie_opiekun" name="imie_opiekun" data-req="req"><br>
                    <label class="form-label" for="nazwisko_opiekun">Nazwisko:</label>
                    <input class="form-control" type="text" id="nazwisko_opiekun" name="nazwisko_opiekun" data-req="req"><br>
                    <label class="form-label" for="mail_opiekun">Email:</label>
                    <input class="form-control" type="email" id="mail_opiekun" name="mail_opiekun"><br>
                    <label class="form-label" for="telefon_opiekun">Telefon:</label>
                    <input class="form-control" type="tel" id="telefon_opiekun" name="telefon_opiekun"><br>
                    <label class="form-label" for="adres_opiekun">Adres:</label>
                    <textarea class="form-control" id="adres_opiekun" name="adres_opiekun"></textarea><br>
                    <label class="form-label" for="stanowisko_opiekun">Stanowisko:</label>
                    
                    <legend>Stanowisko</legend>
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
                    <input class="form-control" type="text" id="opiekun_nowe_stanowisko" name="opiekun_nowe_stanowisko" data-req="req"><br>
                    </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-lg-12">
                <fieldset class="row g-3">
                    <div class="col-lg-6">
                        <legend>Pakiety</legend>
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
                    </div>
                    <div class="col-lg-6">
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
                    </div>
                </fieldset>
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

                function toggleSprzedawcaFields() {
                var checkbox = document.getElementById('sprzedawca_checkbox');
                var sprzedawcaSelect = document.getElementById('sprzedawca_select');
                var sprzedawcaFields = document.getElementById('sprzedawca_fields');
                var requiredFields = sprzedawcaFields.querySelectorAll('[data-req="req"]');
                
                if (checkbox.checked) {
                    sprzedawcaSelect.style.display = 'none';
                    sprzedawcaFields.style.display = 'block';
                    requiredFields.forEach(function(field) {
                        field.setAttribute('required', 'required');
                    });
                } else {
                    sprzedawcaSelect.style.display = 'block';
                    sprzedawcaFields.style.display = 'none';
                    requiredFields.forEach(function(field) {
                        field.removeAttribute('required');
                    });
                    loadWorkers();
                }
                }

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

                // Załaduj pracowników, gdy strona się załaduje
                document.addEventListener('DOMContentLoaded', function() {
                    loadWorkers();
                    loadPakiety();
                    loadStanowiska();
                });

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
                
            </script>
            
            <input type="submit" class="btn btn-primary" value="Dodaj klienta">
        </form>
    </div>
</div>