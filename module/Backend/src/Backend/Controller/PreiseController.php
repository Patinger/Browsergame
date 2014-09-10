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
use Application\Controller\AppController;

class PreiseController extends AppController
{
	protected $gtueData;

    public function indexAction()
    {

        $this->getGtueData();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $myPost = $request->getPost();
            if(isset($myPost['id'])&&isset($myPost['preis'])&&isset($myPost['database'])){
                try{
                    $this->gtueData->setpreis($myPost['database'], $myPost['id'], $myPost['preis']);
                }
                catch (\Exception $ex) 
                {
                }
            }
        }

        return new ViewModel(array(
            'gtueData' => $this->gtueData,
        ));
    }

    public function getGtueData()
    {
        if (!$this->gtueData) {
            $sm = $this->getServiceLocator();
            $this->gtueData = $sm->get('Backend\Model\GtueData');
        }
        return $this->gtueData;
    }
}
