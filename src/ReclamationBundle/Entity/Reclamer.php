<?php

namespace ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamer
 *
 * @ORM\Table(name="reclamer", indexes={@ORM\Index(name="Id_Staff", columns={"Id_Staff", "id_parent"}), @ORM\Index(name="id_parent", columns={"id_parent"}), @ORM\Index(name="IDX_E56F8A99945CFFF0", columns={"Id_Staff"})})
 * @ORM\Entity
 */
class Reclamer
{
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=false)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     */
    private $date;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="nom_reclamation", type="string", length=255, nullable=false)
     */
    private $nomReclamation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_reclamation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="Id")
     * })
     */
    private $idParent;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Staff", referencedColumnName="Id")
     * })
     */
    private $idStaff;

    /**
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return  new \DateTime($this->date);
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {

        $this->date = $date->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getNomReclamation()
    {
        return $this->nomReclamation;
    }

    /**
     * @param string $nomReclamation
     */
    public function setNomReclamation($nomReclamation)
    {
        $this->nomReclamation = $nomReclamation;
    }

    /**
     * @return int
     */
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    /**
     * @param int $idReclamation
     */
    public function setIdReclamation($idReclamation)
    {
        $this->idReclamation = $idReclamation;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * @param \AppBundle\Entity\User $idParent
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getIdStaff()
    {
        return $this->idStaff;
    }

    /**
     * @param \AppBundle\Entity\User $idStaff
     */
    public function setIdStaff($idStaff)
    {
        $this->idStaff = $idStaff;
    }


}

