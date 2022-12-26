<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="<?=base_url()?>assets/codemirror/lib/codemirror.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>assets/codemirror/lib/codemirror.css">
    <script src="<?=base_url()?>assets/codemirror/mode/sql/sql.js"></script>

    <title>Tezaur - upload prod</title>

    <style>
        body{
            padding: 25px;
        }
        .CodeMirror {
            border: 1px solid #eee;
            height: auto;
        }

    </style>
  </head>
  <body>
    <h1>Upload productie</h1>

    <a class='btn btn-primary' href="<?=base_url()?>index.php/UpdateProd/startTransfer">Upload pe productie</a><br/>

    <div>
            <form method="POST" action="">
                <label>Query ce va fi executat la transfer</label>
                <textarea class='form-control' id='content_query' name="content_query" style="display: block;" cols="90" rows="4"></textarea>
                <input type="hidden" name="flag" value="set"/>
                <input style='margin-top:5px;' class='btn btn-success' type="submit" value="Adauga Query"/>
            </form>
        </div>
        <div>
            <h2 style='margin-top:25px'>Lista query-uri ce vor fi executate:</h2>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Query</th>
                    <th>Actiuni</th>
                </tr>
                <?php foreach($queryuriDeExecutat as $q){ ?>
                        <tr>
                            <td><?=$q->Id?></td>
                            <td><?=$q->Query?></td>
                            <td>
                                <button class='btn btn-danger' onclick="stergeQuery(<?=$q->Id?>)">Sterge</button>
                            </td>
                        </tr>
                <?php } ?>
            </table>
        </div>
        <script>
            function stergeQuery(id) {
                var xhttp = new XMLHttpRequest();
                xhttp.addEventListener("load", function(){ 
                    location.reload(); 
                });
                xhttp.open("GET", "<?=base_url()?>index.php/intretinere/sterge_query/"+id, true);
                xhttp.send();
            }
        </script>
        <script>
            var myTextarea = document.getElementById("content_query");
            var editor = CodeMirror.fromTextArea(myTextarea, {
                lineNumbers: true
            });
            </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>