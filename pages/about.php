<?PHP
require "../includes_1/config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'] ?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/public_html/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/public_html/media/css/style.css">
</head>
<body>

  <div id="wrapper">

    <?php include "./header.php"?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <h1>Обо мне... Кратко....</h1>
              <div class="block__content">
                <img src="/public_html/media/images/garden.jpg">

                <div class="full-text">
<h1>Классный сайт</h1>

<p>Классный сайт</p>

<h2>Классный сайт</h2>
<p>Классный сайт</p>

<h2>Классный сайт</h2>
<p>Классный сайт</p>

<p>Классный сайт</p>

<h2>Классный сайт</h2>
<p>Классный сайт</p>
                </div>
              </div>
            </div>
          </section>
<?php include "./sidebar.php"?>
        </div>
      </div>
    </div>

    <?php include "./footer.php"?>

  </div>

</body>
</html>