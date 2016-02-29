<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GalleriesController extends Controller
{
    /**
     * @Route("/galleries")
     */
    public function galleriesAction()
    {
        return $this->render('AppBundle:Galleries:galleries.html.twig', array(
            // ...
        ));
    }

}
