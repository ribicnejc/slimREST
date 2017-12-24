<?php

//use \Psr\Http\Message\ServerRequestInterface as Request;
//use \Psr\Http\Message\ResponseInterface as Response;

use Slim\Http\Request;
use Slim\Http\Response;


$app = new \Slim\App;

// Get All Customers
$app->get('/api/customers', function (Request $request, Response $response) {
    $sql = "SELECT * FROM customers";

    try {
        // Get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($customers);


    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});


// Get Single customer
$app->get('/api/customer/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute("id");

    $sql = "SELECT * FROM customers WHERE id = $id";

    try {
        // Get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($customer);


    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Add Customer
$app->post('/api/customer/add', function (Request $request, Response $response) {
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam("last_name");
    $phone = $request->getParam("phone");
    $email = $request->getParam("email");
    $address = $request->getParam("address");
    $city = $request->getParam("city");
    $state = $request->getParam("state");

    $sql = "INSERT INTO customers (first_name, last_name, phone, email, address, city, state)
    VALUES (:first_name, :last_name, :phone, :email, :address, :city, :state)";

    try {
        // Get DB Object
        $db = new db();
        //Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);

        $stmt->execute();

        echo '{"notice": {"text": "Customer Added"}}';

    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});
