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
     * @Route("/test-bs", name="test-bs")
     */
    public function bsTestAction(Request $request)
    {
        //return $this->render('', array('name' => $name));

        return $this->render('test-bs.html.twig');
    }

    /**
     * @Route("/test-jq", name="test-jq")
     */
    public function jqTestAction(Request $request)
    {
        return $this->render('test-jq.html.twig');
    }
}
