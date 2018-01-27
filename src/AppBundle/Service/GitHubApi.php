<?php
/**
 * Created by PhpStorm.
 * User: benr242
 * Date: 12/7/17
 * Time: 12:04 PM
 */

namespace AppBundle\Service;

use Guzzle\Http\Client;

class GitHubApi
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;
    private $myClient;

    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client();
    }

    public function getProfile($username)
    {
        //not needed (from constructor
        //if ($this->httpClient === null)
        //    $this->httpClient = new \GuzzleHttp\Client();

       //$this->httpClient = ($this->httpClient === null) ? new \GuzzleHttp\Client() : ;

        $response = $this->httpClient->request('GET', 'https://api.github.com/users/' . $username);
        $data = json_decode($response->getBody()->getContents(), true);
        //$logger->info(json_encode('username:::****' . $username));
        dump($data);

        return [
            'avatar_url'  => $data['avatar_url'],
            'name'        => $data['name'],
            'login'      => $data['login'],
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
            ]
        ];
    }
    public function getRepos($usernamet)
    {
        $response = $this->httpClient->request('GET', 'https://api.github.com/users/' . $usernamet . '/repos');
        $data = json_decode($response->getBody()->getContents(), true);
        dump($data);

        return [
            'repo_count' => count($data),
            'most_stars' => array_reduce($data, function ($mostStars, $currentRepo) {
                return $currentRepo['stargazers_count'] > $mostStars ? $currentRepo['stargazers_count'] : $mostStars;
            }, 0),
            'repos' => $data
        ];
    }
}