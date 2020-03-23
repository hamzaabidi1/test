<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Garde
 *
 * @ORM\Table(name="garde", indexes={@ORM\Index(name="Id_Enfant", columns={"Id_Enfant"}), @ORM\Index(name="id_parent", columns={"id_parent"})})
 * @ORM\Entity
 */
class Garde
{
    /**
     * @var string
     *
     * @ORM\Column(name="Type_garde", type="string", length=255, nullable=false)
     */
    private $typeGarde;

    /**
     * @var string
     *
     * @ORM\Column(name="Heure_debut_Garde", type="string", length=50, nullable=false)
     */
    private $heureDebutGarde;

    /**
     * @var string
     *
     * @ORM\Column(name="Heure_fin_Garde", type="string", length=50, nullable=false)
     */
    private $heureFinGarde;

    /**
     * @var string
     *
     * @ORM\Column(name="Date_Garde", type="string", length=255, nullable=false)
     */
    private $dateGarde;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=false)
     */
    private $statut;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Enfant
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Enfant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Enfant", referencedColumnName="id_enfant")
     * })
     */
    private $idEnfant;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="Id")
     * })
     */
    private $idParent;


}

