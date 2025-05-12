<?php

namespace App\C_Conv\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConvController extends AbstractController
{
    #[Route(path: '/conv', name: 'conv_page')]

    public function convpage(): Response
    {
        return $this->render('C_Conv/conv_main.html.twig', []);
    }
}