<?php
namespace App\Controller;

use App\Entity\Lesson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/profiel", name="profiel")
     */
    public function profielAction()
    {
        return $this->render('deelnemer/profile/edit.html.twig', [
// TODO CRUD profiel user
        ]);
    }
}