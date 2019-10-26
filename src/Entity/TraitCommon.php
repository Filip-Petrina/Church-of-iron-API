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

/**
 * Trait class
 */
trait TraitCommon
{
    /**
     * @Groups({"page_tree"})
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return is_string($this->getSlug()) ? $this->getSlug() : '';
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
