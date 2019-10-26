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
 * @ORM\Entity(repositoryClass="App\Repository\MuscleRepository")
 * @ApiFilter(GroupFilter::class, arguments={"parameterName": "groups", "overrideDefaultGroups": true})
 * @Vich\Uploadable
 */
class Muscle
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
     * @ORM\ManyToMany(targetEntity="App\Entity\MuscleGroup", inversedBy="muscles")
     */
    private $muscleGroups;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->muscleGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|MuscleGroup[]
     */
    public function getMuscleGroups(): Collection
    {
        return $this->muscleGroups;
    }

    public function addMuscleGroup(MuscleGroup $muscleGroup): self
    {
        if (!$this->muscleGroups->contains($muscleGroup)) {
            $this->muscleGroups[] = $muscleGroup;
        }

        return $this;
    }

    public function removeMuscleGroup(MuscleGroup $muscleGroup): self
    {
        if ($this->muscleGroups->contains($muscleGroup)) {
            $this->muscleGroups->removeElement($muscleGroup);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
