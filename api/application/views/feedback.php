<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Feedback</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <?php $r= rand(0,9999); ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/feedback.css?v=<?=$r?>" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<h1>Formular de evaluare</h1>
<h3 style="text-align: left"><?=nl2br($eveniment->HeaderFeedback)?></h3>

<form method="POST" action="<?=base_url()?>index.php/feedback/save/<?=$eveniment->Id?>/<?=$medic->Id?>" onsubmit="return validateForm()">
    <div class="form-group">
        <label>Înregistrarea participanților la o manifestare EMC în funcție de calitatea fiecăruia:</label>
        <p>
            <label><input type="radio" name="Intrebare1" value="participant/cursant">participant/cursant</label>
        </p>
        <p>
            <label><input type="radio" name="Intrebare1" value="lucrare prezentată">lucrare prezentată</label>
        </p>
        <p>
            <label><input type="radio" name="Intrebare1" value="coordonator">coordonator</label>
        </p>
        <p>
            <label><input type="radio" name="Intrebare1" value="lector">lector</label>
        </p>
    </div>


    <div class="form-group">
        <label>1. Am invatat ceva in urma acestui eveniment:</label>
        <table width="500">
            <tr><td>
                  <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                      <tr>
                          <td class="tdpadding" width="33%">Da</td>
                          <td class="tdpadding" width="33%">Neutru</td>
                          <td class="tdpadding" align="right">Nu</td>
                      </tr>
                  </table>
            </td></tr>
            <tr><td>
                <table width="100%" border="1" cellpadding="2" cellspacing="2">
                    <tr>
                        <td class="tdpadding"><label><input type="radio" name="Intrebare2" value="1"> 1 </label></td>
                        <td class="tdpadding"><label><input type="radio" name="Intrebare2" value="2"> 2 </label></td>
                        <td class="tdpadding"><label><input type="radio" name="Intrebare2" value="3"> 3 </label></td>
                        <td class="tdpadding"><label><input type="radio" name="Intrebare2" value="4"> 4 </label></td>
                        <td class="tdpadding"><label><input type="radio" name="Intrebare2" value="5"> 5 </label></td>
                    </tr>
                </table>
            </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>2. Va schimba acest eveniment practica mea?</label>
        <table width="500">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare3" value="1"> 1 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare3" value="2"> 2 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare3" value="3"> 3 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare3" value="4"> 4 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare3" value="5"> 5 </label></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>


    <div class="form-group">
        <label>3. A fost evenimentul organizat bine?</label>
        <table width="500">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare4" value="1"> 1 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare4" value="2"> 2 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare4" value="3"> 3 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare4" value="4"> 4 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare4" value="5"> 5 </label></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>


    <div class="form-group">
        <label>4. Calitatea conținutului științific a fost?</label>
        <table width="500">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding" width="33%">Buna</td>
                            <td class="tdpadding" width="33%">Neutra</td>
                            <td class="tdpadding" align="right">Slaba</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare5" value="1"> 1 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare5" value="2"> 2 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare5" value="3"> 3 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare5" value="4"> 4 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare5" value="5"> 5 </label></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>5. Calitatea lectorilor a fost?</label>
        <table width="500">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding" width="33%">Buna</td>
                            <td class="tdpadding" width="33%">Neutra</td>
                            <td class="tdpadding" align="right">Slaba</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare6" value="1"> 1 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare6" value="2"> 2 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare6" value="3"> 3 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare6" value="4"> 4 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare6" value="5"> 5 </label></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>6. A fost adecvat locul de desfășurare a evenimentului?</label>
        <table width="500">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare7" value="1"> 1 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare7" value="2"> 2 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare7" value="3"> 3 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare7" value="4"> 4 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare7" value="5"> 5 </label></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>

    <div class="form-group">
        <label>7. Am simțit că evenimentul a fost părtinitor?</label>
        <table width="500">
            <tr><td>
                    <table width="100%"  border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding" width="33%">Da</td>
                            <td class="tdpadding" width="33%">Neutru</td>
                            <td class="tdpadding" align="right">Nu</td>
                        </tr>
                    </table>
                </td></tr>
            <tr><td>
                    <table width="100%" border="1" cellpadding="2" cellspacing="2">
                        <tr>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare8" value="1"> 1 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare8" value="2"> 2 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare8" value="3"> 3 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare8" value="4"> 4 </label></td>
                            <td class="tdpadding"><label><input type="radio" name="Intrebare8" value="5"> 5 </label></td>
                        </tr>
                    </table>
                </td></tr>
        </table>
    </div>


    <button type="submit" class="btn btn-primary">Trimite formular</button>
</form>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<script>
    function validateForm()
    {

        var intrebare1  = $("input[name='Intrebare1']:checked").length > 0;
        var intrebare2  = $("input[name='Intrebare2']:checked").length > 0;
        var intrebare3  = $("input[name='Intrebare3']:checked").length > 0;
        var intrebare4  = $("input[name='Intrebare4']:checked").length > 0;
        var intrebare5  = $("input[name='Intrebare5']:checked").length > 0;
        var intrebare6  = $("input[name='Intrebare6']:checked").length > 0;
        var intrebare7  = $("input[name='Intrebare7']:checked").length > 0;
        var intrebare8  = $("input[name='Intrebare8']:checked").length > 0;

        if( !intrebare1 || !intrebare2 || !intrebare3 || !intrebare4 || !intrebare5 || !intrebare6 || !intrebare7 || !intrebare8 )
            return return_error("Toate intrebarile sunt obligatorii!");

        return true;
    }

    function return_error(msg){
        swal( msg );
        return false;
    }

</script>
</body>
</html>