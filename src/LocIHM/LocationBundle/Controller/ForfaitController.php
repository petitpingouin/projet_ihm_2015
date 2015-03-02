<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LocIHM\LocationBundle\Entity\Forfait;
use LocIHM\LocationBundle\Form\ForfaitType;

/**
 * Forfait controller.
 *
 */
class ForfaitController extends Controller
{

    /**
     * Lists all Forfait entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocIHMLocationBundle:Forfait')->findAll();

        return $this->render('LocIHMLocationBundle:Forfait:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Forfait entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Forfait();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('forfait_show', array('id' => $entity->getId())));
        }

        return $this->render('LocIHMLocationBundle:Forfait:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Forfait entity.
     *
     * @param Forfait $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Forfait $entity)
    {
        $form = $this->createForm(new ForfaitType(), $entity, array(
            'action' => $this->generateUrl('forfait_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Forfait entity.
     *
     */
    public function newAction()
    {
        $entity = new Forfait();
        $form   = $this->createCreateForm($entity);

        return $this->render('LocIHMLocationBundle:Forfait:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Forfait entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Forfait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Forfait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:Forfait:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Forfait entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Forfait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Forfait entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:Forfait:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Forfait entity.
    *
    * @param Forfait $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Forfait $entity)
    {
        $form = $this->createForm(new ForfaitType(), $entity, array(
            'action' => $this->generateUrl('forfait_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Forfait entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Forfait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Forfait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('forfait_edit', array('id' => $id)));
        }

        return $this->render('LocIHMLocationBundle:Forfait:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Forfait entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocIHMLocationBundle:Forfait')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Forfait entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('forfait'));
    }

    /**
     * Creates a form to delete a Forfait entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forfait_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
