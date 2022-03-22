<?php

namespace App\Controller;

use App\Entity\Car;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    /**
     * @Route("/car", name="app_car")
     */
    public function index(): Response
    {
        /**
         * @var Car $car
         */
        $car = new Car();

        $formCar = $this->createForm(carType::class, $car);

        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'formCar' => $formCar->createView(),
        ]);
    }
}
