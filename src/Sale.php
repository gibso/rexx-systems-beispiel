<?php

/**
 * Interface Sale
 */
interface Sale
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return Customer
     */
    public function getCustomer();

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer);

    /**
     * @return float
     */
    public function getSaleAmount();

    /**
     * @param float $sale_amount
     */
    public function setSaleAmount($sale_amount);

    /**
     * @return DateTime
     */
    public function getSaleDate();

    /**
     * @param DateTime $sale_date
     */
    public function setSaleDate($sale_date);
}