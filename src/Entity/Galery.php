<?php

namespace App\Entity;

use App\Repository\GaleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GaleryRepository::class)
 */
class Galery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Project::class, inversedBy="galery", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitleFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitleEn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleEn;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitleFr(): ?string
    {
        return $this->subtitleFr;
    }

    public function setSubtitleFr(string $subtitleFr): self
    {
        $this->subtitleFr = $subtitleFr;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getSubtitleEn(): ?string
    {
        return $this->subtitleEn;
    }

    public function setSubtitleEn(string $subtitleEn): self
    {
        $this->subtitleEn = $subtitleEn;

        return $this;
    }

    /**
     * Get the value of titleEn
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set the value of titleEn
     *
     * @return  self
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;

        return $this;
    }
}
