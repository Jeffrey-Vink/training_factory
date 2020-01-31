<?php
namespace App\Controller;
use App\Entity\User;
use App\Entity\Training;
use App\Form\UserRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Michelf\MarkdownInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/aanbod", name="training_aanbod")
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
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserRegistrationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setRoles(["ROLE_USER"]);
            $user->setActive(true);
            $pass = $form->getData()->getPassword();
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $pass
            ));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->render('bezoeker/index.html.twig');
        }
        return $this->render('bezoeker/registreren.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}