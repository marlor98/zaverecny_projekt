<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Návštěvní kniha</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active"><a href="setup-database.php">Úvod</a>
                <li ><a href="index.php">Návštěvní kniha</a></li>
                <li ><a href="search.php">Vyhledávání</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h1 class="pull-left">Návštěvní kniha s databází</h1>
                    </div>
                   <div class="well well-lg">Tato návštěvní kniha umožňuje zobrazit data dle autora, přidat či smazat dotaz, upravit stávající dotazy v případě spamu nebo nevhodných výrazů, dále příspěvky v návštěvní knize dle zvoleného kritéria.</div>
                </div>
            </div>
            <div class="well alert alert-danger">Pokud databáze neexistuje, je možné ji vytvořit a naplnit daty pomocí níže uvedeného tlačítka.
            <a href="setup-database.php" class="btn btn-danger pull-right">Vytvořit databázi</a></div>

        </div>

    </div>



</body>
</html>
