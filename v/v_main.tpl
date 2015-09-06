<!DOCTYPE html >
<html>
<head>
  <meta charset="UTF-8"/>
  <title><?=$title?></title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <script src="js/jquery-1.11.3.js"></script>
  <script src="js/bootstrap.js"></script>
  <script type="text/javascript">

  </script>
</head>
<body>

<?=$header?>

<div class="container">
  <div class="row">
    <div class="span8">
      <?=$menu?>

      <div class="logo">
        <h1><?=$title?></h1>
      </div>

      <?=$content?>

      <?=$footer?>
    </div>
  </div>
</body>
</html>
