<?php
namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Person;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeelnemerController
 * @package App\Controller
 * @Route("/deelnemer", name="lid_")
 */
class DeelnemerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('deelnemer/index.html.twig');
    }

    /**
     * @Route("/agenda", name="training_agenda")
     */
    public function trainingAgendaAction(): Response
    {
        $date = getdate();
        $lessen = $this->getDoctrine()->getRepository(Lesson::class)->findByDate();
        return $this->render('deelnemer/activiteiten.html.twig', [
            'lessen' => $lessen,
        ]);
    }

    /**
     * @Route("/inschrijvingen", name="training_inschrijvingen")
     */

    /**
     * @Route("/profiel", name="profiel_edit", methods={"GET", "POST"})
     */
    public function profielAction(Request $request): Response
    {
        $person = $this->getUser();
        $form = $this->createForm(PersonType::class, $person);
        $form->remove('hiringDate');
        $form->remove('salary');
        $form->remove('password');

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $person->setRoles($this->getUser()->getRoles());
            $em->persist($person);
            $em->flush();
        }
        return $this->render('deelnemer/profile/edit.html.twig', [
            'person' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/{id}", name="profile_delete", methods={"DELETE"})
     */
    public function deleteGebruikerAction(Request $request, Person $person): Response
    {
        if ($this->isCsrfTokenValid('delete' . $person->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($person);
            $entityManager->flush();
        }

        return $this->redirectToRoute('homepage');
    }
}