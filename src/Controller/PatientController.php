<?php

namespace App\Controller;

use App\Repository\AppointmentRepository;
use App\Repository\ScheduleRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class PatientController extends AbstractController
{

    /**
     * @Route("/mes-rendez-vous", name="patient_mes-rendez-vous"  )
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function appointment(Request $request, UsersRepository $usersRepository): Response
    {

        $user = $this->getUser()->getUsername();

        $mesrendezvous = $usersRepository->findByPatient($user);

        return $this->render('patient/rendezvous.html.twig', [
            'mesrendezvous' => $mesrendezvous,
        ]);
    }


    /**
     * @Route("/deleteappointement/{id}", name="deleteappointement")
     */
    public function deleteappointement(int $id, AppointmentRepository $appointmentRepository, ScheduleRepository $scheduleRepository): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $Appointment = $appointmentRepository->find($id);


        $entityManager->remove($Appointment);

        $entityManager->flush();

        return $this->redirectToRoute("patient_mes-rendez-vous");
    }

    /**
     * @Route("/profil", name="profil")
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @param AppointmentRepository $appointmentRepository
     * @return Response
     */
    public function profil(Request $request, UsersRepository $usersRepository, AppointmentRepository $appointmentRepository): Response
    {
        $username = $this->getUser()->getUsername();

        $users = $usersRepository->findUniqueScheduleByPatient($username);

        return $this->render('patient/profil.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/ajout-info-rendezvous", name="makeAnAppointment")
     * 2 champs symptome et comments
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @param AppointmentRepository $appointmentRepository
     * @return Response
     */
    public function makeAnAppointment(Request $request, UsersRepository $usersRepository, AppointmentRepository $appointmentRepository): Response
    {

            $userId = $request->request->get('userid');

            $scheduleId = $request->request->get('schedule');

            $symptome = $request->request->get('symptom');

            $comments = $request->request->get('comment');

            $usersRepository->updateAppointment($userId, $scheduleId, $symptome,$comments);

            $this->addFlash("alert alert-primary", "votre rendez vous a bien été pris en compte");

            return $this->redirectToRoute('profil');

    }

    /**
     * @Route("/Mise-a-jour-du-profil", name="majduprofil")
     * 2 champs symptome et comments
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @param AppointmentRepository $appointmentRepository
     * @return Response
     */
    public function updateProfil(Request $request, UsersRepository $usersRepository, AppointmentRepository $appointmentRepository): Response
    {

        $patientFirstName = $request->request->get('patientFirstName');

        $patientLastName= $request->request->get('patientLastName');

        $patientMaritialStatus= $request->request->get('patientMaritialStatus');


        $patientDateDeNaissance= $request->request->get('patientDateDeNaissance');

        $username = $this->getUser()->getUsername();

        $usersRepository->updateProfil($patientFirstName, $patientLastName, $patientMaritialStatus,$patientDateDeNaissance,$username);

        $this->addFlash("alert alert-danger", "vos changements ont bien été pris en compte");

        return $this->redirectToRoute('profil');

    }


}


