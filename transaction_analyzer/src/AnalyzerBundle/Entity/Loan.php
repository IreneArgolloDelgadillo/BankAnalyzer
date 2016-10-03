<?php

namespace AnalyzerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loan
 *
 * @ORM\Table(name="loan")
 * @ORM\Entity(repositoryClass="AnalyzerBundle\Repository\LoanRepository")
 */
class Loan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_loan", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idLoan;

    /**
     * @var float
     *
     * @ORM\Column(name="benefit", type="float")
     */
    private $benefit;

    /**
     * @var string
     *
     * @ORM\Column(name="currencyType", type="string", length=255)
     */
    private $currencyType;

    /**
     * @var \LoanType
     * @ORM\ManyToOne(targetEntity="LoanType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_loan_type", referencedColumnName="id_loan_type", nullable=false)
     * })
     */
    private $idType;

    /**
     * @var \BankEntity
     * @ORM\ManyToOne(targetEntity="BankEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bank_entity", referencedColumnName="id_bank_entity", nullable=false)
     * })
     */
    private $idBankEntity;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->idLoan;
    }

    public function getidLoan(){
        return $this->idLoan;
    }
    /**
     * Set benefit
     *
     * @param float $benefit
     *
     * @return Transaction
     */
    public function setBenefit($benefit)
    {
        $this->benefit = $benefit;

        return $this;
    }

    /**
     * Get benefit
     *
     * @return float
     */
    public function getBenefit()
    {
        return $this->benefit;
    }

    /**
     * Set currencyType
     *
     * @param string $currencyType
     *
     * @return Transaction
     */
    public function setCurrencyType($currencyType)
    {
        $this->currencyType = $currencyType;

        return $this;
    }

    /**
     * Get currencyType
     *
     * @return string
     */
    public function getCurrencyType()
    {
        return $this->currencyType;
    }

    public function setIdBankEntity($idBankEntity){
        $this->idBankEntity = $idBankEntity;
        return $this;
    }
    
    public function getIdBankEntity(){
        return $this->idBankEntity;
    }

    public function setIdLoanType($idLoanType){
        $this->idLoanType = $idLoanType;
        return $this;
    }   

    public function getIdLoanType(){
        return $this->idLoanType;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
    }
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
          $this->$property = $value;
        }
        return $this;
    }
    public function __call($name, $arguments){
        echo "Llamando al método de objeto '$name' "
            . implode(', ', $arguments). "\n";
    }
}

