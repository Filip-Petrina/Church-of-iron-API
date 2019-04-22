<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Exception\ItemNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Services\ApiResponse;

use Doctrine\ORM\EntityManagerInterface;

use Psr\Log\LoggerInterface;

class EntityController extends Controller
{

	public function __construct()
	{

	}

	/**
	 * @return [type] [description]
	 * @Route("/api/getallentities", name="getAllEntities")
     * @Method({"GET"})
	 */
	public function getAllEntities(EntityManagerInterface $em, Request $request)
	{
		// $authorizedArr = $authController->checkLogin($request);
		// $authorizedArr = $authController->checkLogin($request);

		$response = ApiResponse::getResponse();

		$entityManager = $this->getDoctrine()->getManager();
		
		$query = $em->createQuery('SELECT c FROM App\Entity\Tour c');
        $tours = $query->getResult();

		$query = $em->createQuery('SELECT c FROM App\Entity\Event c');
        $events = $query->getResult();

        $toursResponse = array();
        $eventsResponse = array();

        
          
        
        foreach($tours as $tour)
        { 
            $gallery = array();    
        	if (!empty($tour->getImages()))
        	{
        		foreach ( $tour->getImages() as $key => $value)
        		{
					$gallery[$key]["src"] = $_ENV["APIURL"].'/uploads/images/tour_gallery/'.$value->getImage();
					$gallery[$key]["thumb"] = $_ENV["APIURL"].'/uploads/images/tour_gallery/'.$value->getImageThumb();
        		}
            }  
            
            $toursResponse[] = 
        	array(
                "id"=>$tour->getId(),
        		"title"=>$tour->getTitle(),
				"subtitle"=>$tour->getSubtitle(),
				"description"=>$tour->getDescription(),
        		"image_src"=>$_ENV["APIURL"].'/uploads/images/products/'.$tour->getImage(),
        		"gallery"=>$gallery
        	);
        }

        foreach($events as $event)
        {
            
            $eventsResponse[] = 
        	array(
                "id"=>$event->getId(),
        		"title"=>$event->getTitle(),
				"subtitle"=>$event->getSubtitle(),
				"description"=>$event->getDescription()
        	);
        }
        
        
        $arr = 
        array(
            "tours"=>$toursResponse,
            "events"=>$eventsResponse,
        );
		

		$response['data'] = $arr;
		$status = 200;

		return new JsonResponse($response, $status);
	}



}
