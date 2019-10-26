<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class GalleryImage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"page_tree"})
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $image;

    /**
     * @var string
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $imagePath;

    /**
     * @var File
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/gif", "image/png"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     * @Vich\UploadableField(mapping="gallery", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", length=255)
     */
    private $updatedAt;

    
    /**
     * Thumb file location in the system
     * @var string
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $imageThumb;

    /**
     * Thumb path location in the system
     * @var string
     * @Groups({"page_tree"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $imageThumbPath;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param File|null $image
     * @return Image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
   
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
        
        return $this;
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
     * @return Image
     */
    public function setImage($image)
    {
    
        $this->image = $image;

        return $this;
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
        return '/uploads/images/gallery/' . $this->image;
    }

    /**
     * Get thumb file location in the system
     *
     * @return  string
     */ 
    public function getImageThumb()
    {
        return $this->imageThumb;
    }

    /**
     * Get thumb file location in the system
     *
     * @return  string
     */ 
    public function getImageThumbPath()
    {
        return '/uploads/images/gallery/' . $this->imageThumb;
    }

    /**
     * Set thumb file location in the system
     *
     * @param  string  $imageThumb  Thumb file location in the system
     *
     * @return  self
     */ 
    public function setImageThumb(string $imageThumb)
    {
        $this->imageThumb = $imageThumb;

        return $this;
    }
}
