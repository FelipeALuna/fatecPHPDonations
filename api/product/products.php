<?php

error_reporting(E_ALL);
ini_set('display_error',1);
Header('Acess-Contro-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Acess-Control-Allow-Method: POST');

include_once('../../config/Database.php');
include_once('../../models/Product.php');
$database = new Database();
$databaseConnection = $database->getConnection();
$product = new Product($databaseConnection);



if (isset($_GET['id'])) {
    $productRecord  = $product->getProductById($_GET['id']);

    if($productRecord->rowCount()){
        
        while($row = $productRecord->fetch(PDO::FETCH_ASSOC)){
            echo json_encode($row);
        } 

    }else{
           echo json_encode(["message"=> "Não foi encontrado nenhum produto"
        ]);
    }

}else{
    $productList  = $product->getAllProducts();
    if($productList->rowCount()){
        $products = [];
        while($row = $productList->fetch(PDO::FETCH_OBJ)){
            $products[$row->id] = [
                'id'=> $row->id,
                'description'=> $row->description,
                'name'=> $row->name,
                'quantity'=>$row->quantity,
                'created_at'=> $row->created_at,
                'updated_at'=> $row->updated_at
            ];
        }
        echo json_encode($products);
    }else{
        echo json_encode(["message"=> "Não foi encontrado nenhum produto"
        ]);
    } 
}

