<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Návštěvní kniha</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 50px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
        }
    </style>

</head>
<body>

<div class="wrapper fadeInDown">
    <h1>Přihlašovací obrazovka</h1>
  <div id="formContent">
    <form action>
      <input type="text" id="login" name="login" placeholder="Uživatelské jméno">
      <input type="text" id="password" name="login" placeholder="Heslo">
      <a href="about.php">
      <input type="submit" class="fadeIn fourth btn" value="Přihlásit se">
    </a>
    </form>

  </div>
</div>

</body>
</html>
