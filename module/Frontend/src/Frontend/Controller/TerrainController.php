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
        $terrain = $this->getObjectManager()->createQuery('SELECT terrain.pos_x, terrain.pos_y, terrain.type FROM Application\Entity\Terrain terrain, Application\Entity\Explored explored WHERE explored.id_user = 1 AND explored.id_terrain = terrain.id')
        	->getResult();
        //echo var_dump($terrain);

        $view = new ViewModel(array(
            'terrain' => $terrain,
        ));
        $view->setTerminal(true);
        return $view;
    }
}
