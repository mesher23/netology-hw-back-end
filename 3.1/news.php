<?php

class CommentClass
{
    public $comment;

    function __construct($commentPOST)
    {
        # Код который записывет коментарий в БД
    }

    private static function dataBaseConnect()
    {
        $arrayCommetJson = file_get_contents('./news_json/commet_news.json');
        $arrayCommet = json_decode($arrayCommetJson, true);
        return $arrayCommet;
    }

    public static function getComment($id)
    {
        $dataBaseCommet = self::dataBaseConnect();
        foreach ($dataBaseCommet as $key => $data) {
            if ($key === $id) {
                return $data;
            }
        }
    }
}

class PostNewsClass
{
    public $news;
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    private static function dataBaseNews()
    {
        $arrayNewsJson = file_get_contents('./news_json/news.json');
        $arrayNews = json_decode($arrayNewsJson);
        return $arrayNews;
    }

    public function printNews()
    {
        $comment = CommentClass::getComment($this->id);
        $arrayNews = self::dataBaseNews();
        echo '<div><h1>' . $arrayNews->{$this->id}->h1 . '</h1>';
        echo '<p class="commit">Commet: ' . $comment . '</p>';
        echo '<p>' . $arrayNews->{$this->id}->p1 . '</p>';
        echo '<p>' . $arrayNews->{$this->id}->p2 . '</p></div>';
    }
}
