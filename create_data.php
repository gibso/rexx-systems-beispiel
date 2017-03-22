<?php

require_once "bootstrap.php";

/**
 * INSERT INTO customer VALUES (1, 'female', 'Dagmar', 'Bösel');
 * INSERT INTO customer VALUES (2, 'male', 'Dietmar', 'Maier');
 * INSERT INTO customer VALUES (3, 'female', 'Sabine', 'Kanter');
 */

$customers_data = [
    0 => [
        'gender' => 'female',
        'firstname' => 'Dagmar',
        'lastname' => 'Bösel'
    ],
    1 => [
        'gender' => 'male',
        'firstname' => 'Dietmar',
        'lastname' => 'Maier'
    ],
    2 => [
        'gender' => 'female',
        'firstname' => 'Sabine',
        'lastname' => 'Kanter'
    ]
];

foreach ($customers_data as $customer_data){
    $customer = new Customer();
    $customer->setGender($customer_data['gender']);
    $customer->setFirstname($customer_data['firstname']);
    $customer->setLastname($customer_data['lastname']);

    $entityManager->persist($customer);
    $entityManager->flush();

    echo "Created Customer with ID " . $customer->getId() . "\n";
}

/**
 * INSERT INTO sales1 VALUES (1, 3, 14.40, '2007-04-02 11:37:06');
 * INSERT INTO sales1 VALUES (2, 1, 28.30, '2007-05-14 11:37:18');
 * INSERT INTO sales1 VALUES (3, 2, 34.40, '2007-05-06 11:38:14');
 * INSERT INTO sales1 VALUES (4, 2, 25.60, '2007-05-07 11:38:39');
 */

$customerRepository = $entityManager->getRepository('Customer');

$sales1_data = [
    0 => [
        'customerId' => 3,
        'saleAmount' => 14.40,
        'saleDate' => '2007-04-02 11:37:06'
    ],
    1 => [
        'customerId' => 1,
        'saleAmount' => 28.30,
        'saleDate' => '2007-05-14 11:37:18'
    ],
    2 => [
        'customerId' => 2,
        'saleAmount' => 34.40,
        'saleDate' => '2007-05-06 11:38:14'
    ],
    3 => [
        'customerId' => 2,
        'saleAmount' => 25.60,
        'saleDate' => '2007-05-07 11:38:39'
    ]
];

foreach ($sales1_data as $sales1_date){

    $customer = $customerRepository->find($sales1_date['customerId']);
    if (!$customer){
        throw new Exception('Could not find Customer with ID: ' . $sales1_date['customerId']);
    }

    $sale1 = new Sale1();
    $sale1->setCustomer($customer);
    $sale1->setSaleAmount($sales1_date['saleAmount']);
    $sale1->setSaleDate(new DateTime($sales1_date['saleDate']));

    $entityManager->persist($sale1);
    $entityManager->flush();

    echo "Created Sale1 with ID " . $sale1->getId() . "\n";
}

/**
 * INSERT INTO sales2 VALUES (1, 2, 68.20, '2007-04-06 11:37:06');
 * INSERT INTO sales2 VALUES (2, 3, 21.30, '2007-04-12 11:37:18');
 * INSERT INTO sales2 VALUES (3, 3, 54.40, '2007-05-06 11:38:14');
 * INSERT INTO sales2 VALUES (4, 1, 35.70, '2007-05-07 11:38:39');
 */

$sales2_data = [
    0 => [
        'customerId' => 2,
        'saleAmount' => 68.20,
        'saleDate' => '2007-04-06 11:37:06'
    ],
    1 => [
        'customerId' => 3,
        'saleAmount' => 21.30,
        'saleDate' => '2007-04-12 11:37:18'
    ],
    2 => [
        'customerId' => 3,
        'saleAmount' => 54.40,
        'saleDate' => '2007-05-06 11:38:14'
    ],
    3 => [
        'customerId' => 1,
        'saleAmount' => 35.70,
        'saleDate' => '2007-05-07 11:38:39'
    ]
];

foreach ($sales2_data as $sales2_date){

    $customer = $customerRepository->find($sales2_date['customerId']);
    if (!$customer){
        throw new Exception('Could not find Customer with ID: ' . $sales2_date['customerId']);
    }

    $sale2 = new Sale2();
    $sale2->setCustomer($entityManager->getRepository('Customer')->find($sales2_date['customerId']));
    $sale2->setSaleAmount($sales2_date['saleAmount']);
    $sale2->setSaleDate(new DateTime($sales2_date['saleDate']));

    $entityManager->persist($sale2);
    $entityManager->flush();

    echo "Created Sale2 with ID " . $sale2->getId() . "\n";
}