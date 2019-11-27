<?php
namespace App\Controller;
use App\Entity\Person;
use App\Entity\Training;
use App\Form\UserRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function trainingAanbodAction(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Training::class);
        /** @var Training $trainingen */
        $trainingen = $repository->findAll();

        return $this->render('bezoeker/trainingaanbod.html.twig', [
            'trainingen' => $trainingen,
        ]);
    }

    /**
     * @Route("registreer", name="bezoeker_registreer")
     */
    public function registerAction(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserRegistrationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $em->getRepository(Person::class);
            $person = $form->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->render('bezoeker/index.html.twig');
        }
        return $this->render('bezoeker/registreren.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}