    <header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">
            <h1><?php echo $config['title'] ?></h1>
          </div>
          <nav class="header__top__menu">
            <ul>
              <li><a href="/public_html/">Главная</a></li>
              <li><a href="/public_html/pages/about.php">Обо мне</a></li>
              <li><a href= <?php echo $config['sn_ssylka'] ?> target= _blank>Я в Facebook</a></li>
            </ul>
          </nav>
        </div>
      </div>
<?php
$categories_q=mysqli_query($connection, "select * from `articles_categories`");
$categories = array();
while($cat = mysqli_fetch_assoc($categories_q)){
$categories[] = $cat;	
}
?>

      <div class="header__bottom">
        <div class="container">
          <nav>
            <ul>
<?php 
foreach($categories as $cat)
{
?>
<li><a href="/public_html/pages/articles.php?categorie=<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?> </a></li>'
<?php
}
?>
            </ul>
          </nav>
        </div>
      </div>
    </header>