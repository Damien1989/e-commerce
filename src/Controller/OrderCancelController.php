<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderCancelController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/erreur/{stripeSessionUrl}", name="order_cancel")
     */
    public function index($stripeSessionUrl): Response
    {

        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionUrl($stripeSessionUrl);

        if(!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }


        return $this->render('order_cancel/index.html.twig', [
            'order' => $order
        ]);
    }
}
