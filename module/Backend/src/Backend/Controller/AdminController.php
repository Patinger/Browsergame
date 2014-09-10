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
use Backend\Form\UserfahrzeugForm;
use Application\Controller\AppController;
use Application\Entity\Userfahrzeug;

class AdminController extends AppController
{
    public function indexAction()
    {
        
        $id = (int) $this->identity()->id;
        if (!$id) 
        {
            return $this->redirect()->toRoute('home');
        }
        $user = $this->getObjectManager()->getRepository('Application\Entity\User')->findAll();
        $userfahrzeuge = $this->getObjectManager()->getRepository('Application\Entity\Userfahrzeug')->findAll();

        return new ViewModel(array(
            'user' => $user,
            'userfahrzeuge' => $userfahrzeuge,
        ));
    }

    public function deletefahrzeugAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) 
        {
            return $this->redirect()->toRoute('admin');
        }
        $userfahrzeug = $this->getObjectManager()->getReference('Application\Entity\Userfahrzeug', $id);
        $this->getObjectManager()->remove($userfahrzeug);
        $this->getObjectManager()->flush();

        return $this->redirect()->toRoute('admin');
    }

    public function deleteuserAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || $id == $this->identity()->id) 
        {
            return $this->redirect()->toRoute('admin');
        }

        $userfahrzeuge = $this->getObjectManager()->getRepository('Application\Entity\Userfahrzeug')->findAll();
        foreach($userfahrzeuge as $userfahrzeug){
            if($userfahrzeug->getUser_id() == $id){
                $this->getObjectManager()->remove($userfahrzeug);
            }
        }
        
        $user = $this->getObjectManager()->getReference('Application\Entity\User', $id);
        $this->getObjectManager()->remove($user);
        $this->getObjectManager()->flush();

        return $this->redirect()->toRoute('admin');
    }
}
