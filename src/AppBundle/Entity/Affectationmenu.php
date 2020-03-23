<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectationmenu
 *
 * @ORM\Table(name="affectationmenu", indexes={@ORM\Index(name="id_menu", columns={"id_menu"}), @ORM\Index(name="id_enfant", columns={"id_enfant"})})
 * @ORM\Entity
 */
class Affectationmenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_enfant", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idEnfant;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_menu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idMenu;


}

