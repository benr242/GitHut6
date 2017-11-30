<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/bs-test", name="test")
     */
    public function testAction(Request $request)
    {
        //return $this->render('', array('name' => $name));

        return $this->render('bs-test.html.twig');
    }
}
