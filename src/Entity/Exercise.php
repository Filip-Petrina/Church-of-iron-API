<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;


use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\TraitCommon;
use App\Entity\TraitImage;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseRepository")
 * @ApiFilter(GroupFilter::class, arguments={"parameterName": "groups", "overrideDefaultGroups": true})
 * @Vich\Uploadable
 */
class Exercise
{

    use TraitCommon;
    use TraitImage;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Muscle")
     */
    private $muscles;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"default":0})
     */
    private $type;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $sets;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
 
     private $reps;
    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $breakBetweenSets;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;


    public function __construct()
    {
        $this->muscles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Muscle[]
     */
    public function getMuscles(): Collection
    {
        return $this->muscles;
    }

    public function addMuscle(Muscle $muscle): self
    {
        if (!$this->muscles->contains($muscle)) {
            $this->muscles[] = $muscle;
        }

        return $this;
    }

    public function removeMuscle(Muscle $muscle): self
    {
        if ($this->muscles->contains($muscle)) {
            $this->muscles->removeElement($muscle);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getSets(): ?int
    {
        return $this->sets;
    }

    public function setSets(?int $sets): self
    {
        $this->sets = $sets;

        return $this;
    }

    public function getReps(): ?int
    {
        return $this->reps;
    }

    public function setReps(?int $reps): self
    {
        $this->reps = $reps;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getBreakBetweenSets(): ?\DateTimeInterface
    {
        return $this->breakBetweenSets;
    }

    public function setBreakBetweenSets(?\DateTimeInterface $breakBetweenSets): self
    {
        $this->breakBetweenSets = $breakBetweenSets;

        return $this;
    }
}
