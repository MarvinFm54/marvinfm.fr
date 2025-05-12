<?php
namespace App\C_Studies\Repository;

use App\C_Studies\Model\Cours;
use Psr\Log\LoggerInterface;

class CoursService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAllCours():array
    {
        $this->logger->info('Cours crées');
        return [
            new Cours(
                id: 1,
                name: 'Informations dev',
                desc: 'Attention, sur le navigateur Firefox et sur les écrans mobiles, ce site peut ne pas s\'afficher correctement.',
                info: 'Fixes',
                type: 'info',
            ),
            new Cours(
                id: 2,
                name: 'Informations de mises à jour',
                desc: 'En cas de MAJ, n\'hésitez pas à effacer les données de navigations (vider le cache).',
                info: 'MAJ',
                type: 'info',
            ),
            new Cours(
                id: 3,
                name: 'Présentation de GNU/Linux',
                link: '/cours/pdf/linux.pdf',
                desc: 'Contexte / histoire, environnements de bureaux, distributions, différentes utilisations et système de répertoire.',
                info: '5 pages',
                type: 'pdf',
            ),
            new Cours(
                id: 4,
                name: 'Architecture d\'un ordinateur & Codage de l\'info',
                link: '/cours/pdf/SISR_part_01-02.pdf',
                desc: 'Introduction à la spécialité de SISR, avec des explications sur le hardware et software.',
                info: '3 pages',
                type: 'pdf',
                domaine: 'SIO1 - SISR'
            ),
            new Cours(
                id: 5,
                name: 'Réseau et IP',
                link: '/cours/pdf/SISR_part_03-04.pdf',
                desc: 'Fonctionnement d\'un réseau, définitions, etc.',
                info: '4 pages',
                type: 'pdf',
                domaine: 'SIO1 - SISR'
            ),
            new Cours(
                info: '0 pages',
            ),
            new Cours(
                info: '0 pages',
            ),
            new Cours(
                info: '0 pages',
            ),
            new Cours(
                info: '0 pages',
            ),
        ];
    }
}