<?php
    use App\Models\NewsArticle;

    include_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';

    if(!empty($_GET['a'])) {
        $selected_article = (new NewsArticle())->article($_GET['a']);
    } else  {
        $news_articles = new NewsArticle();
    }
