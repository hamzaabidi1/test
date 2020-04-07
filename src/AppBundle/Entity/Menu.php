<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var string
     *
     * @ORM\Column(name="entree", type="string", length=255, nullable=false)
     */
    private $entree;

    /**
     * @var string
     *
     * @ORM\Column(name="plat", type="string", length=255, nullable=false)
     */
    private $plat;

    /**
     * @var string
     *
     * @ORM\Column(name="dessert", type="string", length=255, nullable=false)
     */
    private $dessert;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_menu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMenu;


}

