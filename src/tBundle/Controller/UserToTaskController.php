<?php

namespace tBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use tBundle\Entity\UserToTask;
use tBundle\Form\UserToTaskType;

/**
 * UserToTask controller.
 *
 * @Route("/usertotask")
 */
class UserToTaskController extends Controller
{

    /**
     * Lists all UserToTask entities.
     *
     * @Route("/", name="usertotask")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('tBundle:UserToTask')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new UserToTask entity.
     *
     * @Route("/", name="usertotask_create")
     * @Method("POST")
     * @Template("tBundle:UserToTask:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new UserToTask();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usertotask_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a UserToTask entity.
     *
     * @param UserToTask $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserToTask $entity)
    {
        $form = $this->createForm(new UserToTaskType(), $entity, array(
            'action' => $this->generateUrl('usertotask_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserToTask entity.
     *
     * @Route("/new", name="usertotask_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserToTask();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserToTask entity.
     *
     * @Route("/{id}", name="usertotask_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('tBundle:UserToTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserToTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserToTask entity.
     *
     * @Route("/{id}/edit", name="usertotask_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('tBundle:UserToTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserToTask entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a UserToTask entity.
    *
    * @param UserToTask $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserToTask $entity)
    {
        $form = $this->createForm(new UserToTaskType(), $entity, array(
            'action' => $this->generateUrl('usertotask_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserToTask entity.
     *
     * @Route("/{id}", name="usertotask_update")
     * @Method("PUT")
     * @Template("tBundle:UserToTask:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('tBundle:UserToTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserToTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usertotask_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a UserToTask entity.
     *
     * @Route("/{id}", name="usertotask_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('tBundle:UserToTask')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserToTask entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usertotask'));
    }

    /**
     * Creates a form to delete a UserToTask entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usertotask_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
