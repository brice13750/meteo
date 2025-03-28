<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use App\Service\WeatherService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    private $weatherService;

    public function __construct(WeatherService $weather)
    {
        $this->weatherService = $weather;
    }

    /**
     * @Route("/weather", name="weather")
     */
    public function index()
    {
        //avec jquery seulement
        return $this->render('weather/index.html.twig', array(

        ));
    }

    /**
     * @Route("/", name="show")
     */
    public function show(WeatherService $ws)
    {
        // méteo à toulouse
        $weatherToulouse = $ws->getToulouseWeather();
        $json = json_decode(json_encode($weatherToulouse), true);

        return $this->render('weather/home.html.twig', array(
            'json' => $json,
        ));
    }


    /**
     * @Route("/search", name="search")
     */
    public function Weather(WeatherService $ws, Request $request)
    {
        $jsonForm = null;

        $city = new City();

        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            //retrieving form data
            $city = $form->getData();

            $weather = $ws->getWeather($city);
            
            $jsonForm = json_decode(json_encode($weather), true);

            // dd($jsonForm);
        }

        return $this->render('weather/search.html.twig', array(
            'json' => $jsonForm,
            'form' => $form->createView()
        ));
    }
}