<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LocIHM\LocationBundle\Entity\Agence;
use LocIHM\LocationBundle\Form\AgenceType;

/**
 * Agence controller.
 *
 */
class AgenceController extends Controller
{

    /**
     * Lists all Agence entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocIHMLocationBundle:Agence')->findAll();

        return $this->render('LocIHMLocationBundle:Agence:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Agence entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Agence();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agence_show', array('id' => $entity->getId())));
        }

        return $this->render('LocIHMLocationBundle:Agence:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Agence entity.
     *
     * @param Agence $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Agence $entity)
    {
        $form = $this->createForm(new AgenceType(), $entity, array(
            'action' => $this->generateUrl('agence_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Agence entity.
     *
     */
    public function newAction()
    {
        $entity = new Agence();
        $form   = $this->createCreateForm($entity);

        return $this->render('LocIHMLocationBundle:Agence:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Agence entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Agence')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agence entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:Agence:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Agence entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Agence')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agence entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:Agence:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Agence entity.
    *
    * @param Agence $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Agence $entity)
    {
        $form = $this->createForm(new AgenceType(), $entity, array(
            'action' => $this->generateUrl('agence_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Agence entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Agence')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agence entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('agence_edit', array('id' => $id)));
        }

        return $this->render('LocIHMLocationBundle:Agence:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Agence entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocIHMLocationBundle:Agence')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Agence entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agence'));
    }

    /**
     * Creates a form to delete a Agence entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agence_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
