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
}
