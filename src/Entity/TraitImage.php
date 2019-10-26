<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
/**
 * Trait class
 */
trait TraitImage
{
    /**
     * It only stores the name of the image associated with the product.
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $image;

     /**
     * It only stores the path of the image associated with the product.
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imagePath;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/gif", "image/png"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     * @Vich\UploadableField(mapping="images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

         /**
     * @param File $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if (!empty($image)) {
        	$this->setUpdatedAt(new \DateTime());
        }
    }
    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;

        
    }
    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;

        if ($image instanceof UploadedFile) {
        	$this->setUpdatedAt(new \DateTime());
        }
    }
    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    } 

    /**
     * @return string
     */
    public function getImagePath()
    {
        return '/uploads/images/images/' . $this->image;
    }  

    public function addImage($image) 
    {
        $this->images->add($file);
        return $this;
    }

    public function removeImage($image)
    {
        $this->images->removeElement($image);
        return $this;
    }  
}
