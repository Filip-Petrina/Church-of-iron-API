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
trait TraitDates
{
	

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     * @Groups({"page_tree"})
     */
    private $startDt;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     * @Groups({"page_tree"})
     */
    private $endDt;


    public function getStartDt(): ?\DateTimeInterface
    {
        return $this->startDt;
    }

    public function setStartDt(?\DateTimeInterface $startDt): self
    {
        $this->startDt = $startDt;

        return $this;
    }

    public function getEndDt(): ?\DateTimeInterface
    {
        return $this->endDt;
    }

    public function setEndDt(?\DateTimeInterface $endDt): self
    {
        $this->endDt = $endDt;

        return $this;
    }

}
