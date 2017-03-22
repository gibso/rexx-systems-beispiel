<?php

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * CREATE TABLE sales1 (
 * sale_id mediumint(8) unsigned NOT NULL auto_increment,
 * customer_id mediumint(8) unsigned NOT NULL,
 * sale_amount decimal(10,2) NOT NULL,
 * sale_date datetime NOT NULL,
 * PRIMARY KEY (sale_id)
 * );
 *
 * @ORM\Entity
 * @ORM\Table(name="sales1")
 */
class Sale1 implements Sale
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;


    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $sale_amount;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $sale_date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getSaleAmount()
    {
        return $this->sale_amount;
    }

    /**
     * @param mixed $sale_amount
     */
    public function setSaleAmount($sale_amount)
    {
        $this->sale_amount = $sale_amount;
    }

    /**
     * @return DateTime
     */
    public function getSaleDate()
    {
        return $this->sale_date;
    }

    /**
     * @param mixed $sale_date
     */
    public function setSaleDate($sale_date)
    {
        $this->sale_date = $sale_date;
    }
}