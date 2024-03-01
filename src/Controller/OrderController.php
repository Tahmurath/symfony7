<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order_list')]
    public function index(
        OrderRepository $orderRepository
    ): Response
    {

        $orders = $orderRepository->findAll();

        return $this->render('order/order_list.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/add_order', name: 'app_order_add')]
    public function add(
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


        return $this->render('order/add_order.html.twig', [
            'order' => $order,
            'errors' => $errors,
        ]);
    }

    #[Route('/order/{id}', name: 'app_order_item')]
    public function show(
        EntityManagerInterface $entityManager,
        Order $order
    ): Response
    {
        return $this->render('order/order_item.html.twig', [
            'order' => $order,
        ]);
    }
    #[Route('/order/{id}/delete', name: 'app_order_delete')]
    public function delete(
        EntityManagerInterface $entityManager,
        Order $order
    ): Response
    {
        $entityManager->remove($order);
        $entityManager->flush();
        return  $this->redirectToRoute('app_order_list');
        return $this->render('order/order_item.html.twig', [
            'order' => $order,
        ]);
    }
}
