<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Feedback PDF</title>
    <style>
        body{
            font-size:12px;
        }
        .checked{
            border: 1px solid blue;
            margin: 2px;
            font-weight:bold;
        }
        td{
            padding-left: 2px;
            padding-right: 2px;
        }
        td .checked{
            text-align: center;
        }
        .top-table{
            margin-bottom: 10px;
        }
        label{
            font-weight:bold;
            margin-top: 10px;
        }

    </style>
</head>
<body>

<h1>Formular de feedback</h1>
<h2><?=$eveniment->Denumire?></h2>

<form method="POST" action="<?=base_url()?>index.php/feedback/save/<?=$eveniment->Id?>/<?=$medic->Id?>" onsubmit="return validateForm()">
    <div class="form-group">
        <label>Înregistrarea participanților la o manifestare EMC în funcție de calitatea fiecăruia:</label>
        <div style="width: 500px">
            <ul>
                <li>
                    <p class="<?= $f->Intrebare1 == 'particpant/cursant' ? 'checked' : '' ?>">participant/cursant</p>
                </li>
                <li>
                    <p class="<?= $f->Intrebare1 == 'lucrare prezentată' ? 'checked' : '' ?>">lucrare prezentată</p>
                </li>
                <li>
                    <p class="<?= $f->Intrebare1 == 'coordonator' ? 'checked' : '' ?>">coordonator</p>
                </li>
                <li>
                    <p class="<?= $f->Intrebare1 == 'lector' ? 'checked' : '' ?>">lector</p>
                </li>
            </ul>
        </div>
    </div>


    <div class="form-group">
        <label>1. Am invatat ceva in urma acestui eveniment:</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare2 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare2 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare2 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare2 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare2 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>2. Va schimba acest eveniment practica mea?</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare3 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare3 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare3 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare3 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare3 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>


    <div class="form-group">
        <label>3. A fost evenimentul organizat bine?</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare4 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare4 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare4 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare4 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare4 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>


    <div class="form-group">
        <label>4. Calitatea conținutului științific a fost?</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare5 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare5 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare5 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare5 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare5 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>5. Calitatea lectorilor a fost?</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare6 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare6 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare6 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare6 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare6 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>6. A fost adecvat locul de desfășurare a evenimentului?</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare7 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare7 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare7 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare7 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare7 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>7. Am simțit că evenimentul a fost părtinitor?</label>
        <table width="500" class="top-table">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tdpadding"><p class="<?= $f->Intrebare8 == '1' ? 'checked' : '' ?>">1</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare8 == '2' ? 'checked' : '' ?>">2</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare8 == '3' ? 'checked' : '' ?>">3</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare8 == '4' ? 'checked' : '' ?>">4</p></td>
                            <td class="tdpadding"><p class="<?= $f->Intrebare8 == '5' ? 'checked' : '' ?>">5</p></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

</form>

</body>
</html>