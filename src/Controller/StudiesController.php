<?php

namespace App\Controller;

use App\Repository\CoursService;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudiesController extends AbstractController
{
    #[Route(path: '/cours', name: 'studies_page')]
    public function studiespage(CoursService $coursService): Response
    {
        $cours = $coursService->findAllCours();
        $nbCours = count(value: $cours);

        return $this->render(view: 'C_Studies/studies.html.twig', parameters: [
            'cours' => $cours,
            'nbCours' => $nbCours,
        ]);
    }
}
