<?php

namespace App\Controller;

use App\Entity\TicketAgenda;
use App\Form\TicketAgendaType;
use App\Repository\TicketAgendaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ticket/agenda")
 */
class TicketAgendaController extends AbstractController
{
    /**
     * @Route("/", name="ticket_agenda_index", methods={"GET"})
     */
    public function index(TicketAgendaRepository $ticketAgendaRepository): Response
    {
        return $this->render('ticket_agenda/index.html.twig', [
            'ticket_agendas' => $ticketAgendaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ticket_agenda_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ticketAgenda = new TicketAgenda();
        $form = $this->createForm(TicketAgendaType::class, $ticketAgenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticketAgenda);
            $entityManager->flush();

            return $this->redirectToRoute('ticket_agenda_index');
        }

        return $this->render('ticket_agenda/new.html.twig', [
            'ticket_agenda' => $ticketAgenda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ticket_agenda_show", methods={"GET"})
     */
    public function show(TicketAgenda $ticketAgenda): Response
    {
        return $this->render('ticket_agenda/show.html.twig', [
            'ticket_agenda' => $ticketAgenda,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ticket_agenda_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TicketAgenda $ticketAgenda): Response
    {
        $form = $this->createForm(TicketAgendaType::class, $ticketAgenda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ticket_agenda_index');
        }

        return $this->render('ticket_agenda/edit.html.twig', [
            'ticket_agenda' => $ticketAgenda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ticket_agenda_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TicketAgenda $ticketAgenda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticketAgenda->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ticketAgenda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ticket_agenda_index');
    }
}
