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
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


use App\Entity\TraitCommon;
use App\Entity\TraitContent;
use App\Entity\TraitImage;
use App\Entity\TraitDates;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AnimationRepository")
 * @ApiFilter(GroupFilter::class, arguments={"parameterName": "groups", "overrideDefaultGroups": true})
 * @Vich\Uploadable
 */
class Animation
{
    use TraitCommon;
    use TraitContent;
    use TraitImage;
    use TraitDates;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"page_tree"})
     */
    private $id;

     /**
     * @var Image[]|ArrayCollection
     *
     * @Groups({"page_tree"})
     *
     * @ORM\ManyToMany(targetEntity="GalleryImage", cascade={"remove", "persist"}, fetch="EAGER", orphanRemoval=true)
     * @ORM\JoinTable(name="gallery_animation_conn",
     *      joinColumns={@ORM\JoinColumn(onDelete="CASCADE", name="animation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(onDelete="CASCADE", name="image_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $images;


    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get images
     *
     * @return Image[]|ArrayCollection
     */
    public function getImages()
    {
        // var_dump($this->images);
        return $this->images;
    }
}
