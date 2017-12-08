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
/*
    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        //$this->httpClient = $client;
    }
*/
    public function getProfile($username)
    {
        $this->httpClient = new \GuzzleHttp\Client();
        $response = $this->httpClient->request('GET', 'https://api.github.com/users/codereviewvideos');
        //$response = $this->client->request('GET', 'https://api.github.com/users/codereviewvideos');
        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'avatar_url'  => $data['avatar_url'],
            'name'        => $data['name'],
            'username'    => 'benr242',
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
    public function getRepos($username, \GuzzleHttp\ClientInterface $client)
    {
        //$data = $this->httpClient->get('https://api.github.com/users/' . $username . '/repos');
        $client = new \GuzzleHttp\Client();
        $data = $this->httpClient->get('https://api.github.com/users/codereviewvideos/repos');

        return [
            'repo_count' => count($data),
            'most_stars' => array_reduce($data, function ($mostStars, $currentRepo) {
                return $currentRepo['stargazers_count'] > $mostStars ? $currentRepo['stargazers_count'] : $mostStars;
            }, 0),
            'repos' => $data
        ];
    }
}