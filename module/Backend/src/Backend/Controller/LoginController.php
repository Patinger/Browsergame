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

class LoginController extends AppController 
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
        return $this->redirect()->toRoute('login/login');
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
                    return $this->redirect()->toRoute('bhome');
                }
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function registrationAction(){
        $form  = new RegistrationForm($this->getObjectManager());
        $errorMassage = '';

        $user = new User();
        $form->bind($user);

        if ($this->request->isPost()) {
            if($this->request->getPost()['password'] == $this->request->getPost()['confirmPassword']){
                $this->request->getPost()['password'] = md5($this->request->getPost()['password']);
                $form->setData($this->request->getPost());
                if ($form->isValid()) 
                {
                    $data = $form->getData();
                    try{
                        $this->getObjectManager()->persist($user);
                        $this->getObjectManager()->flush();
                    }
                    catch (\Exception $ex) 
                    {
                        $errorMassage = 'Beim einfügen in die Datenbank ist etwas schief gelaufen (Username schon vergeben?)!';
                        return array(
                            'form' => $form,
                            'error' => $errorMassage
                        );
                    }
                    return $this->redirect()->toRoute('login', array(
                        'action' => 'login'
                    ));
                }
            } else {
               $errorMassage = 'Passwort stimmt nicht überein!';
            }
        }

        return array(
            'form' => $form,
            'error' => $errorMassage
        );
    }

    public function logoutAction()
    {
        $this->getAuthService()->clearIdentity();
         
        return $this->redirect()->toRoute('login');
    }
}
