<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$jmeno = $autor = $email = $obsah = $mesto = $psc = "";
$jmeno_err = $autor_err = $email_err = $obsah_err = $mesto_err = $psc_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_jmeno = trim($_POST["jmeno"]);
    if(empty($input_jmeno)){
        $jmeno_err = "Zadej jméno";
    } elseif(!filter_var($input_jmeno, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $jmeno_err = "Zadej spárvné jméno.";
    } else{
        $jmeno = $input_jmeno;
    }

    // Validate autor
    $input_autor = trim($_POST["autor"]);
    if(empty($input_autor)){
        $autor_err = "Zadej příjmení";
    } elseif(!filter_var($input_autor, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $autor_err = "Zadej správné příjmení.";
    } else{
        $autor = $input_autor;
    }

    // Validate address
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Zadej správnou adresu";
    } else{
        $email = $input_email;
    }

    // Validate salary
    $input_obsah = trim($_POST["obsah"]);
    if(empty($input_obsah)){
        $obsah_err = "Zadej čp";
    } elseif(!ctype_digit($input_obsah)){
        $obsah_err = "Zadej správné čp.";
    } else{
        $obsah = $input_obsah;
    }

    // Validate address
    $input_mesto = trim($_POST["mesto"]);
    if(empty($input_mesto)){
        $mesto_err = "Zadej správné město";
    } else{
        $mesto = $input_mesto;
    }

    // Validate salary
    $input_psc = trim($_POST["psc"]);
    if(empty($input_psc)){
        $psc_err = "Zadej PSČ";
    } elseif(!ctype_digit($input_psc)){
        $psc_err = "Zadej správné PSČ";
    } else{
        $psc = $input_psc;
    }

    // Check input errors before inserting in database
    if(empty($jmeno_err) && empty($autor_err) && empty($email_err) && empty($obsah_err) && empty($mesto_err) && empty($psc_err)){

        // Prepare an update statement
        $sql = "UPDATE zakaznici SET jmeno=?, autor=?, email=?, obsah=?, mesto=?, psc=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_jmeno, $param_autor, $param_email, $param_obsah, $param_mesto, $param_psc, $param_id);

            // Set parameters
            $param_jmeno = $jmeno;
            $param_autor = $autor;
            $param_email = $email;
            $param_obsah = $obsah;
            $param_mesto = $mesto;
            $param_psc = $psc;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM zakaznici WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $jmeno = $row["jmeno"];
                    $autor = $row["autor"];
                    $email = $row["email"];
                    $obsah = $row["obsah"];
                    $mesto = $row["mesto"];
                    $psc = $row["psc"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aktualizace záznamů</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li ><a href="popis.php">Úvod</a>
                <li ><a href="index.php">Zákazníci</a></li>
                <li ><a href="search.php">Vyhledávání</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Aktualizace záznamů</h2>
                    </div>
                    <p>Upravte vstupní hodnoty a odešlete k aktualizaci záznamů.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($jmeno_err)) ? 'has-error' : ''; ?>">
                            <label>Jméno</label>
                            <input type="text" name="jmeno" class="form-control" value="<?php echo $jmeno; ?>">
                            <span class="help-block"><?php echo $jmeno_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($autor_err)) ? 'has-error' : ''; ?>">
                            <label>Přijmení</label>
                            <input type="text" name="autor" class="form-control" value="<?php echo $autor; ?>">
                            <span class="help-block"><?php echo $autor_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($obsah_err)) ? 'has-error' : ''; ?>">
                            <label>Číslo popisné</label>
                            <input type="text" name="obsah" class="form-control" value="<?php echo $obsah; ?>">
                            <span class="help-block"><?php echo $obsah_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($mesto_err)) ? 'has-error' : ''; ?>">
                            <label>Město</label>
                            <input type="text" name="mesto" class="form-control" value="<?php echo $mesto; ?>">
                            <span class="help-block"><?php echo $mesto_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($psc_err)) ? 'has-error' : ''; ?>">
                            <label>PSČ</label>
                            <input type="text" name="psc" class="form-control" value="<?php echo $psc; ?>">
                            <span class="help-block"><?php echo $psc_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
