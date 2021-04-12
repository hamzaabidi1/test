<?php

namespace ReclamationBundle\Controller;


use ReclamationBundle\Entity\Reclamer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reclamer controller.
 *
 * @Route("reclamer")
 */
class ReclamerController extends Controller
{
    /**
     * Lists all reclamer entities.
     *
     * @Route("/", name="reclamer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $isAdmin = $this->isGranted('ROLE_ADMIN');

        if ($isAdmin) {
            $reclamers = $em->getRepository('ReclamationBundle:Reclamer')->findAll();
        } else {
            $reclamers = $em->getRepository('ReclamationBundle:Reclamer')->findBy(['idParent' => $this->getUser()->getId()]);
        }


        return $this->render('ReclamationBundle:reclamer:index.html.twig', array(
            'reclamers' => $reclamers,
        ));
    }

    /**
     * Creates a new reclamer entity.
     *
     * @Route("/new", name="reclamer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reclamer = new Reclamer();
        $form = $this->createForm('ReclamationBundle\Form\ReclamerType', $reclamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reclamer->setStatut('en cours');
            $reclamer->setIdParent($this->getUser()->getId());
            $em->persist($reclamer);
            $em->flush();

            //Get swift mailer service from service container
            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Reclamation'))
                ->setFrom('pidev.20@gmail.com')
                ->setTo($this->getUser()->getEmail())
                ->setBody(
                    "Votre Rclamation est prise en considération et sera taité le plus tot possible"

                );

            $mailer->send($message);
            return $this->redirectToRoute('reclamer_index', array('idReclamation' => $reclamer->getIdreclamation()));
        }

        return $this->render('ReclamationBundle:reclamer:new.html.twig', array(
            'reclamer' => $reclamer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reclamer entity.
     *
     * @Route("/{idReclamation}", name="reclamer_show")
     * @Method("GET")
     */
    public function showAction(Reclamer $reclamer)
    {
        $deleteForm = $this->createDeleteForm($reclamer);

        return $this->render('ReclamationBundle:reclamer:show.html.twig', array(
            'reclamer' => $reclamer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reclamer entity.
     *
     * @Route("/{idReclamation}/edit", name="reclamer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reclamer $reclamer)
    {
        $deleteForm = $this->createDeleteForm($reclamer);
        $editForm = $this->createForm('ReclamationBundle\Form\ReclamerType', $reclamer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Reclamation'))
                ->setFrom('pidev.20@gmail.com')
                ->setTo($this->getUser()->getEmail())
                ->setBody(
                    "Votre Rclamation a été modifier et prise en considération et sera taité le plus tot possible"

                );

            $mailer->send($message);
            return $this->redirectToRoute('reclamer_index', array('idReclamation' => $reclamer->getIdreclamation()));

        }

        return $this->render('ReclamationBundle:reclamer:edit.html.twig', array(
            'reclamer' => $reclamer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reclamer entity.
     *
     * @Route("/{idReclamation}", name="reclamer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reclamer $reclamer)
    {
        $form = $this->createDeleteForm($reclamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reclamer);
            $em->flush();

            $mailer = $this->get('mailer');
            $message = (new \Swift_Message('Reclamation'))
                ->setFrom('pidev.20@gmail.com')
                ->setTo($this->getUser()->getEmail())
                ->setBody(
                    "Votre Rclamation a été retiré "

                );

            $mailer->send($message);

        }

        return $this->redirectToRoute('reclamer_index');
    }

    /**
     * Creates a form to delete a reclamer entity.
     *
     * @param Reclamer $reclamer The reclamer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamer $reclamer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamer_delete', array('idReclamation' => $reclamer->getIdreclamation())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
