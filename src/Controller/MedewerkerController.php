<?php
namespace App\Controller;
use App\Entity\Lesson;
use App\Entity\Training;
use App\Entity\User;
use App\Form\LessonType;
use App\Form\UserType;
use App\Form\TrainingType;
use App\Repository\LessonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class MedewerkerController
 * @package App\Controller
 * @Route("/medewerker", name="medewerker_")
 * @IsGranted("ROLE_INSTRUCTOR")
 */
class MedewerkerController extends AbstractController
{
    /**
     * @Route("/", name="lesson_index", methods={"GET"})
     */
    public function indexLessonAction(LessonRepository $lessonRepository): Response
    {
        return $this->render('medewerker/lesson/index.html.twig', [
            'lessons' => $lessonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/lesson/new", name="lesson_new", methods={"GET","POST"})
     */
    public function newLessonAction(Request $request, Security $security): Response
    {
        $lesson = new Lesson();
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneBy(['id' => $security->getUser()->getId()]);
            $lesson->setInstructor($user);
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirectToRoute('medewerker_lesson_index');
        }

        return $this->render('medewerker/lesson/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lesson/{id}", name="lesson_show", methods={"GET"})
     */
    public function showLessonAction(Lesson $lesson): Response
    {
        $registrations = $lesson->getRegistrations()->getValues();

        return $this->render('medewerker/lesson/show.html.twig', [
            'lesson' => $lesson,
            'registrations' => $registrations,
        ]);
    }

    /**
     * @Route("/lesson/{id}/edit", name="lesson_edit", methods={"GET","POST"})
     */
    public function editLessonAction(Request $request, Lesson $lesson): Response
    {
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medewerker_lesson_index');
        }

        return $this->render('medewerker/lesson/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lesson/{id}", name="lesson_delete", methods={"DELETE"})
     */
    public function deleteLessonAction(Request $request, Lesson $lesson): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lesson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medewerker_lesson_index');
    }

    /**
     * @Route("/lesson/{id}", name="lesson_delete_confirmation", methods={"CONFIRMATION"})
     */
    public function deleteLessonConfirmation(Request $request)
    {
        return addFlash('confirmRequest', 'Weet u zeker dat u dit wilt verwijderen?');
    }
}