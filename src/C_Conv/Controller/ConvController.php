<?php
/*\ 06 23 91 47 02 - 22 millions$, 23cm & 240kg.\*/

namespace App\C_Conv\Controller;

use App\C_Conv\Repository\BranchsService;
use App\C_Conv\Repository\CanalsService;
use App\C_Conv\Repository\MessagesService;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConvController extends AbstractController
{
    public function nbElementTxt(int $nbBranch, int $nbCanal):string
    {
        switch ($nbBranch){
            case 0:
                $b = "Aucune branche. ";
                break;
            case 1:
                $b = "Une branche. ";
                break;
            default:
                $b = $nbBranch . " branches. ";
                break;
        }
        switch ($nbCanal){
            case 0:
                $c = "Aucun canal.";
                break;
            case 1:
                $c = "Un canal.";
                break;
            default:
                $c = $nbCanal . " canaux.";
                break;
        }
        return $b . $c;
    }

    #[Route(path: '/conv', name: 'conv_page')]
    public function convpage(BranchsService $branchsService, CanalsService $canalsService, MessagesService $messagesService): Response
    {
        $branch = $branchsService->findAllBranchs();
        $canal = $canalsService->findAllCanals();
        $message = $messagesService->findMessagesByCanalId(canalId: 1); 

        $nbBranch = count(value: $branch);
        $nbCanal = count(value: $canal);

        return $this->render(view: 'C_Conv/conv_main.html.twig', parameters: [

            'branch' => $branch,
            'canal' => $canal,
            'message' => $message,

            'nbText' => $this->nbElementTxt(nbBranch: $nbBranch,nbCanal: $nbCanal),
        ]);
    }
}
