<?php

error_reporting(E_ALL);
ini_set('display_error',1);
Header('Acess-Contro-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Acess-Control-Allow-Method: POST');

include_once('../../config/Database.php');
include_once('../../models/Donation.php');

$database = new Database();
$databaseConnection = $database->getConnection();
$donation = new Donation($databaseConnection);
$donationList  = $donation->getAllDonations();
if($donationList->rowCount()){
    $donations = [];
    while($row = $donationList->fetch(PDO::FETCH_OBJ)){
        print_r($row);
    }
}else{
    echo json_encode(['message'=> 'Não foi encontrado nenhuma doação']);
}