<?php

// https://rapidapi.com/blog/how-to-use-an-api-with-php/

// API - https://rapidapi.com/contextualwebsearch/api/web-search

define('API_HOST', 'contextualwebsearch-websearch-v1.p.rapidapi.com');
define('API_KEY', 'e66e7ed45emsha78ad6de48c42a4p1385abjsn5554431feb6d');

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query_fields = [
        'autoCorrect' => 'true',
        'pageNumber' => 1,
        'pageSize' => 10,
        'safeSearch' => 'false',
        'q' => $_GET['query']
    ];

    $url = 'https://contextualwebsearch-websearch-v1.p.rapidapi.com/api/search/NewsSearchAPI';
    $url .= '?' . http_build_query($query_fields);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "x-rapidapi-host: " . API_HOST,
		"x-rapidapi-key: " . API_KEY
    ]);

    $response = json_decode(curl_exec($curl), true);
    
    $news = $response['value'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Notícias</title>
</head>
<body>
    <form action="" method="get">
        <label for="query">Insira um termo para buscar notícias relacionadas:</label>
        <input id="query" name="query" type="text"><br>
        <button type="submit" name="submit">Pesquisar</button><br><br>
    </form>

    <?php
        if(!empty($news)) {
            $html = "<b>Notícias relacionadas a sua consulta:</b>";
            foreach ($news as $post) {
                $html .= "<h3>{$post['title']}</h3>";
                $html .= "<a href='{$post['url']}'>Fonte</a>";
                $html .= "<p>Data de publicação:{$post['datePublished']}</p>";
                $html .= "<p>{$post['body']}</p>";
                $html .= "<hr>";
            }
            echo $html;
        }
    ?>

</body>
</html>