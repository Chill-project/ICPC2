<?php

namespace Chill\ICPC2Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ChillICPC2Bundle:Default:index.html.twig', array('name' => $name));
    }
}
