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

class MeineautosController extends AppController
{
    public function indexAction()
    {
    	$form = new UserfahrzeugForm($this->getObjectManager());


        if(!isset($this->identity()->id))
        {
            return $this->redirect()->toRoute('home');
            
        }

        $userfahrzeug = new Userfahrzeug();
        $form->bind($userfahrzeug);

        if ($this->request->isPost()) {
            $myPost=$this->request->getPost();
            if(isset($myPost['user_id'])){
                $myPost['user_id'] = $this->identity()->id;
                $form->setData($myPost);
                if ($form->isValid()) 
                {
                    $data = $form->getData();
                    try{
                        $this->getObjectManager()->persist($userfahrzeug);
                        $this->getObjectManager()->flush();
                    }
                    catch (\Exception $ex) 
                    {

                    }
                }
            }
        }

        $userfahrzeugArray = $this->getObjectManager()->getRepository('Application\Entity\Userfahrzeug')->findBy(array('user_id' => $this->identity()->id));


        return new ViewModel(array(
        	'form' => $form,
            'userfahrzeugArray' => $userfahrzeugArray,
        ));
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) 
        {
            return $this->redirect()->toRoute('meineautos');
        }
        $userfahrzeug = $this->getObjectManager()->getReference('Application\Entity\Userfahrzeug', $id);
        if($userfahrzeug->getUser_id() == $this->identity()->id){
            $this->getObjectManager()->remove($userfahrzeug);
            $this->getObjectManager()->flush();
        }

        return $this->redirect()->toRoute('meineautos');
    }

    public function editAction()
    {
        if ($this->request->isPost()) {
            if(isset($this->request->getPost()['id']) && isset($this->request->getPost()['letztepruefung'])){
                $id = (int) $this->request->getPost()['id'];
                if (!$id) 
                {
                    return $this->redirect()->toRoute('meineautos');
                }
                $userfahrzeug = $this->getObjectManager()->getReference('Application\Entity\Userfahrzeug', $id);

                if($userfahrzeug->getUser_id() == $this->identity()->id){
                    try{
                        $userfahrzeug->setLetztepruefung(new \DateTime($this->request->getPost()['letztepruefung']));
                        $this->getObjectManager()->persist($userfahrzeug);
                        $this->getObjectManager()->flush();
                    }catch (\Exception $ex) {
                    }
                }
            }
        }
        return $this->redirect()->toRoute('meineautos');
    }
}
