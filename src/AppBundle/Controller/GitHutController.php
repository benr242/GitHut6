<?php

namespace AppBundle\Controller;

use AppBundle\Service\GitHubApi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class GitHutController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/{username}", name="githut")
     */
    public function githutAction(Request $request, GitHubApi $api, $username)
    {
        //$templateData = $api->getProfile('codereviewvideos');

        $templateData = $api->getProfile($username);

        return $this->render('githut/index.html.twig', $templateData);
    }
}
