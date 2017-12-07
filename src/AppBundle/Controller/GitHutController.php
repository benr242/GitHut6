<?php

namespace AppBundle\Controller;

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
    public function githutAction(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.github.com/users/codereviewvideos');
        $data = json_decode($response->getBody()->getContents(), true);
        
        $templateData = [
            'avatar_url'  => 'https://avatars.githubusercontent.com/u/12968163?v=3',
            'name'        => 'Code Review Videos',
            'username'      => 'benr242',
            'login'       => 'codereviewvideos',
            'details'     => [
                'company'   => 'Code Review Videos',
                'location'  => 'Preston, Lancs, UK',
                'joined_on' => 'Joined on Fake Date For Now',
            ],
            'blog'        => 'https://codereviewvideos.com/',
            'social_data' => [
                'followers'    => 11,
                'following'    => 22,
                'public_repos' => 33,
            ],
            // new data here
            'repo_count' => 100,
            'most_stars' => 50,
            'repos' => [
                [
                    'url' => 'https://codereviewvideos.com',
                    'name' => 'Code Review Videos',
                    'description' => 'some repo description',
                    'stargazers_count' => '999',
                ],
                [
                    'url' => 'http://bbc.co.uk',
                    'name' => 'The BBC',
                    'description' => 'not a real repo',
                    'stargazers_count' => '666',
                ],
                [
                    'url' => 'http://google.co.uk',
                    'name' => 'Google',
                    'description' => 'another fake repo description',
                    'stargazers_count' => '333',
                ],
            ],
        ];

        return $this->render('githut/index.html.twig', $templateData);
    }
}
