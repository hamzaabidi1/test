<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enseigner
 *
 * @ORM\Table(name="enseigner", indexes={@ORM\Index(name="id_staff", columns={"id_staff"}), @ORM\Index(name="id_cours", columns={"id_cours"})})
 * @ORM\Entity
 */
class Enseigner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_classe", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idClasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_staff", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idStaff;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cours", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCours;


}

