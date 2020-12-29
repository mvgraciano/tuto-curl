<?php

// ---------- REQUEST SIMPLES ----------

// $curl = curl_init();
// curl_setopt($curl, CURLOPT_URL, 'http://www.google.com/search?q=termo');
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HEADER, false);
// $resp = curl_exec($curl);
// curl_close($curl);
// echo $resp;


// ---------------------------------------------------------------------------
// ---------- REQUEST SIMPLES E GRAVAÇÃO DE RETORNO EM FILE ----------

// $curl = curl_init();
// $url = 'https://www.php.net/';

// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// $result = curl_exec($curl);
// curl_close($curl);
// $file = fopen('content.txt', 'w');
// file_put_contents('content.txt', $result);
// fclose($file);


// ---------------------------------------------------------------------------
// ---------- REQUEST E EXIBIÇÃO DAS IMAGENS CONTIDAS EM RESULT ATRAVÉS DE REGEX ----------

$search_string = "pilha";
$url = "https://ricopecas.com.br/?s={$search_string}&post_type=product";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

preg_match_all("!https:\/\/imagesrico.s3.sa-east-1.amazonaws.com\/[^\s]*?-300x300.jpg!", $result, $matches);

$images = array_values(array_unique($matches[0]));
for ($i=0; $i < count($images); $i++) { 
    echo "<div style='float: left; margin: 10 0 0 0;'>";
    echo "<img src='{$images[$i]}'><br />";
    echo "</div>";
}
curl_close($curl);


// ---------------------------------------------------------------------------
// ---------- CONSUMINDO API ----------

// $url = "https://www.canalti.com.br/api/pokemons.json";
// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// $pokemonList = json_decode(curl_exec($curl));
// curl_close($curl);

// foreach ($pokemonList->pokemon as $pokemon) {
//     $html  = "<div style='background-color: #eee'>";
//     $html .= "  {$pokemon->num} - {$pokemon->name}<br>";
//     $html .= "  Type: " . implode(", ", $pokemon->type) . ".<br>";
//     $html .= "  Weaknesses: " . implode(", ", $pokemon->weaknesses) . ".<br>";
//     if (isset($pokemon->prev_evolution)) {
//         $html .= "  Prev Evolution(s):";
//         $html .= "  <ul>";
//         foreach ($pokemon->prev_evolution as $prev_evolution) {
//             $html .= "<li> {$prev_evolution->num} - {$prev_evolution->name}</li>";
//         }
//         $html .= "  </ul>";
//     }
//     if (isset($pokemon->next_evolution)) {
//         $html .= "  Next Evolution(s):";
//         $html .= "  <ul>";
//         foreach ($pokemon->next_evolution as $next_evolution) {
//             $html .= "<li> {$next_evolution->num} - {$next_evolution->name}</li>";
//         }
//         $html .= "  </ul>";
//     }
//     $html .= "  <p></p>";
//     $html .= "</div>";
//     echo $html;
// }

// var_dump($pokemonList->pokemon[1]);
