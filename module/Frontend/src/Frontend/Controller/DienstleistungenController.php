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

class DienstleistungenController extends AppController
{
    public function aenderungsabnahmeAction()
    {
        return new ViewModel();
    }
    public function hauptuntersuchungAction()
    {
        return new ViewModel();
    }
    public function schadengutachtenAction()
    {
        return new ViewModel();
    }
    public function sicherheitspruefungAction()
    {
        return new ViewModel();
    }
    public function oldtimergutachtenAction()
    {
        return new ViewModel();
    }
}
