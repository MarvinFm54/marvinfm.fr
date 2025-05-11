<?php

namespace App\C_Studies\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudiesController extends AbstractController
{
    #[Route('/cours', name: 'studies_page')]
    public function studiespage(): Response
    {
        return $this->render('C_Studies/studies.html.twig');
    }
}
