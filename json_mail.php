<?php

require 'db-connect.php';

if(isset($_GET['email'])){
    $query = $dbh->prepare("SELECT count(*) AS nb FROM customer WHERE customer_email = :customer_email");
    $query->execute(['customer_email' => $_GET['email']]);
    $customer = $query->fetch();

    echo json_encode($customer);
    exit;
}