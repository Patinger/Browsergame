<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\AppController;

class TerrainController extends AppController
{
    public function terrainjsonAction(){
        $terrain = $this->getObjectManager()->getRepository('Application\Entity\Terrain')->findAll();

        $view = new ViewModel(array(
            'terrain' => $terrain,
        ));
        $view->setTerminal(true);
        return $view;
    }
}
