<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    #[Route('/add_order', name: 'app_order')]
    public function index(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        LoggerInterface $logger
    ): Response
    {

        $order = new Order();
        $order->setOrderTitle('The order title');
        $order->setOrderPrice(10000);
        $order->setOrderStatus('init');

        $errors = $validator->validate($order);

        $logger->error(count($errors));

        if (count($errors) == 0) {

            $entityManager->persist($order);
            $entityManager->flush();
        }


        return $this->render('order/index.html.twig', [
            'order' => $order,
            'errors' => $errors,
        ]);
    }

    #[Route('/order/{id}', name: 'app_order_item')]
    public function show2(
        EntityManagerInterface $entityManager,
        Order $order
    ): Response
    {
        return $this->render('order/order_item.html.twig', [
            'order' => $order,
        ]);
    }
}
