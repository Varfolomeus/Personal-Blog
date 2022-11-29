          <section class="content__right col-md-4">
            <div class="block">
              <h3>Мы знаем</h3>
              <div class="block__content">
                <script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=02op3nb0crr&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
              </div>
            </div>

            <div class="block">
              <h3>Топ читаемых статей</h3>
              <div class="block__content">
                <div class="articles articles__vertical">

                  <?php
$articles=mysqli_query($connection, "SELECT * FROM `articles`, `articles_categories` WHERE `articles`.category_id = `articles_categories`.id order by `views` desc limit 5");
?>
<?php 
while($art=mysqli_fetch_assoc($articles))
{
?>
		   <article class="article">
                    <div class="article__image" style="background-image: url(/public_html/media/images/<?php echo $art['image']; ?>);"></div>
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

            <div class="block">
              <h3>Комментарии</h3>
              <div class="block__content">
                <div class="articles articles__vertical">

                  <?php
$articles=mysqli_query($connection, "SELECT * FROM `comments`, `articles` WHERE `comments`.articles_id = `articles`.art_id order by `articles`.views desc limit 5");
?>
<?php 
while($art=mysqli_fetch_assoc($articles))
{
?>
		   <article class="article">
                    <div class="article__image" style="background-image: url(/public_html/media/images/<?php echo $art['image']; ?>);"></div>
                    <div class="article__info">
                      <a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>"><?php echo $art['author']; ?></a>
                      <div class="article__info__meta">
			<small>Статья: <a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>"><?php echo $art['title']; ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr($art['text_com'], 0, 70, 'utf-8'); ?> ...</div>
                    </div>
                  </article>
<?php
}
?>
                </div>
              </div>
            </div>
          </section>