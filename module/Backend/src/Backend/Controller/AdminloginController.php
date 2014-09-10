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
use Backend\Form\LoginForm;
use Backend\Form\RegistrationForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Application\Entity\User;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Application\Controller\AppController;

class AdminloginController extends AppController 
{

    protected $storage;
    protected $authservice;
     
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
         
        return $this->authservice;
    }

    public function indexAction()
    {
        return $this->redirect()->toRoute('adminlogin/login');
    }

    public function loginAction()
    {
    	$form  = new LoginForm('', false, $this->getServiceLocator());
        $request = $this->getRequest();

        if ($request->isPost()){

            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                    ),
                ),
            )));
            $form->setInputFilter($inputFilter);
            $form->setData($request->getPost());
            if ($form->isValid()){
                //check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity(''.$request->getPost('username'))
                                       ->setCredential(''.$request->getPost('password'));
                                        
                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }
                 
                if ($result->isValid()) 
                {
                    $this->getAuthService()->getStorage()->write($this->getAuthService()->getAdapter()->getResultRowObject(null));
                    return $this->redirect()->toRoute('admin');
                }
            }
        }

        return array(
            'form' => $form,
        );
    }
}
