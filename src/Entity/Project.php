<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $subtitleFr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $subtitleEn;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $mainIllustration;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $secondIllustration;

    /**
     * @ORM\ManyToOne(targetEntity=ProjectCategory::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projectCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $moreInfoLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $projectDate;

    /**
     * @ORM\Column(type="text")
     */
    public $descriptionFr;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionEn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    public $exhibitionLogo;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    private $otherLogo;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    private $otherPicto;

    /**
     * @ORM\OneToOne(targetEntity=Galery::class, mappedBy="project", cascade={"persist", "remove"})
     */
    private $galery;

    /**
     * @ORM\OneToMany(
     * targetEntity=GaleryCollection::class,
     * mappedBy="project",
     * cascade={"persist", "remove"},
     * orphanRemoval=false
     * )
     */
    private $collections;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkOtherLogo;

    public function __construct()
    {
        $this->techs = new ArrayCollection();
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

    public function getSubtitleEn(): ?string
    {
        return $this->subtitleEn;
    }

    public function setSubtitleEn(string $subtitleEn): self
    {
        $this->subtitleEn = $subtitleEn;

        return $this;
    }

    public function getMainIllustration(): ?Image
    {
        return $this->mainIllustration;
    }

    public function setMainIllustration(Image $mainIllustration): self
    {
        $this->mainIllustration = $mainIllustration;

        return $this;
    }

    public function getSecondIllustration(): ?Image
    {
        return $this->secondIllustration;
    }

    public function setSecondIllustration(Image $secondIllustration): self
    {
        $this->secondIllustration = $secondIllustration;

        return $this;
    }

    public function getProjectCategory(): ?ProjectCategory
    {
        return $this->projectCategory;
    }

    public function setProjectCategory(?ProjectCategory $projectCategory): self
    {
        $this->projectCategory = $projectCategory;

        return $this;
    }

    public function getMoreInfoLink(): ?string
    {
        return $this->moreInfoLink;
    }

    public function setMoreInfoLink($moreInfoLink): self
    {
        $this->moreInfoLink = $moreInfoLink;

        return $this;
    }

    public function getProjectDate(): ?string
    {
        return $this->projectDate;
    }

    public function setProjectDate($projectDate): self
    {

        $this->projectDate = $projectDate;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->descriptionFr;
    }

    public function setDescriptionFr(string $descriptionFr): self
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(string $descriptionEn): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getExhibitionLogo(): ?Image
    {
        return $this->exhibitionLogo;
    }

    public function setExhibitionLogo(?Image $exhibitionLogo): self
    {
        $this->exhibitionLogo = $exhibitionLogo;

        return $this;
    }

    public function getOtherLogo(): ?Image
    {
        return $this->otherLogo;
    }

    public function setOtherLogo(?Image $otherLogo): self
    {
        $this->otherLogo = $otherLogo;

        return $this;
    }

    public function getOtherPicto(): ?Image
    {
        return $this->otherPicto;
    }

    public function setOtherPicto(?Image $otherPicto): self
    {
        $this->otherPicto = $otherPicto;

        return $this;
    }

    public function getGalery(): ?Galery
    {
        return $this->galery;
    }

    public function setGalery(Galery $galery): self
    {
        // set the owning side of the relation if necessary
        if ($galery->getProject() !== $this) {
            $galery->setProject($this);
        }

        $this->galery = $galery;

        return $this;
    }

    /**
     * @return Collection|GaleryCollection[]
     */
    public function getCollections(): Collection
    {
        return $this->collections;
    }

    public function addCollection(GaleryCollection $collection): self
    {
        if (!$this->collections->contains($collection)) {
            $this->collections[] = $collection;
            $collection->setProject($this);
        }

        return $this;
    }

    public function removeCollection(GaleryCollection $collection)
    {
        if ($this->collections->removeElement($collection)) {
            // set the owning side to null (unless already changed)
            if ($collection->getProject() === $this) {
                $collection->setProject(null);
            }
        }
    }

    public function getLinkOtherLogo(): ?string
    {
        return $this->linkOtherLogo;
    }

    public function setLinkOtherLogo($linkOtherLogo): self
    {
        $this->linkOtherLogo = $linkOtherLogo;

        return $this;
    }
}
