<?php

namespace AppBundle\Controller;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
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
    public function jqTestAction(Request $request, LoggerInterface $logger)
    {
        $logger->info("********************************8 using the logger *************************");
        return $this->render('test-jq.html.twig');
    }
}
