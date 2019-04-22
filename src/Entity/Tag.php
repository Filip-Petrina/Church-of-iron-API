<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;


use App\Entity\TraitCommon;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{

    use TraitCommon;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $defaultFilter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDefaultFilter(): ?bool
    {
        return $this->defaultFilter;
    }

    public function setDefaultFilter(?bool $defaultFilter): self
    {
        $this->defaultFilter = $defaultFilter;

        return $this;
    }
}
