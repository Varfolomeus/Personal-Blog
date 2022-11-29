          <section class="content__right col-md-4">
            <div class="block">
              <h3>Коротко о погоде!</h3>
              <div class="block__content">
<div id="SinoptikInformer" style="width:240px;" class="SinoptikInformer type1c1"><div class="siHeader"><div class="siLh"><div class="siMh"><a onmousedown="siClickCount();" class="siLogo" href="https://sinoptik.ua/" target="_blank" rel="nofollow" title="Погода"> </a>Погода <span id="siHeader"></span></div></div></div><div class="siBody"><a onmousedown="siClickCount();" href="https://sinoptik.ua/погода-николаев" title="Погода в Николаеве" target="_blank"><div class="siCity"><div class="siCityName"><span>Николаев</span></div><div id="siCont0" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT0"></div><div id="weatherIco0"></div></div><div class="siInf"><p>влажность: <span id="vl0"></span></p><p>давление: <span id="dav0"></span></p><p>ветер: <span id="wind0"></span></p></div></div></div></a><div class="siLinks">Погода на 10 дней от <a href="https://sinoptik.ua/погода-николаев/10-дней" title="Погода на 10 дней" target="_blank" onmousedown="siClickCount();">sinoptik.ua</a></div></div><div class="siFooter"><div class="siLf"><div class="siMf"></div></div></div></div><script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=3&amp;cities=303017267&amp;lang=ru"></script>
<br>
<!-- Gismeteo informer START -->
<link rel="stylesheet" type="text/css" href="https://www.gismeteo.ua/assets/flat-ui/legacy/css/informer.min.css">
<div id="gsInformerID-537u5pQgEV6qyQ" class="gsInformer" style="width:200px;height:239px">
    <div class="gsIContent">
        <div id="cityLink">
            <a href="https://www.gismeteo.ua/weather-mykolaiv-4983/" target="_blank" title="Погода в Николаеве">
                <img src="https://www.gismeteo.ua/assets/flat-ui/img/gisloader.svg" width="24" height="24" alt="Погода в Николаеве">
            </a>
            </div>
        <div class="gsLinks">
            <table>
                <tr>
                    <td>
                        <div class="leftCol">
                            <a href="https://www.gismeteo.ua/" target="_blank" title="Погода">
                                <img alt="Погода" src="https://www.gismeteo.ua/assets/flat-ui/img/logo-mini2.png" align="middle" border="0" width="11" height="16" />
                                <img src="https://www.gismeteo.ua/assets/flat-ui/img/informer/gismeteo.svg" border="0" align="middle" style="left: 5px; top:1px">
                            </a>
                            </div>
                            <div class="rightCol">
                                <a href="https://www.gismeteo.ua/weather-mykolaiv-4983/2-weeks/" target="_blank" title="Погода в Николаеве на 2 недели">
                                    <img src="https://www.gismeteo.ua/assets/flat-ui/img/informer/forecast-2weeks.ru.svg" border="0" align="middle" style="top:auto" alt="Погода в Николаеве на 2 недели">
                                </a>
                            </div>
                        </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script async src="https://www.gismeteo.ua/api/informer/getinformer/?hash=537u5pQgEV6qyQ"></script>
<!-- Gismeteo informer END -->
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
<div><a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>">
                    <div class="article__image" style="background-image: url(/public_html/media/images/<?php echo $art['image']; ?>);"></div></a></div>
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
<div><a href="/public_html/pages/article.php?id=<?php echo $art['art_id']; ?>">
                    <div class="article__image" style="background-image: url(/public_html/media/images/<?php echo $art['image']; ?>);"></div></a></div>
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