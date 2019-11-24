<?php
namespace App\Controller;
use App\Entity\Training;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('bezoeker/index.html.twig');
    }

    /**
     * @Route("/about", name="over_ons")
     */
    public function aboutPage()
    {
        return $this->render('bezoeker/overons.html.twig');
    }

    /**
     * @Route("/about/gedragsregels", name="gedragsregels")
     */
    public function gedragsregels()
    {
        return $this->render('bezoeker/gedragsregels.html.twig');
    }

    /**
     * @Route("aanbod", name="training_aanbod")
     */
    public function trainingAanbod(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Training::class);
        /** @var trainingen Training */
        $trainingen = $repository->findAll();

        return $this->render('bezoeker/trainingaanbod.html.twig', [
            'trainingen' => $trainingen,
        ]);
    }
}