<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class UserController extends AbstractActionController
{
    public function listAction()
    {
        $champ = $this->params()->fromRoute('tri_champ');
        $order = $this->params()->fromRoute('tri_order');
        
        $users = $this->getServiceLocator()->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->myFindAll($champ, $order);

        return new ViewModel(array(
            'users' =>  $users
        ));
    }

    public function addAction()
    {
        /* @var $form \Application\Form\UserForm */
        $form = $this->getServiceLocator()->get('formElementManager')->get('form.user');

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                /* @var $user \Application\Entity\User */
                $user = $form->getData();

                /* @var $serviceUser \Application\Service\UserService */
                $serviceUser = $this->getServiceLocator()->get('application.service.user');

                $serviceUser->saveUser($user);

                $this->redirect()->toRoute('users');
            }
        }

        return new ViewModel(array(
            'form'  =>  $form
        ));
    }

    public function removeAction()
    {
        //To do : Do Remove User
        $userToRemove = $this->getServiceLocator()->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->find($this->params()->fromRoute('user_id'));
    
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ('Oui' == $data['delete']) {
                /* @var $serviceUser \Application\Service\UserService */
                $serviceUser = $this->getServiceLocator()->get('application.service.user');
                //On vérifie que l'id passé dans le formulaire est bien celui de l'utilisateur à supprimer
                if($data['id'] == $userToRemove->getId()){
                    $this->flashMessenger()->addSuccessMessage('Suppression réussie !');
                    $serviceUser->removeUser($userToRemove);
                }
            }
            $this->redirect()->toRoute('users');
        }
        
        return new ViewModel(array(
            'users'  =>  $userToRemove
        ));
    
    }

    public function editAction()
    {
        /* @var $form \Application\Form\UserForm */
        $form = $this->getServiceLocator()->get('formElementManager')->get('form.user');

        $userToEdit = $this->getServiceLocator()->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->find($this->params()->fromRoute('user_id'));

        $form->bind($userToEdit);
        $form->get('firstname')->setValue($userToEdit->getFirstname());
        $form->get('lastname')->setValue($userToEdit->getLastname());
        $form->get('address')->setValue($userToEdit->getAddress());
        $form->get('birthdate')->setValue($userToEdit->getBirthdate());

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                /* @var $user \Application\Entity\User */
                $user = $form->getData();

                //Save the user
                /* @var $serviceUser \Application\Service\UserService */
                $serviceUser = $this->getServiceLocator()->get('application.service.user');
                $serviceUser->saveUser($user);

                $this->redirect()->toRoute('users');
            }
        }

        return new ViewModel(array(
            'form'  =>  $form
        ));
    }

}