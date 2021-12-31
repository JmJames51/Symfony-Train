<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProgramRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Assert\EnableAutoMapping()
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 * @UniqueEntity("title")
 */
class Program
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Un nom de titre est requis")
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @Assert\NotBlank(message="un synopsis est requis")
     * @Assert\Length(max="255")
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poster;

    /**
     * @Assert\NotBlank(message="Ne me laisse pas tout vide voyons")
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @Assert\NotBlank(message="L'année de sortie est requis")
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity=Season::class, mappedBy="program")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="programs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->season = new ArrayCollection();
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

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }


    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|Season[]
     */
    public function getSeason(): Collection
    {
        return $this->season;
    }

    public function addSeason(Season $season): self
    {
        if (!$this->season->contains($season)) {
            $this->season[] = $season;
            $season->setProgram($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): self
    {
        if ($this->season->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getProgram() === $this) {
                $season->setProgram(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
