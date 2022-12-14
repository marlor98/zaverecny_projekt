<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$autor = $email = $obsah = "";
$autor_err = $email_err = $obsah_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Check input errors before inserting in database
    if(empty($autor_err) && empty($email_err) && empty($obsah_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO navstevnikniha (autor, email, obsah) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_autor, $param_email, $param_obsah);

            // Set parameters
            $param_autor = $autor;
            $param_email = $email;
            $param_obsah = $obsah;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vytvoření záznamu</title>
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
                <li ><a href="index.php">Návštěvní kniha</a></li>
                <li ><a href="search.php">Vyhledávání</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Vytvoření vzkazu do návštěvní knihy</h2>
                    </div>
                    <p>
                        Prosím vyplňte tento formulář, aby mohl být Váš vzkaz přidán do návštěvní knihy
                    </p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
