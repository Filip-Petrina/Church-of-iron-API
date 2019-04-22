<?php

namespace App\EventListener;
use App\Entity\GalleryImage;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;

use Intervention\Image\ImageManagerStatic as Image;
// composer require intervention/image

class GalleryImageListener
{
    private $container;
    private $product_gallery_path;
    //private $product_images_path;

    // nakkon inserta u bazu okine se PostPersist event u kojem se nalazi flush
    // no unutar flusha se okida PostUpdate pa se zato dogodi i update event
    // ovo je jedini nacin da se izbjegne okidanje 2 eventa kod nove slike (insert/update)
    private $_insert = false;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $rootpath = $this->container->get('kernel')->getProjectDir() . '/public';
        $this->product_gallery_path = $rootpath . $this->container->getParameter('app.path.gallery') . '/';
        //$this->product_images_path = $rootpath . $this->container->getParameter('app.path.tour_images') . '/';
    }

    /**
    * @ORM\PostPersist
    */

    public function postPersist(LifecycleEventArgs $args)
    {
     
       
        $entity = $args->getEntity();
        if (!$entity instanceof GalleryImage) {
            return;
        }
        
        $em = $args->getEntityManager();
        
        if ($entity instanceof GalleryImage) {

            $this->_insert = true;
            $this->createThumbnail($em, $entity);
        }        
    }

    /**
    * @ORM\PostUpdate
    */

    public function postUpdate(LifecycleEventArgs $args)
    {
 
        $entity = $args->getEntity();
        if (!$entity instanceof GalleryImage) {
            return;
        }

        if ($this->_insert) return;

        $em = $args->getEntityManager();


        // delete old thumb
        $thumbImg = $this->product_gallery_path . $entity->getImageThumb();
        if (is_file($thumbImg)) {
            unlink($thumbImg);
        }

        // napravi i snimi u db i fs novi thumb
        $this->createThumbnail($em, $entity);

    }

    private function createThumbnail(EntityManager $em, GalleryImage $entity)
    {
        $img2 = $entity->getImageFile();
        $fileLocation = $img2->getRealPath();
        // dump($img2, $fileLocation);die();
        if(file_exists($fileLocation))
        {
            $image = Image::make($fileLocation);

            $width = $image->width();
            $height = $image->height();
    
            if($width == $height)
            {
                $image->resize(80, 80);
            }
            else if($width > $height)
            {
                $image->crop($height, $height);
                $image->resize(80, 80);
            }
            else if($width < $height)
            {
                $image->crop($width, $width);
                $image->resize(80, 80);
            }      

            $thumb_filename = "thumb_" . $img2->getFilename();
            $newFileLocation = dirname($fileLocation) . '/' . $thumb_filename;
            $image->save($newFileLocation, 100);

            $entity->setImageThumb($thumb_filename);
            $em->persist($entity);
            $em->flush();

    
        }

    }

    
    /**
    * @ORM\PreRemove
    */

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof GalleryImage) {
            return;
        }
        
        
        $img = $this->product_gallery_path . $entity->getImage();;
        $thumbImg = $this->product_gallery_path . $entity->getImageThumb();

        // delete image
        if (is_file($img)) {
            unlink($img);
        }
        // delete thumb
        if (is_file($thumbImg)) {
            unlink($thumbImg);
        }

    }    




}