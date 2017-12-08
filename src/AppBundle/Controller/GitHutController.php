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
     * @Route("/", name="githut")
     */
    public function githutAction(Request $request, GitHubApi $gha)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.github.com/users/codereviewvideos');
        $data = json_decode($response->getBody()->getContents(), true);

        $templateData = [
            'avatar_url'  => $data['avatar_url'],
            'name'        => $data['name'],
            'username'    => 'benr242',
            'login'       => $data['login'],
            'details'     => [
                'company'   => $data['company'],
                'location'  => $data['location'],
                'joined_on' => 'Joined on ' . (new \DateTime($data['created_at']))->format('d m Y'),
            ],
            'blog'        => $data['blog'],
            'social_data' => [
                "Public Repos" => $data['public_repos'],
                "Followers"    => $data['followers'],
                "Following"    => $data['following'],
            ],
            //'repo_count'        => count($data),
            //'most_stars'        => 42,
            //'repos'             => $data
        ];

        return $this->render('githut/index.html.twig', $templateData);
    }
}
