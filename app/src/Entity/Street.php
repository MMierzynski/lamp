<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StreetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get",
 *          "post"
 *     },
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete"
 *     }
 * )
 * @ORM\Entity(repositoryClass=StreetRepository::class)
 */
class Street
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Line::class, mappedBy="streets")
     */
    private $mpk_lines;

    /**
     * @ORM\OneToMany(targetEntity=Issue::class, mappedBy="street")
     */
    private $issues;

    public function __construct()
    {
        $this->mpk_lines = new ArrayCollection();
        $this->issues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Line[]
     */
    public function getMpkLines(): Collection
    {
        return $this->mpk_lines;
    }

    public function addMpkLine(Line $mpkLine): self
    {
        if (!$this->mpk_lines->contains($mpkLine)) {
            $this->mpk_lines[] = $mpkLine;
            $mpkLine->addStreet($this);
        }

        return $this;
    }

    public function removeMpkLine(Line $mpkLine): self
    {
        if ($this->mpk_lines->contains($mpkLine)) {
            $this->mpk_lines->removeElement($mpkLine);
            $mpkLine->removeStreet($this);
        }

        return $this;
    }

    /**
     * @return Collection|Issue[]
     */
    public function getIssues(): Collection
    {
        return $this->issues;
    }

    public function addIssue(Issue $issue): self
    {
        if (!$this->issues->contains($issue)) {
            $this->issues[] = $issue;
            $issue->setStreet($this);
        }

        return $this;
    }

    public function removeIssue(Issue $issue): self
    {
        if ($this->issues->contains($issue)) {
            $this->issues->removeElement($issue);
            // set the owning side to null (unless already changed)
            if ($issue->getStreet() === $this) {
                $issue->setStreet(null);
            }
        }

        return $this;
    }
}
