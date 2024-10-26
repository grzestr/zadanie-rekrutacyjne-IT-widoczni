<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj nowego klienta</title>
</head>
<body>
    <h1>Dodaj nowego klienta</h1>
    <form action="/index.php?action=addc" method="post" onsubmit="return validateForm()">
        <fieldset>
            <legend>Dane klienta</legend>
            <label for="nazwa">Nazwa:</label>
            <input type="text" id="nazwa" name="nazwa" required><br>
            <label for="strona">Strona:</label>
            <input type="url" id="strona" name="strona"><br>
            <label for="uwagi">Uwagi:</label>
            <textarea id="uwagi" name="uwagi"></textarea><br>
        </fieldset>
        
        <fieldset>
            <legend>Osoby kontaktowe</legend>
            <label for="kontakt_checkbox">Wybierz istniejący kontakt:</label>
            <input type="checkbox" id="kontakt_checkbox" name="kontakt_checkbox" onclick="toggleKontaktFields()"><br>
            
            <div id="kontakt_select" style="display:none;">
            <label for="kontakt">Wybierz osobę kontaktową:</label>
            <select id="kontakt" name="kontakt">
            <!-- Opcje zostaną załadowane dynamicznie -->
            </select><br>
            </div>
            
            <div id="kontakt_fields">
            <label for="nowy_kontakt">Dodaj nową osobę kontaktową:</label><br>
            <label for="imie_kontakt">Imię:</label>
            <input type="text" id="imie_kontakt" name="imie_kontakt" data-req="req" required><br>
            <label for="nazwisko_kontakt">Nazwisko:</label>
            <input type="text" id="nazwisko_kontakt" name="nazwisko_kontakt" data-req="req" required><br>
            <label for="mail_kontakt">Email:</label>
            <input type="email" id="mail_kontakt" name="mail_kontakt"><br>
            <label for="telefon_kontakt">Telefon:</label>
            <input type="tel" id="telefon_kontakt" name="telefon_kontakt"><br>
            <label for="adres_kontakt">Adres:</label>
            <textarea id="adres_kontakt" name="adres_kontakt"></textarea><br>
            </div>
        </fieldset>

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
        </script>
        
        <fieldset>
            <legend>Opiekunowie</legend>
            <label for="opiekun_checkbox">Dodaj nowego opiekuna:</label>
            <input type="checkbox" id="opiekun_checkbox" name="opiekun_checkbox" onclick="toggleOpiekunFields()"><br>
            
            <div id="opiekun_select">
            <label for="opiekun">Wybierz opiekuna:</label>
            <select id="opiekun" name="opiekun">
                <!-- Opcje zostaną załadowane dynamicznie -->
            </select><br>
            </div>
            
            <div id="opiekun_fields" style="display:none;">
            <label for="nowy_opiekun">Dodaj nowego opiekuna:</label><br>
            <label for="imie_opiekun">Imię:</label>
            <input type="text" id="imie_opiekun" name="imie_opiekun" data-req="req" required><br>
            <label for="nazwisko_opiekun">Nazwisko:</label>
            <input type="text" id="nazwisko_opiekun" name="nazwisko_opiekun" data-req="req" required><br>
            <label for="mail_opiekun">Email:</label>
            <input type="email" id="mail_opiekun" name="mail_opiekun"><br>
            <label for="telefon_opiekun">Telefon:</label>
            <input type="tel" id="telefon_opiekun" name="telefon_opiekun"><br>
            <label for="adres_opiekun">Adres:</label>
            <textarea id="adres_opiekun" name="adres_opiekun"></textarea><br>
            </div>
        </fieldset>
        
        <fieldset>
            <legend>Pakiety</legend>
            <label for="pakiet_checkbox">Dodaj nowy pakiet:</label>
            <input type="checkbox" id="pakiet_checkbox" name="pakiet_checkbox" onclick="togglePakietFields()"><br>
            
            <div id="pakiet_select">
            <label for="pakiet">Wybierz pakiet:</label>
            <select id="pakiet" name="pakiet">
            <!-- Opcje zostaną załadowane dynamicznie -->
            </select><br>
            </div>
            
            <div id="pakiet_fields" style="display:none;">
            <label for="nowy_pakiet">Dodaj nowy pakiet:</label><br>
            <label for="nazwa_pakiet">Nazwa:</label>
            <input type="text" id="nazwa_pakiet" name="nazwa_pakiet" data-req="req" required><br>
            <label for="cena_pakiet">Cena:</label>
            <input type="number" step="0.01" id="cena_pakiet" name="cena_pakiet"><br>
            <label for="czas_trwania_pakiet">Czas trwania (w miesiącach):</label>
            <input type="number" id="czas_trwania_pakiet" name="czas_trwania_pakiet" onchange="updatePakietDates()"><br>
            <label for="data_sprzedazy_pakiet">Data sprzedaży:</label>
            <input type="date" id="data_sprzedazy_pakiet" name="data_sprzedazy_pakiet" value="<?php echo date('Y-m-d'); ?>" readonly><br>
            <label for="data_wygasniecia_pakiet">Data wygaśnięcia:</label>
            <input type="date" id="data_wygasniecia_pakiet" name="data_wygasniecia_pakiet" readonly><br>
            </div>
        </fieldset>

        <script>
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

            // Załaduj pakiety, gdy strona się załaduje
            document.addEventListener('DOMContentLoaded', function() {
                loadPakiety();
            });

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

            function loadWorkers() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/index.php?action=getworkers', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var workers = JSON.parse(xhr.responseText);
                        var select = document.getElementById('opiekun');
                        select.innerHTML = ''; // Clear existing options
                        workers.forEach(function(worker) {
                            var option = document.createElement('option');
                            option.value = worker.id;
                            option.textContent = worker.imie + ' ' + worker.nazwisko + ' (' + worker.stanowisko + ')';
                            select.appendChild(option);
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
        
        <input type="submit" value="Dodaj klienta">
    </form>
</body>
</html>