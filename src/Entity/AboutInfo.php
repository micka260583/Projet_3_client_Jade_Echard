<?php

namespace App\Entity;

use App\Repository\AboutInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AboutInfoRepository::class)
 */
class AboutInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title_fr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title_en;

    /**
     * @ORM\Column(type="string")
     */
    private $timing;

    /**
     * @ORM\ManyToOne(targetEntity=AboutInfoCategory::class, inversedBy="aboutInfos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $info_category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleFr(): ?string
    {
        return $this->title_fr;
    }

    public function setTitleFr(string $title_fr): self
    {
        $this->title_fr = $title_fr;

        return $this;
    }

    public function getTitleEn(): ?string
    {
        return $this->title_en;
    }

    public function setTitleEn(string $title_en): self
    {
        $this->title_en = $title_en;

        return $this;
    }

    public function getTiming(): ?string
    {
        return $this->timing;
    }

    public function setTiming(string $timing): self
    {
        $this->timing = $timing;

        return $this;
    }

    public function getInfoCategory(): ?AboutInfoCategory
    {
        return $this->info_category;
    }

    public function setInfoCategory(?AboutInfoCategory $info_category): self
    {
        $this->info_category = $info_category;

        return $this;
    }

    public function __toString(): string
    {
        return $this->info_category;
    }
}
