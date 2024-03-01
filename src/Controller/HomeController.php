<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(LoggerInterface $logger): Response
    {
        $time = time();

        $logger->info('Home controller at / and unix time of:' . $time);

        return $this->render('home/index.html.twig', [
            'controller_name' => $time
        ]);
    }
}
