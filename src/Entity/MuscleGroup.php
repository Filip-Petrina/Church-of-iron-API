<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


use Doctrine\Common\Collections\ArrayCollection;
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
 * @ORM\Entity(repositoryClass="App\Repository\MuscleGroupRepository")
 * @ApiFilter(GroupFilter::class, arguments={"parameterName": "groups", "overrideDefaultGroups": true})
 * @Vich\Uploadable
 */
class MuscleGroup
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Muscle", mappedBy="muscleGroups")
     */
    private $muscles;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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
            $muscle->addMuscleGroup($this);
        }

        return $this;
    }

    public function removeMuscle(Muscle $muscle): self
    {
        if ($this->muscles->contains($muscle)) {
            $this->muscles->removeElement($muscle);
            $muscle->removeMuscleGroup($this);
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
