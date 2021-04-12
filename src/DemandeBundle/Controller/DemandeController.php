<?php

namespace DemandeBundle\Controller;


use DemandeBundle\Entity\Demande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Demande controller.
 *
 * @Route("demande")
 */
class DemandeController extends Controller
{
    /**
     * Lists all demande entities.
     *
     * @Route("/", name="demande_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        if ($isAdmin) {
            $demandes = $em->getRepository('DemandeBundle:Demande')->findAll();
        } else {
            $demandes = $em->getRepository('DemandeBundle:Demande')->findBy(['idUser' => $this->getUser()->getId()]);
        }

        return $this->render('DemandeBundle:demande:index.html.twig', array(
            'demandes' => $demandes,
        ));
    }

    /**
     * Creates a new demande entity.
     *
     * @Route("/new", name="demande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demande = new Demande();
        $form = $this->createForm('DemandeBundle\Form\DemandeType', $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $demande->setStatut('en cours');
            $demande->setReponse('en cours');
            $demande->setIdUser($this->getUser()->getId());
            $em->persist($demande);
            $em->flush();

            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Demande'))
                ->setFrom('pidev.20@gmail.com')
                ->setTo($this->getUser()->getEmail())
                ->setBody(
                    "Votre Dmande est prise en considération et sera taité le plus tot possible"

                );

            $mailer->send($message);
            return $this->redirectToRoute('demande_index', array('idDemande' => $demande->getIddemande()));
        }

        return $this->render('DemandeBundle:demande:new.html.twig', array(
            'demande' => $demande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demande entity.
     *
     * @Route("/{idDemande}", name="demande_show")
     * @Method("GET")
     */
    public function showAction(Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);

        return $this->render('DemandeBundle:demande:show.html.twig', array(
            'demande' => $demande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demande entity.
     *
     * @Route("/{idDemande}/edit", name="demande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);
        $editForm = $this->createForm('DemandeBundle\Form\DemandeType', $demande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Demande'))
                ->setFrom('pidev.20@gmail.com')
                ->setTo($this->getUser()->getEmail())
                ->setBody(
                    "Votre Demande a été modifier et prise en considération et sera taité le plus tot possible"

                );

            $mailer->send($message);
            return $this->redirectToRoute('demande_index', array('idDemande' => $demande->getIddemande()));
        }

        return $this->render('DemandeBundle:demande:edit.html.twig', array(
            'demande' => $demande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demande entity.
     *
     * @Route("/{idDemande}", name="demande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demande $demande)
    {
        $form = $this->createDeleteForm($demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demande);
            $em->flush();

            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Reclamation'))
                ->setFrom('pidev.20@gmail.com')
                ->setTo($this->getUser()->getEmail())
                ->setBody(
                    "Votre Demande a été retiré "

                );

            $mailer->send($message);
        }

        return $this->redirectToRoute('demande_index');
    }

    /**
     * Creates a form to delete a demande entity.
     *
     * @param Demande $demande The demande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demande $demande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demande_delete', array('idDemande' => $demande->getIddemande())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
