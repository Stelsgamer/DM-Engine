<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $this->config['description'] ?>"/>
  <link href="/public/images/favicon.svg" rel="icon" type="image/svg+xml" />
  <script src="/public/scripts/jquery.js"></script>
</head>

<body>
    <?php echo $content; ?>
  <script src="/public/scripts/form.js"></script>
</body>
</html>