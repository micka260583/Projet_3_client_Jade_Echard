<?php

namespace App\Entity;

use App\Repository\AboutInfoCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AboutInfoCategoryRepository::class)
 */
class AboutInfoCategory
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
    private $name_fr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_en;

    /**
     * @ORM\OneToMany(targetEntity=AboutInfo::class, mappedBy="info_category", orphanRemoval=true)
     */
    private $aboutInfos;

    public function __construct()
    {
        $this->aboutInfos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFr(): ?string
    {
        return $this->name_fr;
    }

    public function setNameFr(string $name_fr): self
    {
        $this->name_fr = $name_fr;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(string $name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * @return Collection|AboutInfo[]
     */
    public function getAboutInfos(): Collection
    {
        return $this->aboutInfos;
    }

    public function addAboutInfo(AboutInfo $aboutInfo): self
    {
        if (!$this->aboutInfos->contains($aboutInfo)) {
            $this->aboutInfos[] = $aboutInfo;
            $aboutInfo->setInfoCategory($this);
        }

        return $this;
    }

    public function removeAboutInfo(AboutInfo $aboutInfo): self
    {
        if ($this->aboutInfos->removeElement($aboutInfo)) {
            // set the owning side to null (unless already changed)
            if ($aboutInfo->getInfoCategory() === $this) {
                $aboutInfo->setInfoCategory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name_fr;
    }
}
