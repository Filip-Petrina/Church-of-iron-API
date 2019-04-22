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

class PageController extends Controller
{

	public function __construct()
	{

	}

	/**
	 * @return [type] [description]
	 * @Route("/fixtree", name="fixTree")
     * @Method({"GET"})
	 */
	public function fixTree(EntityManagerInterface $em, Request $request)
	{

		$repo = $em->getRepository('App\Entity\Page');

		// verification and recovery of tree
		$repo->verify();
		// can return TRUE if tree is valid, or array of errors found on tree
		$repo->recover();
		
		$em->flush();

        return new Response("ok!", 200);
	}

}
