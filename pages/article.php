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
<?php
 $article = mysqli_query($connection, "select * from `articles` where `art_id`=".(int)$_GET['id']);
?>
    <div id="content">
      <div class="container">
        <div class="row">
<?php
if (mysqli_num_rows($article) <= 0 )
{
?>
          <section class="content__left col-md-8">
            <div class="block">
              <h3>Статья не найдена</h3>
              <div class="block__content">
                <div class="full-text">
                  Запрашиваемая вами статья не существует!
                </div>
              </div>
            </div>
          </section>
<?php
}
else
{
?> 
         <section class="content__left col-md-8">
            <div class="block">
<?php $art=mysqli_fetch_assoc($article); 
mysqli_query($connection, "update `articles` set `views` = `views`+1 where `art_id`=".(int)$_GET['id']);
?>
<a>просмотров  <?php echo $art['views'] ?></a>
              <h3><?php echo $art['title'] ?></h3>
              <div class="block__content">
                <img src="/public_html/media/images/<?php echo $art['image']; ?>" style="max-width: 100%;">

                <div class="full-text">
                 <p><?php echo $art['text'] ?></p>
                </div>
              </div>
            </div>
            <div class="block">
	      <a href="#comment-add-form">Добавить свой комментарий</a>
              <h3>Комментарии</h3>
              <div class="block__content">
                <div class="articles articles__vertical">

                  <?php
$comments=mysqli_query($connection, "SELECT * FROM `comments` WHERE `articles_id`=".(int) $art['art_id']." order by `id_com` desc");

?>
<?php 
if (mysqli_num_rows($comments) <=0)
{
?>
		   <article class="article">
                      <p>К статье пока нет комментариев.</p>
                  </article>
<?php
}

else
{
while($comment=mysqli_fetch_assoc($comments))
{
?>
		   <article class="article">
<div><a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>">
                    <div class="article__image" style="background-image: url(../media/images/<?php echo $art['image']; ?>);"></div></a></div>
                    <div class="article__info">
                      <a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>"><?php echo $comment['author']; ?></a>
                      <div class="article__info__meta">
			                    <small>Статья: <a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>"><?php echo $art['title']; ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo $comment['text_com']; ?></div>
                    </div>
                  </article>
<?php
};
}
?>
                </div>
              </div>
            </div>
            <div class="block" id="comment-add-form">
              <h3>Добавить комментарий</h3>
              <div class="block__content">
                <form class="form" method="POST" action="article.php?id=<?php echo $art['art_id'];?>#comment-add-form">
<?php

if (isset($_POST['do_post']))
{
if ($_POST['name'] != "" && $_POST['nickname'] != "" && $_POST['email'] != "" && $_POST['text'] != "")
{
// echo "insert into `comments` (`author` , `text_com` , `articles_id`) values ('".$_POST['name']."','".$_POST['text']."','".$art['art_id']."')";
mysqli_query($connection, "insert into `comments` (`author` , `text_com` , `articles_id`) values ('".$_POST['name']."','".str_ireplace("'", "\'", strip_tags($_POST['text']))."','".$art['art_id']."')");
echo "<p>Комментарий вскоре появится в блоге</p>";
}
else
{
echo "<p>Проверьте, пожалуйста, форму и внесите данные в пустые ее поля</p>";
};
};
 ?>
                  <div class="form__group">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="text" class="form__control" required="" name="name" placeholder="Имя">
                      </div>
                      <div class="col-md-4">
                        <input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм">
                      </div>
                      <div class="col-md-4">
                        <input type="text" class="form__control" required="" name="email" placeholder="e-mail">
                      </div>
                    </div>
                  </div>
                  <div class="form__group">
                    <textarea name="text" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
                  </div>
                  <div class="form__group">
                    <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
                  </div>
                </form>
              </div>
            </div>
          </section>
<?php
}
?>


<?php include "./sidebar.php"?>
        </div>
      </div>
    </div>

    <?php include "./footer.php"?>

  </div>

</body>
</html>