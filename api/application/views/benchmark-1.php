<!DOCTYPE html>
<html lang="ro">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="3mYQao7n038tSQ8jTAcVBK41FBqqTvmxFLMfgHEJ">
      <meta http-equiv='cache-control' content='no-cache'>
      <meta http-equiv='expires' content='0'>
      <meta http-equiv='pragma' content='no-cache'>
      <title>Tezaur AmanetOnline - Magazie bijuterii</title>
      
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


      <style>
         .page-header {
         background: #fff;
         }
      </style>
      
   </head>
   <!-- UPDATE CHROME EXTENSION VERSION -->
   <script>
      window.addEventListener('message', function (app) {
      if (app.data.version != undefined && app.data.version) {
      $('#client-ver').html(' | Client v' + app.data.version);
      }
      });
      
      /** Ajax interval request for updating the pending transfers count in header */
      
   </script>
   <body >
      
    <table class="table table-striped table-bordered dataTable table-grey">
        <thead class="header">
            <tr style="margin-top:0px;">
                <th><input type="checkbox" class="select-all-items"></th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.id" data-how="asc" >Cod</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.name" data-how="asc" >Nume</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.price_type" data-how="asc" >Tip aur</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.karataj" data-how="asc" >Carataj</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.weight" data-how="asc" >Aur cantarit (g)</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.weight14" data-how="asc" >Aur 14k (g)</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.price_in" data-how="asc" >Pret intrare (lei)</th>
                <th>Pret vanzare (fara TVA) (lei)</th>
                <th>Pret vanzare original</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.contract_number" data-how="asc" >Contract</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="client_name" data-how="asc" >Client</th>
                <th>Masura</th>
                <th>Carataj Diamant</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.tag" data-how="asc" >Eticheta</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="cicles" data-how="asc" >Rotiri</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="agency_cicles" data-how="asc" >Agentii rotiri</th>
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="time_on_sale" data-how="asc" >Luni in piata</th>
                <th>Discount</th>
                <th >Documente</th>
                <th>Imagini</th> 
                <th class="sortable sorting" data-url="https://amanet.tezaur.org/inventory/jewel-inventory-sale-index" data-field="ord" data-col="inventory.tv_slideshow" data-how="asc" >TV</th>
            </tr>
        </thead>
        <tbody id="contentArea" class="clusterize-content">
            <form method="POST" action="https://amanet.tezaur.org" accept-charset="UTF-8" class="form-horizontal" id="jewel-sale-form">
                <input name="_token" type="hidden" value="3mYQao7n038tSQ8jTAcVBK41FBqqTvmxFLMfgHEJ">
                <input type="hidden" name="type" value="1" >
                <?php for($i=0; $i < 1700; $i++){ ?>
                <tr>
                    <td>
                    <input type="checkbox" name="jewel_items[378738]" value="378738"
                        data-weight="0.80"
                        data-weight14="0.80"
                        data-pricein="81.00"
                        data-priceout="135.29"
                        class="item-checkbox">
                    </td>
                    <td>378738</td>
                    <td class="text-left">
                    cercei
                    </td>
                    <td class="text-left">Normal</td>
                    <td >14K</td>
                    <td class="text-right">0.80</td>
                    <td class="text-right">0.80</td>
                    <td class="text-right">81.00</td>
                    <td class="text-right">135.29</td>
                    <td class="text-right">159.66</td>
                    <td><a href="https://amanet.tezaur.org/contracts/show/2135861">C5719000008</a></td>
                    <td class="text-left">
                    ADAMACHI LILIANA-NUTI 
                    <thin style="color:darkgrey">(2700720450026)</thin>
                    </td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="">online</td>
                    <td>1</td>
                    <td>
                    <span class="block" data-toggle="tooltip" title="Mega Mall_2" style="width:100%">
                    1
                    </span>
                    </td>
                    <td>1</td>
                    <td>15%</td>
                    <td class="">
                    <a href="javascript:;" class="resource-item" data-itemid="378738" data-type="doc">
                    <i class="fa fa-picture-o"></i>
                    </a>
                    </td>
                    <td> <a href="https://amanet.tezaur.org/inventory/add-images/378738/1?standard=1&backUrl=https%3A%2F%2Famanet.tezaur.org%2Finventory%2Fjewel-inventory-sale-index%3Fagency%255B%255D%3D65%26area%3D%26export%3D0%26filter_trigger%3D1"
                    data-toggle="tooltip" title="Adauga/Modifica imagini" class="pull-left">
                    <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                    </a>
                    <a href="javascript:;" class="resource-item" data-itemid="378738" data-type="image">
                    <i class="fa fa-picture-o"></i>
                    </a>
                    <a data-img="thumb4019326" class="image-popup-jewel margin-left-5" data-url="https://amanet.tezaur.org/common/get-contract-image?id=4019326" href="javascript:void(0);"><i class="glyphicon glyphicon-camera"></i></a>
                    </td>
                    <td><input type="checkbox" class="tv_broadcast" name="tv_broadcast[]" value="378738" ></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
        <tr>
        <td>Total:</td>
        <td colspan="4"></td>
        <td id="total-weight" class="text-right"> 0.00</td>
        <td id="total-weight14" class="text-right"> 0.00</td>
        <td id="total-pricein" class="text-right"> 0.00</td>
        <td id="total-priceout" class="text-right"> 0.00</td>
        <td colspan="24"></td>
        </tr>
        </tfoot>
        </table>

   </body>
</html>