<?php

namespace AnalyzerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoanType
 *
 * @ORM\Table(name="loan_type")
 * @ORM\Entity(repositoryClass="AnalyzerBundle\Repository\LoanTypeRepository")
 */
class LoanType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_loan_type", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idLoanType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->idLoanType;
    }

    public function getidLoanType(){
        return $this->idLoanType;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return LoanType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return LoanType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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

    public function __toString() {
        return $this->name;
    }
}

