<?php

namespace AnalyzerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BankEntity
 *
 * @ORM\Table(name="bank_entity")
 * @ORM\Entity(repositoryClass="AnalyzerBundle\Repository\BankEntityRepository")
 */
class BankEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_bank_entity", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idBankEntity;

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
     * @var \BankType
     * @ORM\ManyToOne(targetEntity="BankType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bank_type", referencedColumnName="id_bank_type", nullable=false)
     * })
     */
    private $idType;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->idBankEntity;
    }

    public function getidBankEntity() {
        return $this->idBankEntity;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return BankEntity
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
     * @return BankEntity
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

    public function setIdBankType($idBankType){
        $this->idBankType = $idBankType;
        return $this;
    }

    public function getIdBankType(){
        return $this->idBankType;
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

