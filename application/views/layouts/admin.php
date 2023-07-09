<!doctype html>
<html lang="ru" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/public/styles/main.css" rel="stylesheet">
  <link rel="shortcut icon" href="/public/images/favicon.svg" type="image/x-icon">
  <title><?php echo $title ?></title>
  <link rel="prefetch prerender" href="/public/images/logo.svg" />
</head>
<body class="h-full bg-main text-text">
  <!--<div class="flex min-h-full justify-center">
     <div class="w-full sm:w-3/4 md:w-1/2 p-4">
        <div class="mx-auto w-1/4">
          <img src="/public/images/logo.svg" alt="LOGO">
        </div>
        <div class="mt-6 mb-12 text-center">
            <h1 class="font-semibold text-5xl text-blue">DEEPMIND Engine</h1>
        </div> 
    </div> 
  </div>-->
  <?php echo $content; ?>

  <script src="/public/scripts/jquery.js"></script>
  <script src="/public/scripts/install.js"></script>
</body>
</html>