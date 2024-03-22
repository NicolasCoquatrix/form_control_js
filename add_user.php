<?php

if(isset($_POST['hidden_submit'])){
    require 'db-connect.php';
    $query = $dbh->prepare('INSERT INTO customer (customer_email, customer_password, customer_lastname, customer_firstname) VALUES (:customer_email, :customer_password, :customer_lastname, :customer_firstname)');
    $query->execute([
        'customer_email' => strtolower($_POST['email']),
        'customer_password' => password_hash($_POST['password1'], PASSWORD_DEFAULT),
        'customer_lastname' => strtoupper($_POST['lastname']),
        'customer_firstname' => ucfirst($_POST['firstname'])
    ]);
    $customerId = $dbh->lastInsertId();

    $query = $dbh->query("SELECT * FROM customer WHERE customer_id = $customerId");
    $customer = $query->fetch();

    session_start();
    $_SESSION['name'] = $customer['customer_firstname'] . " " . $customer['customer_lastname'];
}

header("location: /");