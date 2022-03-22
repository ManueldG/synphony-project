<?php

namespace App\Controller;

use App\Entity\Car;

use App\Form\CarType;

use App\Repository\CarRepository;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    /**
     * @Route("/car", name="app_car")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        CarRepository $carRepository

    ): Response
    {
        /**
         * @var Car $car
         */

        $car = new Car();

        $formCar = $this->createForm(carType::class, $car);
        $formCar->handleRequest($request);

        
        if ($formCar->isSubmitted() && $formCar->isValid()){
            /**@var Car $car*/
            $car = $formCar->getData();
            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash('success','inserimento effettuato');
        }

        $cars = $carRepository->findAll();
            

        
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'controller_name' => 'CarController',
            'formCar' => $formCar->createView(),
        ]);
    }
}
