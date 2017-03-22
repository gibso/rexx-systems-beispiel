<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * CREATE TABLE customer (
 * customer_id mediumint(8) unsigned NOT NULL auto_increment,
 * gender enum('female','male','') NOT NULL,
 * firstname varchar(50) NOT NULL,
 * lastname varchar(50) NOT NULL,
 * PRIMARY KEY (customer_id)
 * );
 *
 * @ORM\Entity
 * @ORM\Table(name="customer")
 **/
class Customer
{
    const GENDER_FEMALE = 'female';
    const GENDER_MALE = 'male';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('female', 'male', '') NOT NULL")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getName(){

        $name = '';
        if ($this->gender === Customer::GENDER_FEMALE){
            $name .= 'Frau ';
        }
        if ($this->gender === Customer::GENDER_MALE){
            $name .= 'Herr ';
        }

        return $name . $this->getFirstname() . ' ' . $this->getLastname();
    }

    /**
     * @param EntityManager $entityManager
     * @return Sale[]
     */
    public function getSalesBetweenDates(EntityManager $entityManager, DateTime $fromDate, DateTime $toDate)
    {
        $sales1Qb = $entityManager->getRepository('Sale1')->createQueryBuilder('sale1');
        $sales2Qb = $entityManager->getRepository('Sale2')->createQueryBuilder('sale2');

        $sales1Qb->where('sale1.sale_date BETWEEN :fromDate AND :toDate')
            ->setParameter('fromDate', $fromDate->format('Y-m-d'))
            ->setParameter('toDate', $toDate->format('Y-m-d'))
        ->andWhere('sale1.customer = ' . $this->getId());
        $sales2Qb->where('sale2.sale_date BETWEEN :fromDate AND :toDate')
            ->setParameter('fromDate', $fromDate->format('Y-m-d'))
            ->setParameter('toDate', $toDate->format('Y-m-d'))
            ->andWhere('sale2.customer = ' . $this->getId());

        $sales1 = $sales1Qb->getQuery()->getResult();
        $sales2 = $sales2Qb->getQuery()->getResult();

        return array_merge($sales1, $sales2);
    }
}