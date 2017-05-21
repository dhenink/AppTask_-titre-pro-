<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Important;
use AppBundle\Form\ImportantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Important controller.
 *
 * @Route("/important")
 */
class ImportantController extends Controller
{
    /**
     * Lists all important entities.
     *
     * @Route("/", name="important_index")
     * @Method("GET")
     */
    public function indexAction()
    {
      $repository = $this->getDoctrine()->getRepository(Important::class);
        $importants = $repository->findAllImportant();

        return $this->render('AppBundle:Important:index.html.twig', array(
            'importants' => $importants,
        ));
    }

    /**
     * Creates a new important entity.
     *
     * @Route("/new", name="important_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $important = new Important();
        $form = $this->createForm('AppBundle\Form\ImportantType', $important);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($important);
            $em->flush($important);

            return $this->redirectToRoute('important_show', array('id' => $important->getId()));
        }

        return $this->render('AppBundle:Important:new.html.twig', array(
            'important' => $important,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a important entity.
     *
     * @Route("/{id}", name="important_show")
     * @Method("GET")
     */
    public function showAction(Important $important)
    {
        $deleteForm = $this->createDeleteForm($important);

        return $this->render('AppBundle:Important:show.html.twig', array(
            'important' => $important,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing important entity.
     *
     * @Route("/{id}/edit", name="important_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Important $important)
    {
        $deleteForm = $this->createDeleteForm($important);
        $editForm = $this->createForm('AppBundle\Form\ImportantType', $important);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('important_show', array('id' => $important->getId()));
        }

        return $this->render('AppBundle:Important:edit.html.twig', array(
            'important' => $important,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a important entity.
     *
     * @Route("/{id}", name="important_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Important $important)
    {
        $form = $this->createDeleteForm($important);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($important);
            $em->flush($important);
        }

        return $this->redirectToRoute('important_index');
    }

    /**
     * Creates a form to delete a important entity.
     *
     * @param Important $important The important entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Important $important)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('important_delete', array('id' => $important->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
