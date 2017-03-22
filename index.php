<?php

require_once "doctrine/bootstrap.php";

if ($_POST['fromDate'] and $_POST['toDate']) {

    $fromDate = new \DateTime($_POST['fromDate']);
    $toDate = new \DateTime($_POST['toDate']);
    $file = fopen('customers.csv', 'w');
    fputcsv($file, ['customer_id', 'customer_name', 'sales_count', 'sales_sum', 'sales_date']);

    /** @var Customer[] $allCustomers */
    $allCustomers = $entityManager->getRepository('Customer')->findAll();
    foreach ($allCustomers as $customer) {
        $sales = $customer->getSalesBetweenDates($entityManager, $fromDate, $toDate);

        if (!empty($sales)) {
            $salesSum = 0;
            $lastSaleDate = null;

            foreach ($sales as $sale) {
                $salesSum += $sale->getSaleAmount();

                if ($lastSaleDate < $sale->getSaleDate() or $lastSaleDate === null) {
                    $lastSaleDate = $sale->getSaleDate();
                }
            }

            fputcsv($file, [
                $customer->getId(),
                $customer->getName(),
                sizeof($sales),
                $salesSum,
                $lastSaleDate->format('d.m.Y')
            ]);
        }
    }

    fclose($file);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="customers.csv";');
    readfile('customers.csv');

    exit;
}

require 'template.html';
