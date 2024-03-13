<?php

namespace App\Controller;

use App\Entity\UserOrder;
use App\Entity\UserOrderItem;
use App\Repository\UserOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserOrderController extends AbstractController
{
    #[Route('/order', name: 'app_order_list')]
    public function index(
        UserOrderRepository $userOrderRepository
    ): Response
    {

        $userOrders = $userOrderRepository->findAllWithItems();

        return $this->render('order/order_list.html.twig', [
            'userOrders' => $userOrders,
        ]);
    }

    #[Route('/add_order', name: 'app_order_add')]
    public function add(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        LoggerInterface $logger
    ): Response
    {

        $userOrder = new UserOrder();
        $userOrder->setOrderPrice(10000);
        $userOrder->setOrderStatus('init');


        $userOrderItem = new UserOrderItem();
        $userOrderItem->setItemPrice(500);
        $userOrderItem->setUserOrder($userOrder);

        $userOrderItem2 = new UserOrderItem();
        $userOrderItem2->setItemPrice(600);
        $userOrderItem2->setUserOrder($userOrder);

        $errors = $validator->validate($userOrder);

        $logger->error(count($errors));

        if (count($errors) == 0) {

            $entityManager->persist($userOrder);
            $entityManager->persist($userOrderItem);
            $entityManager->persist($userOrderItem2);
            $entityManager->flush();
        }


        return $this->render('order/order_item.html.twig', [
            'userOrder' => $userOrder,
            'errors' => $errors,
        ]);
    }

    #[Route('/order/{id}', name: 'app_order_item')]
    public function show(
        EntityManagerInterface $entityManager,
        UserOrder $userOrder
    ): Response
    {
        return $this->render('order/order_item.html.twig', [
            'userOrder' => $userOrder,
        ]);
    }

    #[Route('/vieworder/{id}', name: 'app_order_itemfull')]
    public function showfull(
        UserOrderRepository $userOrderRepository,
        int $id
    ): Response
    {
        $userOrder = $userOrderRepository->findOneWithItems($id);

        return $this->render('order/order_item.html.twig', [
            'userOrder' => $userOrder,
        ]);
    }

    #[Route('/order/{id}/delete', name: 'app_order_delete')]
    public function delete(
        EntityManagerInterface $entityManager,
        UserOrder $userOrder
    ): Response
    {
        $entityManager->remove($userOrder);
        $entityManager->flush();
        return  $this->redirectToRoute('app_order_list');
    }
}
