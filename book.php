<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '6d27384d7aa2d515f1afd83b3fd5626ad89c80ab1fb1815d28e9e3a9f6592c20bbfe1573ac1fa4a2b84199a6aac5d47df3dbaa47d652e8361bb81480de976b9629840279fcf31f31abc9b710887ad009f7a6ce6dd1a5a6aa40c83e93f58759d56bcaec15151a4344399e71396819a73ea9d94afae257487ebd66ad38a669192d';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,        
            'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
            'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>SUPER BOOKS</title>
    </head>
    <body>
        <div class = "container">
            <h1 style = "padding-bottom: 20px;">SCRIPTURE BOOK LIST</h1>
            <div class = "row">
                <div class = "col-10">
                    <table class = "table">
                        <tr class = "table-info">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach ($books->data as $bookData) {
                            $book = $bookData->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookData->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>