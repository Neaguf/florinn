<html>
  <head>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <style>
      @page {
  size: 21cm 29.7cm;
  /* margin: 30mm 45mm 30mm 45mm; */
  margin: 0mm;
}
* {
  font-size: 13px;
}
.idFactura {
  outline-style: solid;
  outline-color: black;
}
.block {
  margin: 40px;
  outline-style: solid;
  outline-color: black;
  padding: 20px;
  height: 1329px;
}
.dateParti {
  text-align: left;
}
table,
th,
td {
  border: 1px solid black;
  padding: 5px;
}
table {
  margin-top: 20px;
  margin-left: 300px;
}
h2 {
  font-weight: 600;
}
table tbody {
  vertical-align: middle;
  text-align: left;
}

    </style>
  </head>
  <body>
    <div class="block">
      <div class="row">
        <div class="col">
          <p class="dateParti">
            <b> Firma</b> <br />
            Nr.reg.com: <br />
            CUi: RO3149318 <br />

            IBAN:<br />
            Banca: <br />
            IBAN:<br />
            Banca: <br />
          </p>
        </div>
        <div class="col" style="text-align: center">
          <h2>
            FACTURA <br />
            FISCALA
          </h2>
          <br />
          <p class="idFactura">
            Nr. factura: <?= $Factura->Id; ?>

            <br />
            Data: <?= $Factura->Data; ?>
            <br />
            Comanda: <br />
          </p>
          <p><br /></p>
          <img
            src="https://cdn.logo.com/hotlink-ok/logo-social.png"
            width="250px"
          />
          <!-- ??? -->
        </div>
        <div class="col"></div>
      </div>

      <table>
        <thead>
          <th style="width: 5px">Nr. Crt.</th>
          <th style="width: 40%">Denumirea produselor / serviciilor</th>
          <th>U.M.</th>
          <th>Cant.</th>
          <th>Pret unitar (lei)</th>
          <th>Valoare (lei)</th>
          <th>Val. TVA (lei)</th>
        </thead>

        <tbody>
            <!-- <tr>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            </tr> -->
            <?php $totalProduse = 0;?>
          <?php foreach($Produse as $index => $produs) { 
            $totalProduse += $produs->Valoare;
            ?>
            <tr>
            <td><?= $index + 1; ?></td>
            <td><?= $produs->NumeProdus; ?></td>
            <td>Buc</td>
            <td><?= $produs->Cantitate ?></td>
            <td><?= $produs->Pret ?></td>
            <td><?= $produs->Valoare ?></td>
            <td><?= $produs->Valoare*0.19 ?></td>
            </tr>

          <?php } ?>
          
          
        </tbody>

        

        <tfoot style="bottom: 0">
          <tr>
            <td
              colspan="1"
              rowspan="3"
              style="text-align: left; vertical-align: baseline"
            >
              Semnatura si stampila furnizorului
            </td>
            <td colspan="3" rowspan="3">
              <p>
                Intocmit de: CNP: - <br />
                Numele delegatului: - <br />

                Semnaturile: <br />
              </p>
            </td>
            <td>Total</td>
            <td colspan="2"><?= $totalProduse  ?></td>
          </tr>
       
          <tr>
            <td colspan="3">Semnaturi de primire:</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
<style></style>
<script type="text/javascript">
  window.print();
</script> -->
  </body>
</html>
