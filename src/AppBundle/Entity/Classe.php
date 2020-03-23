<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity
 */
class Classe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nbrMax", type="integer", nullable=false)
     */
    private $nbrmax;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_classe", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Coursactivite", inversedBy="idClasse")
     * @ORM\JoinTable(name="classecoursactivite",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_classe", referencedColumnName="id_classe")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_cours", referencedColumnName="id_cours")
     *   }
     * )
     */
    private $idCours;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCours = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

