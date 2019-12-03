<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Registration;
use App\Entity\Training;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

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
    public function homepageAction(Security $security): Response
    {
        $person = $security->getUser();
        $lessen = $person->getRegistrations();
        return $this->render('deelnemer/index.html.twig', [
            'user' => $person,
            'lessen' => $lessen,
        ]);
    }

    /**
     * @Route("/agenda", name="training_agenda")
     */
    public function trainingAgendaAction(): Response
    {
        $registraties = $this->getDoctrine()->getRepository(Person::class)->findOneBy(['id'=>$this->getUser()->getId()])->getRegistrations();
        $lessen = $this->getDoctrine()->getRepository(Lesson::class)->findByDate();
        return $this->render('deelnemer/agenda.html.twig', [
            'lessen' => $lessen,
            'registraties' => $registraties,
        ]);
    }

    /**
     * @Route("/inschrijven/{id}", name="les_inschrijven", methods={"POST"})
     */
    public function trainingInschrijvenAction(Lesson $lesson, Request $request, Security $security): Response
    {
        $registratie = new Registration();
        $person = $this->getDoctrine()->getRepository(Person::class)->findOneBy(['id' => $security->getUser()->getId()]);
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->findOneBy(['id' => $lesson->getId()]);
        $registratie->setMember($person);
        $registratie->setLesson($lesson);
        $em = $this->getDoctrine()->getManager();
        $em->persist($registratie);
        $em->flush();

        return $this->redirectToRoute('lid_homepage');
    }

    /**
     * @Route("/inschrijving/{id}", name="les")
     */
    public function readInschrijvingAction(Lesson $lesson): Response
    {
        return $this->render('deelnemer/lesson/show.html.twig', [
            'lesson' => $lesson
        ]);
    }

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
        if ($form->isSubmitted() && $form->isValid()) {
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

    /**
     * @Route("/registratie/{id}", name="registratie_delete", methods={"DELETE"})
     */
    public function deleteRegistratieAction(Request $request, Registration $registration): Response
    {
        if ($this->isCsrfTokenValid('delete' . $registration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($registration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lid_homepage');
    }
}