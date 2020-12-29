<?php


// https://rapidapi.com/blog/how-to-use-an-api-with-php/

// API - https://rapidapi.com/lordkada1/api/kvstore

define('API_HOST', 'kvstore.p.rapidapi.com');
define('API_KEY', 'e66e7ed45emsha78ad6de48c42a4p1385abjsn5554431feb6d');

// 1 - Faça uma solicitação POST para que a API crie uma coleção de dados.
// 2 - Faça uma solicitação GET onde usaremos o nome da coleção da primeira etapa, demonstrando assim as solicitações GET e o fato de que a coleção foi criada.
// 3 - Faça uma solicitação PUT onde substituímos o objeto modificado e demonstramos a resposta.
// 4 - Faça uma solicitação DELETE com o nome da coleção e mostre a resposta.
// 5 - Faça uma solicitação GET com o nome da coleção novamente para mostrar que o método DELETE funcionou e que não há coleção com esse nome.


// |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

// signUp("", "");

// 1
// createCollection('MyCollection');

// 2 && 5
getCollection('MyCollection');

// 3
// $data = ['public_write' => true];
// updateCollection('MyCollection', $data);

// 4
// deleteCollection('MyCollection');


// 1 ---------------------------------------------------------------------------------------------------------------------------
function createCollection(string $collectionName)
{
  $url = 'https://kvstore.p.rapidapi.com/collections';
  $data = [
    'collection' => $collectionName
  ];

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "X-RapidAPI-Host: " . API_HOST,
    "X-RapidAPI-Key: " . API_KEY,
    "content-type: application/json"
  ]);

  $response = curl_exec($curl);

  if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
    $output["message"] = "Colecao criada com sucesso!";
    $output["status"] = "ok";
  } else if (isset(json_decode($response)->status) && json_decode($response)->status == 'error') {
    $output = json_decode($response);
  } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 429) {
    $output["message"] = json_decode($response)->message;
    $output["status"] = "error";
  }

  curl_close($curl);

  echo json_encode($output);
}

// 2 ---------------------------------------------------------------------------------------------------------------------------
function getCollection(string $collectionName)
{
  $url = 'https://kvstore.p.rapidapi.com/collections';
  $url .= '/' . $collectionName;

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "X-RapidAPI-Host: " . API_HOST,
    "X-RapidAPI-Key: " . API_KEY,
    "content-type: application/json"
  ]);


  $response = curl_exec($curl);
  curl_close($curl);

  var_dump(json_decode($response));
}

// 3 ---------------------------------------------------------------------------------------------------------------------------
function updateCollection(string $collectionName, array $dataFields)
{
  $url = 'https://kvstore.p.rapidapi.com/collections';
  $url .= '/' . $collectionName;

  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => json_encode($dataFields),
    CURLOPT_HTTPHEADER => [
      "content-type: application/json",
      "x-rapidapi-host: " . API_HOST,
      "x-rapidapi-key: " . API_KEY
    ],
  ]);

  $response = curl_exec($curl);

  if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
    $output["message"] = "Colecao atualizada com sucesso!";
    $output["status"] = "ok";
  } else if (isset(json_decode($response)->status) && json_decode($response)->status == 'error') {
    $output = json_decode($response);
  } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 429) {
    $output["message"] = json_decode($response)->message;
    $output["status"] = "error";
  }

  curl_close($curl);

  echo json_encode($output);
}

// 4 ---------------------------------------------------------------------------------------------------------------------------
function deleteCollection(string $collectionName) {
  $url = 'https://kvstore.p.rapidapi.com/collections';
  $url .= '/' . $collectionName;

  $curl = curl_init($url);
  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => [
      "content-type: application/json",
      "x-rapidapi-host: " . API_HOST,
      "x-rapidapi-key: " . API_KEY
    ]
  ]);

  $response = curl_exec($curl);

  if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
    $output["message"] = "Colecao deletada com sucesso!";
    $output["status"] = "ok";
  } else if (isset(json_decode($response)->status) && json_decode($response)->status == 'error') {
    $output = json_decode($response);
  } else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 429) {
    $output["message"] = json_decode($response)->message;
    $output["status"] = "error";
  }

  curl_close($curl);

  echo json_encode($output);
}

// 5 ---------------------------------------------------------------------------------------------------------------------------

// SignUp ---------------------------------------------------------------------------------------------------------------------------
function signUp(string $email, string $password)
{
  $url = 'https://kvstore.p.rapidapi.com/users';

  $data = [
    'email' => $email,
    'password' => $password
  ];

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'X-RapidAPI-Host: ' . API_HOST,
    'X-RapidAPI-Key: ' . API_KEY,
    'Content-Type: application/json'
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}
