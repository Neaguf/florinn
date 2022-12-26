<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .table{
            width: 100%;
        }
        .text-center{
            text-align: center;
        }
        .rand{
            font-size: 12px;
        }
        .header th:nth-child(8), .header th:nth-child(9){
            text-align: right;
        }
        .rand td:nth-child(8), .rand td:nth-child(9){
            text-align: right;
        }
        .subtotal-categorie{
            background-color: lightcyan;
        }
        .subtotal-subcategorie{
            background-color: lightyellow;
        }
    </style>

    <title>Raport cheltuieli</title>
</head>
<body>
    <h1 class="text-center">Raport cheltuieli - subcategorii</h1>
    <h2 class="text-center"> <?=$data_start?> - <?=$data_end?> </h2>

    <table class="table" border="1" cellspacing="0" cellpadding="2">

        <thead>
            <tr class="header">
                <?php foreach($header as $hc){ ?>
                     <th><?=$hc?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($raport as $tc){ ?>
                <?php foreach($tc->Subcategorii as $s) { ?>
                    <?php foreach($s->Raport as $row ){ ?>
                        <tr>
                            <td><?=$tc->Nume?></td>
                            <td><?=$s->Nume?></td>
                            <td><?=$row->DataCreare?> </td>
                            <td><?=$row->Firma?></td>
                            <td><?=$row->Alias?></td>
                            <td><?=$row->Utilizator?></td>
                            <td><?=$row->Explicatie?></td>
                            <?php foreach($valute as $v) { ?>
                                <td align="right"><?=$row->Total[$v->Nume]?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                        <tr class="subtotal-subcategorie">
                            <td colspan="7">Total '<?=$s->Nume?>'</td>
                            <?php foreach($valute as $v) { ?>
                                <td align="right"><?=$s->Total[$v->Nume]?></td>
                            <?php } ?>
                        </tr>
                <?php } ?>
                <?php if( !$tc->AreZeroCheltuieli ) { ?>
                    <tr class="subtotal-categorie">
                        <td colspan="7" >Total  '<?=$tc->Nume?>'</td>
                        <?php foreach($valute as $v) { ?>
                            <td align="right"><?=$tc->Total[$v->Nume]?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>

    </table>
</body>
</html>