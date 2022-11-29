<?PHP
require "includes_1/config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'] ?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="media/css/style.css">
</head>
<body>

  <div id="wrapper">
<?php include "pages/header.php"?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a href="/public_html/pages/articles.php?categorie=1">Все записи</a>
              <h3>Новейшее в блоге</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
<?php
$articles=mysqli_query($connection, "SELECT * FROM `articles`, `articles_categories` WHERE `articles`.category_id = `articles_categories`.id order by `art_id` desc limit 10");
?>
<?php 
while($art=mysqli_fetch_assoc($articles))
{
?>
		   <article class="article">
<div><a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>">
		    <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div></a></div>
                    <div class="article__info">
                      <a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">
			<small>Категория: <a href="/public_html/pages/articles.php?categorie=<?php echo $art['id']; ?>"><?php echo $art['category_name']; ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr($art['text'], 0, 70, 'utf-8'); ?> ...</div>
                    </div>
                  </article>
<?php
}
?>
               </div>
              </div>
            </div>
<?php 
foreach($categories as $cat)
{
$cat_list = $cat['id'];
$cat_namelist = $cat['category_name']
?>
            <div class="block">
              <a href="/public_html/pages/articles.php?categorie= <?php echo $cat_list;?>">Все записи</a>
              <h3><?php echo $cat_namelist?> [Новейшее]</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
<?php
$articles=mysqli_query($connection, "SELECT * FROM `articles`, `articles_categories` WHERE `articles`.category_id =$cat_list and `articles`.category_id = `articles_categories`.id order by `art_id` desc limit 10");
?>
{
<?php 
{
if (mysqli_num_rows($articles) <=0)
{
?>
		   <article class="article">
                    <small>В Категории пока еще нет статей</small>
                  </article>
<?php
}
else
{
while($art=mysqli_fetch_assoc($articles))
{
print_r($art);
?>
		   <article class="article">
<div><a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>">
                    <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div></a></div>
                    <div class="article__info">
                      <a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">
			<small>Категория: <a href="/public_html/pages/articles.php?categorie=<?php echo $art['id']; ?>"><?php echo $art['category_name']; ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr($art['text'], 0, 70, 'utf-8'); ?> ...</div>
                    </div>
                  </article>
<?php
};
};
}
?>
                </div>
              </div>
            </div>
<?php }?>



          </section>
<?php include "pages/sidebar.php"?>
        </div>
      </div>
    </div>
<?php include "pages/footer.php"?>


  </div>

</body>
</html>