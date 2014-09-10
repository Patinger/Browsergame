<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backend\Form\UserForm;
use Application\Controller\AppController;
use Application\Entity\Userfahrzeug;

class UserController extends AppController
{
    public function indexAction()
    {
        $form  = new UserForm($this->getObjectManager());

        $id = (int) $this->identity()->id;
        if (!$id) 
        {
            return $this->redirect()->toRoute('home');
        }
        $user = $this->getObjectManager()->getReference('Application\Entity\User', $id);
        $form->bind($user);
        //if (!$form->isValid()) return $this->redirect()->toRoute('home');

        return new ViewModel(array(
            'form' => $form,
            'user' => $user,
        ));
    }

    public function editAction()
    {
        if ($this->request->isPost()) {
            $id = (int) $this->identity()->id;
            if (!$id) 
            {
                return $this->redirect()->toRoute('home');
            }

            try 
            {
                $user = $this->getObjectManager()->getRepository('Application\Entity\User')->find($id);
            }
            catch (\Exception $ex) 
            {
                return $this->redirect()->toRoute('home');
            }

            $form  = new UserForm($this->getObjectManager());
            $form->bind($user);
            $form->setData($this->request->getPost());

            if ($form->isValid()) {

                $this->getObjectManager()->persist($user);
                $this->getObjectManager()->flush();

                return $this->redirect()->toRoute('user');
            }
        }
        return $this->redirect()->toRoute('user');
    }
}
