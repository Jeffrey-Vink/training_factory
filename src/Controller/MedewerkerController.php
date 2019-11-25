<?php
namespace App\Controller;
use App\Entity\Training;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MedewerkerController extends AbstractController
{
    /**
     * @Route("/admin", name="medewerker_home")
     */
    public function homepagina()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/admin/trainingen", name="medewerker_trainingen")
     */
    public function trainingAanbod(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Training::class);
        /** @var trainingen Training */
        $trainingen = $repository->findAll();

        return $this->render('medewerker/activiteiten.html.twig', [
            'trainingen' => $trainingen,
        ]);
    }
}