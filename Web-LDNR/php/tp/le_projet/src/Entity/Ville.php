<?php

namespace  App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity
 */
class Ville
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", length=0, nullable=false)
     */
    private $nom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pop", type="integer", nullable=true)
     */
    private $pop;

    /**
     * @var int
     *
     * @ORM\Column(name="dept", type="integer", nullable=false)
     */
    private $dept;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPop(): ?int
    {
        return $this->pop;
    }

    public function setPop(?int $pop): self
    {
        $this->pop = $pop;

        return $this;
    }

    public function getDept(): ?int
    {
        return $this->dept;
    }

    public function setDept(int $dept): self
    {
        $this->dept = $dept;

        return $this;
    }


}
