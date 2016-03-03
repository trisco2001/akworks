<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Gallery;
use AppBundle\Form\GalleryType;

/**
 * Gallery controller.
 *
 * @Route("/gallery")
 */
class GalleryController extends Controller
{
    /**
     * Lists all Gallery entities.
     *
     * @Route("/", name="gallery_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('AppBundle:Gallery')->findAll();

        return $this->render('gallery/index.html.twig', array(
            'galleries' => $galleries,
        ));
    }

    /**
     * Creates a new Gallery entity.
     *
     * @Route("/new", name="gallery_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gallery = new Gallery();
        $form = $this->createForm('AppBundle\Form\GalleryType', $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gallery);
            $em->flush();

            return $this->redirectToRoute('gallery_show', array('id' => $gallery->getId()));
        }

        return $this->render('gallery/new.html.twig', array(
            'gallery' => $gallery,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Gallery entity.
     *
     * @Route("/{id}", name="gallery_show")
     * @Method("GET")
     */
    public function showAction(Gallery $gallery)
    {
        $deleteForm = $this->createDeleteForm($gallery);

        return $this->render('gallery/show.html.twig', array(
            'gallery' => $gallery,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gallery entity.
     *
     * @Route("/{id}/edit", name="gallery_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gallery $gallery)
    {
        $deleteForm = $this->createDeleteForm($gallery);
        $editForm = $this->createForm('AppBundle\Form\GalleryType', $gallery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gallery);
            $em->flush();

            return $this->redirectToRoute('gallery_edit', array('id' => $gallery->getId()));
        }

        return $this->render('gallery/edit.html.twig', array(
            'gallery' => $gallery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gallery entity.
     *
     * @Route("/{id}", name="gallery_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gallery $gallery)
    {
        $form = $this->createDeleteForm($gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gallery);
            $em->flush();
        }

        return $this->redirectToRoute('gallery_index');
    }

    /**
     * Creates a form to delete a Gallery entity.
     *
     * @param Gallery $gallery The Gallery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gallery $gallery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gallery_delete', array('id' => $gallery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
