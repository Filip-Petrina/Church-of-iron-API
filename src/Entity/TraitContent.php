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
trait TraitContent
{
    

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subTitle;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aboveTitle;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortText;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $mainText;

    /**
     * @Groups({"page_tree"})
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $status = 0;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime $contentChangedAt
     *
     * @ORM\Column(name="content_changed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"title", "subTitle"})
     */
    private $contentChangedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag")
     * @Groups({"page_tree"})
     */
    private $tagList;


    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle(?string $subTitle): self
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    public function getAboveTitle(): ?string
    {
        return $this->aboveTitle;
    }

    public function setAboveTitle(?string $aboveTitle): self
    {
        $this->aboveTitle = $aboveTitle;

        return $this;
    }

    public function getShortText(): ?string
    {
        return $this->shortText;
    }

    public function setShortText(?string $shortText): self
    {
        $this->shortText = $shortText;

        return $this;
    }

    public function getMainText(): ?string
    {
        return $this->mainText;
    }

    public function setMainText(?string $mainText): self
    {
        $this->mainText = $mainText;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getContentChangedAt()
    {
        return $this->contentChangedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setContentChangedAt(\DateTime $contentChangedAt)
    {
        $this->contentChangedAt = $contentChangedAt;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTagList()
    {
        return $this->tagList;
    }

    public function addTagList(Tag $tagList): self
    {
        if (!$this->tagList->contains($tagList)) {
            $this->tagList[] = $tagList;
        }

        return $this;
    }

    public function removeTagList(Tag $tagList): self
    {
        if ($this->tagList->contains($tagList)) {
            $this->tagList->removeElement($tagList);
        }

        return $this;
    }
}
