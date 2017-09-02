<?php

namespace ToyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/toys",name="toys")
     */
    public function toyList()
    {
        return $this->render('ToyBundle:Default:index.html.twig');
    }
}
