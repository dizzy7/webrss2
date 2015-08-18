<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_index")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', []);
    }
}
