<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Formular de inregistrare</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <?php
        $r= rand(0,9999);
    ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css?v=<?=$r?>" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <h1>Formular de înscriere</h1>

    <p>
        La înscriere va trebui să încărcați confirmarea plății (Ordinul de plată) sau adeverință care să justifice gratuitatea în format .PDF, .PNG, .JPEG sau .JPG
    </p>

    <form enctype="multipart/form-data" method="POST" action="<?=base_url()?>index.php/api/save/<?=$id_eveniment?>" onsubmit="return validateForm()">
        <div class="form-group">
            <label>Nume (obligatoriu)</label>
            <input type="text" class="form-control" placeholder="Ex: Ion" id="Nume" name="Nume" />
        </div>

        <div class="form-group">
            <label>Prenume (obligatoriu)</label>
            <input type="text" class="form-control" placeholder="Ex: Popescu" id="Prenume" name="Prenume" />
        </div>

        <div class="form-group">
            <label>Email (obligatoriu)</label>
            <input type="email" class="form-control" placeholder="Ex: ion@popescu.ro"  id="email" name="Email" />
        </div>

        <div class="form-group">
            <label>Telefon (obligatoriu)</label>
            <input type="text" class="form-control" placeholder="Ex: 0766.xxx.yyy"   id="Telefon" name="Telefon"/>
        </div>

        <div class="form-group">
            <label>Oraș (obligatoriu)</label>
            <input type="text" class="form-control" placeholder="Ex: Bucuresti"  id="Oras" name="Oras" />
        </div>

        <div class="form-group">
            <label>Categorie </label>
            <select name="IdCategorie" class="form-control">
                <?php foreach($categorii as $c){ ?>
                    <option value="<?=$c->Id?>"><?=$c->Nume?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Specialitate (doar pentru medici)</label>
            <input type="text" class="form-control" placeholder=""   id="Specialitate" name="Specialitate"/>
        </div>

        <div class="form-group">
            <label>CUIM</label>
            <input type="text" class="form-control" placeholder="" id="CUIM" name="CUIM"/>
        </div>

        <div class="form-group">
            <label>Plată transfer bancar</label>
            <p>Ordin de plată ( format pdf, png, jpeg sau jpg) </p>
            <input type="file" class="form-control" id="DovadaPlata"  name="DovadaPlata" accept=".pdf,.png,.jpeg,.jpg"  />
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox"  name="BifaAcord" id="BifaAcord">
                Sunt de acord să îmi trimiteți în mod expres, neechivoc, liber și informat consimțământul cu privire la prelucrarea datelor
                cu caracter personal pe care le-am furnizat.
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="BifaAcord2" id="BifaAcord2">
                Sunt de acord cu
                    <a href="<?=base_url()?>index.php/api/termene/<?=$id_eveniment?>">Termenele și condițiile, politica de folosire a cookie-urilor</a>
                si
                    <a href="<?=base_url()?>index.php/api/politica/<?=$id_eveniment?>">politica de prelucrare</a>
                a datelor cu caracter personal
            </label>
        </div>

        <button type="submit" class="btn btn-default" >Înscriere</button>
    </form>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <script>
        function validateForm()
        {

            var nume        = $("#Nume"          ).val();
            var prenume     = $("#Prenume"       ).val();
            var email       = $("#Email"         ).val();
            var oras        = $("#Oras"          ).val();
            var telefon     = $("#Telefon"       ).val();
            var dovada_plata= $("#DovadaPlata"   ).val();
            var bifa1       = $("#BifaAcord"     ).is(":checked");
            var bifa2       = $("#BifaAcord2"    ).is(":checked");

            if( nume         == "" ) return return_error("Numele este obligatoriu!");
            if( prenume      == "" ) return return_error("Prenumele este obligatoriu!");
            if( email        == "" ) return return_error("Emailul este obligatoriu!");
            if( telefon      == "" ) return return_error("Telefonul este obligatoriu!");
            if( oras         == "" ) return return_error("Orasul este obligatoriu!");
            if( dovada_plata == "" ) return return_error("Dovada platii este obligatorie!");
            if( !bifa1  ) return return_error("Bifa de acceptare este obligatorie!");
            if( !bifa2  ) return return_error("Bifa de acceptare a conditiilor este obligatorie!");

            return true;
        }

        function return_error(msg){
            swal( msg );
            return false;
        }
    </script>
</body>
</html>