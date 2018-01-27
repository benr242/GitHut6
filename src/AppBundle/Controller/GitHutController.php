<?php

namespace AppBundle\Controller;

use AppBundle\Service\GitHubApi;
use Psr\Log\LoggerInterface;
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
     * @Route("/{username}", name="githut", defaults={ "username": "codereviewvideos" })
     */
    public function githutAction(Request $request, GitHubApi $api, $username, LoggerInterface $logger)
    {
        $logger->info(json_encode('username::GitHut: ' . $username));

        return $this->render('githut/index.html.twig', [
            'username' => $username
        ]);
    }

    /**
     * @Route("/profile/{username}", name="profile", defaults={ "username": "codereviewvideos" })
     */
    public function profileAction(Request $request, GitHubApi $api, $username, LoggerInterface $logger)
    {
        //$logger->info(json_encode('username::GitHut:profile: ' . $username));
        $logger->info("****************" . get_class($logger) . "*****************************");
        $profileData = $api->getProfile($username);
        return $this->render('githut/profile.html.twig', $profileData);
    }
    /**
     * @Route("/repos/{username}", name="repos", defaults={ "username": "codereviewvideos" })
     */
    public function reposAction(Request $request, GitHubApi $api, $username)
    {
        $repoData = $api->getRepos($username);
        //dump($repoData);
        return $this->render('githut/repos.html.twig', $repoData);
    }
}
