<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Schedule;
use App\Repository\ScheduleRepository;
use App\Repository\UsersRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReservationController extends AbstractController
{
    /**
     * @Route("/date-de-reservation", name="datedereservation")
     * @param Request $request
     * @param ScheduleRepository $scheduleRepository
     * @param UsersRepository $usersRepository
     * @return JsonResponse|Response
     */
    public function index(Request $request,ScheduleRepository $scheduleRepository,UsersRepository $usersRepository)
    {

        $now = new DateTime();

        $sDate = $now->format("Y-m-d");

        $datenull = $scheduleRepository->findByAvailable($sDate);

        if($request->get('ajax')  ){

            $madate = $request->query->get('madate');

            $dateAtraiter = $scheduleRepository->findByAvailable($madate) ;

            $userEncours =$this->getUser()->getUsername();

            $countRdv =$usersRepository->findIfNotExistOtherRDv($userEncours) ;

            $nbRdv = $countRdv[0][1] ;

            if (!empty($dateAtraiter)  ) {

                if($nbRdv < 1 ){

                    return new JsonResponse([
                        'content' => $this->renderView("patient/content.html.twig",
                            [
                                'dateAtraiter' => $dateAtraiter
                            ])
                    ]);
                }
                else{

                   // echo "<div class='alert-primary'>un rendez vous est deja en cours</div>";

                    return new JsonResponse([
                        'content' => $this->renderView("patient/rdvdejaexistant.html.twig",
                            [
                                'dateAtraiter' => $dateAtraiter
                            ])
                    ]);
                }
            }
            else {

               // $this->addFlash("success", "Il n'y a pas encore de disponibilité encore à cette date") ;

                return new JsonResponse([
                    'content' => $this->renderView("patient/echec.html.twig",
                        [
                            'dateAtraiter' => $dateAtraiter
                        ])
                ]);

            }
        }

        return $this->render('patient/index.html.twig', [
            'datenull'=>   isset($datenull) ? $datenull : null,
        ]);
    }

    /**
     * @Route("/booking/{id}", name="booking")
     * @param Schedule $schedule
     * @param Request $request
     * @return RedirectResponse
     */
    public function booking(Schedule $schedule,Request $request): RedirectResponse
    {

        $entityManager = $this->getDoctrine()->getManager();

            $appointement =  new Appointment();

            $appointement->setComments('');
            $appointement->setSymptome('');
            $appointement->setUsers($this->getUser());
            $appointement->setSchedule($schedule);
            $appointement->setStatus('pasfaitencore');
            $entityManager->persist($appointement);
            $schedule->setBookAvail('non disponible');
            $entityManager->flush();

            $this->addFlash("alert alert-primary", "votre rendez vous a bien été pris en compte") ;

            return $this->redirectToRoute('datedereservation');
    }

    /**
     * @Route("/testModal", name="testModal")
     * @param Request $request
     * @param UsersRepository $UserRepository
     * @return Response
     */
    public function testModal(Request $request,UsersRepository $UserRepository)
    {

        return $this->render('test/modal.html.twig', [
            'users'=>  $UserRepository->findAll()
        ]);
    }



}

