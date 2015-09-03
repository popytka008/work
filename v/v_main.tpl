<!DOCTYPE html >
<html>
<head>
  <meta charset="utf-8" />
  <title><?=$title?></title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript">

  </script>
</head>
<body>
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
