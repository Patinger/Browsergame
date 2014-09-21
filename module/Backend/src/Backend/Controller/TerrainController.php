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

class TerrainController extends AppController
{
    public function terrainjsonAction(){
    	if(!isset($this->identity()->id))
        {
            return $this->redirect()->toRoute('home');
        }
        $terrain = $this->getObjectManager()->createQuery('SELECT terrain.pos_x, terrain.pos_y, terrain.type FROM Application\Entity\Terrain terrain, Application\Entity\Explored explored WHERE explored.id_user = '.$this->identity()->id.' AND explored.id_terrain = terrain.id')
        	->getResult();
        //echo var_dump($terrain);

        $view = new ViewModel(array(
            'terrain' => $terrain,
        ));
        $view->setTerminal(true);
        return $view;
    }

    public function terrainexploreAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || !isset($this->identity()->id)) 
        {
            return $this->redirect()->toRoute('home');
        }

        /*$minion = $this->getObjectManager()->getReference('Application\Entity\Userfahrzeug', $id);
        if($userfahrzeug->getUser_id() == $this->identity()->id){
            $this->getObjectManager()->remove($userfahrzeug);
            $this->getObjectManager()->flush();
        }

        return $this->redirect()->toRoute('meineautos');*/
    }
}
