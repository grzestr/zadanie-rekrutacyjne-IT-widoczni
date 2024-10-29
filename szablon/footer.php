<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
<?php if ($isddtable): ?>
    <script>
      //inicjalizacja DataTables dla wszystkich tabel z klasą dttable
        $(document).ready( function () {
          $('.dttable').each(function(){
            $(this).DataTable(
                {
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/2.1.8/i18n/pl.json"
                    }
                }
            )
          });
        } );
    </script>
<?php endif; ?>
  </body>
</html>
