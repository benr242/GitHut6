<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GitHutController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @param Request $request
     * @Route("/", name="githut")
     */
    public function githutAction(Request $request)
    {
        $templateData = [
            'username' => 'benr242',
            'avatar_url'  => 'https://avatars.githubusercontent.com/u/12968163?v=3',
            'name'        => 'Code Review Videos',
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
            ]
        ];

        return $this->render('githut/index.html.twig', $templateData);
    }
}
