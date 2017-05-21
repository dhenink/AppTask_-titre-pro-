<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Important;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_limite", type="date")
     */
    private $dateLimite;

    /**
     * @var bool
     *
     * @ORM\Column(name="fait", type="boolean", nullable=true)
     */
    private $fait;

    /**
    * @var Important
    *
    * @Assert\NotBlank()
    * @ORM\ManyToOne(targetEntity="Important", inversedBy="tasks")
    * @ORM\JoinColumn(name="important_id", referencedColumnName="id")
    */
    private $important;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Task
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Task
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set dateLimite
     *
     * @param \DateTime $dateLimite
     *
     * @return Task
     */
    public function setDateLimite($dateLimite)
    {
        $this->dateLimite = $dateLimite;

        return $this;
    }

    /**
     * Get dateLimite
     *
     * @return \DateTime
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }

    /**
     * Set fait
     *
     * @param boolean $fait
     *
     * @return Task
     */
    public function setFait($fait)
    {
        $this->fait = $fait;

        return $this;
    }

    /**
     * Get fait
     *
     * @return bool
     */
    public function getFait()
    {
        return $this->fait;
    }

    /**
     * Set important
     *
     * @param \AppBundle\Entity\Important $important
     *
     * @return Task
     */
    public function setImportant(\AppBundle\Entity\Important $important = null)
    {
        $this->important = $important;

        return $this;
    }

    /**
     * Get important
     *
     * @return \AppBundle\Entity\Important
     */
    public function getImportant()
    {
        return $this->important;
    }
}
