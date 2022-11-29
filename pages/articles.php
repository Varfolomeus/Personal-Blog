<?PHP
require "../includes_1/config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'] ?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="../media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="../media/css/style.css">
</head>
<body>

  <div id="wrapper">
<?php include "./header.php"?>
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a href="/public_html/pages/articles.php?categorie=<?php echo $_GET['categorie'] ?>&lp=2#article-add-form">Добавить статью</a>
              <h3>Все статьи рубрики</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
                <?php
                  $cat_idd =(int) $_GET['categorie'];
                  // $cat_idd = mb_substr($_GET['categorie'], 0, 1, 'utf-8');
                  // echo "SELECT * FROM `articles`, `articles_categories` WHERE `articles`.category_id=".$_GET['categorie']." and `articles`.category_id = `articles_categories`.id order by `art_id` desc";

                  $page = 1;
                  if (isset($_GET['page'])){
                  $page = (int) $_GET['page'];
                  };

                  $total_art_per_cat=mysqli_query($connection, "SELECT count('art_id') as 'total_art_per_cat' FROM `articles`, `articles_categories` WHERE `articles`.category_id=".(int) $_GET['categorie']." and `articles`.category_id = `articles_categories`.id order by `art_id` desc");

                  $total_artpercat = mysqli_fetch_assoc($total_art_per_cat);
                  $total_artpercat = $total_artpercat['total_art_per_cat'];

                  $total_pagescat = ceil($total_artpercat / $perpage);
                  if ($page <= 1 || $page > $total_pagescat){
                  $page = 1;
                  };
                  $offset = 0;
                  if ($page != 0){
                  $offset = ($perpage*$page)-$perpage;
                  };
                  $articles=mysqli_query($connection, "SELECT * FROM `articles`, `articles_categories` WHERE `articles`.category_id=".(int) $_GET['categorie']." and `articles`.category_id = `articles_categories`.id order by `art_id` desc limit $offset,$perpage");
                  if (mysqli_num_rows($articles) <=0)
                  {
                  ?>
                        <article class="article">
                            <small>В Категории пока еще нет статей</small>
                        </article>
                  <?php
                  }
                  ?>
                  <?php 
                  while($art=mysqli_fetch_assoc($articles))
                  {
                  ?>
                    <article class="article">
                    <div><a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>">
                      <div class="article__image" style="background-image: url(../media/images/<?php echo $art['image']; ?>);"></div></a></div>
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
              <?php 
              if (mysqli_num_rows($articles)>0){
              echo '<div class "block">';
                if ($page > 1)
                {
                echo '<br><a href="./articles.php?categorie='.$cat_idd.'&page='.($page-1).'" >&laquo; Предыдущая страница</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                if ($page < $total_pagescat && ($page+1) <= $total_pagescat)
                {
                echo '<a href="./articles.php?categorie='.$cat_idd.'&page='.($page+1).'">Следующая страница &raquo</a>';
                }
              echo '</div>';
              };
              ?>
            </div>

            <div class="block" id="article-add-form">
              <h3>Добавить статью в блог</h3>
              <div class="block__content">
                <form class="form" method="POST" action="articles.php?categorie=
<?php echo $_GET['categorie'];
echo "&page=";
echo $page;
?>&lp=2#article-add-form" enctype = "multipart/form-data">
<?php
if (isset($_POST['do_post']))
{
if ($_POST['name'] != "" && $_POST['item'] != "" && $_POST['rubr_id'] != "Выберите рубрику" && $_POST['text'] != "")
{
// echo "insert into `articles` (`title` , `category_id` , `text`) values ('".$_POST['item']."','".$_POST['rubr_id']."','".$_POST['text']."')";

foreach($categories as $cat)
{
if ($cat['id']==$_POST['rubr_id']){
$cat_img = $cat['category_icon'];
break;
}
};
if($_FILES['narticle_image']['name']==''){
  $uploadfilename = $cat_img;
} else {$uploadfilename= 'upl_'.date('d-m-Y-H.i.s').$_FILES['narticle_image']['name'];
  move_uploaded_file($_FILES['narticle_image']['tmp_name'],'../media/images/'.$uploadfilename);
}
mysqli_query($connection, "insert into `articles` (`title` , `category_id` , `text`, `image`) values ('".str_ireplace("'", "\'", strip_tags($_POST['item']))."','".$_POST['rubr_id']."','".str_ireplace("'", "\'", strip_tags($_POST['text']))."','".$uploadfilename."')");
// echo "<p>";
// var_dump($_FILES);
// echo "</p>";
echo "<p>Статья вскоре появится в блоге</p>";
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
                        <input type="text" class="form__control" required="" name="item" placeholder="Тема статьи">
                      </div>
                      <div class="col-md-4">
			<select name="rubr_id">
			<option selected="selected">Выберите рубрику</option>
<?php
foreach($categories as $cat)
{
?>
			<option value="<?php echo $cat['id'] ;?>"><?php echo $cat['category_name'];?></option>
<?php } ?>

			</select></p>
                      </div>
                    </div>
                  </div>
                  <div class="form__group">
                    <textarea name="text" required="" class="form__control" placeholder="Текст статьи ..."></textarea>
                  </div>
                  <div class="form__group"> <span class="block__content">При желании можно добавить илюстрацию к статье</span>
                    <input type="file" class="form__control" name="narticle_image">
                    <input type="submit" class="form__control" name="do_post" value="Добавить статью">
                  </div>
                </form>
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