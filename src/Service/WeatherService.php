<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WeatherService
{
    private $client;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->client = HttpClient::create();
        $this->apiKey = $apiKey;
    }

    /**
     * @return array
     */
    public function getToulouseWeather()
    {
        try{
        $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=Toulouse&appid=' . $this->apiKey .'&units=metric');


                if (200 !== $response->getStatusCode()) {
                    throw new \Exception('Ville introuvable');
                } else {
                    $contentType = $response->getHeaders()['content-type'][0];
                    $content = $response->getContent();
                    $content = $response->toArray();
                }


            }catch (TransportExceptionInterface $e){
                var_dump($e);
            }

        return [
            $content
        ];    
    }


    /**
     * @return array
     */
    public function getWeather($city)
    {           
            try{
                $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=' . $this->apiKey .'&units=metric');
                
                if (200 !== $response->getStatusCode()) {
                    throw new \Exception('Ville introuvable');
                } else {
                    $contentType = $response->getHeaders()['content-type'][0];
                    $content = $response->getContent();
                    $content = $response->toArray();
                }


            }catch (TransportExceptionInterface $e){
                var_dump($e);
            }
                
    
        return [
            $content
        ];    
    }
}
