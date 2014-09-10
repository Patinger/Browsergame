<?php
namespace Backend\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
/* Klasse zum lesen und schreiben der Preise
   Da diese Klasse einer der ersten war, die wir realisiert haben, benutzt sie noch kein Doctrine.
   Aus Zeitgründen konnten wir das leider nicht beheben.  
*/
class GtueData
{
    protected $fahrzeugGateway;
    protected $hauptuntersuchungGateway;
    protected $sicherheitspruefungGateway;
    protected $aenderungGateway;
    protected $oldtimerGateway;

    public function __construct(TableGateway $fahrzeugGateway, TableGateway $hauptuntersuchungGateway, TableGateway $sicherheitspruefungGateway, TableGateway $aenderungGateway, TableGateway $oldtimerGateway)
    {
        $this->fahrzeugGateway = $fahrzeugGateway;
        $this->hauptuntersuchungGateway = $hauptuntersuchungGateway;
        $this->oldtimerGateway = $oldtimerGateway;
        $this->aenderungGateway = $aenderungGateway;
        $this->sicherheitspruefungGateway = $sicherheitspruefungGateway;
    }

    // getPreise holt Preis aus der Datenbank
    public function getPreis($database, $fArt, $fMasse, $dLeistung){
        $fahrzeugRowset = $this->fahrzeugGateway->select(array('art' => $fArt,
                                                             'masse' => $fMasse));
        $row = $fahrzeugRowset->current();
        if (!$row) {
            throw new \Exception("Could not find row");
        }
        
        $databaseGateway;

        switch ($database) {
            case 'hu':
                $databaseGateway = $this->hauptuntersuchungGateway;
                break;
            case 'sp':
                $databaseGateway = $this->sicherheitspruefungGateway;
                break;
            case 'aenderung':
                $databaseGateway = $this->aenderungGateway;
                break;
            case 'oldtimer':
                $databaseGateway = $this->oldtimerGateway;
                break;
            default:
               throw new \Exception("Could not find Database");
        }

        $databaseRowset = $databaseGateway->select(array('id_fahrzeug' => $row['id'],
                                                            'leistung' => $dLeistung));
        $row = $databaseRowset->current();
        if (!$row) {
            throw new \Exception("Could not find row");
        }

        return $row;
    }

    // setPreis ändert Preis in der Datenbank
    public function setPreis($database, $pID, $preis){

        echo $pID;

        if(!preg_match('/^[0-9]+$/',$pID) || !preg_match('/^[0-9]+[,][0-9]{2}$/', $preis)){
               throw new \Exception("Variable not Valid");
        }

        $databaseGateway;

        switch ($database) {
            case 'hu':
                $databaseGateway = $this->hauptuntersuchungGateway;
                break;
            case 'sp':
                $databaseGateway = $this->sicherheitspruefungGateway;
                break;
            case 'aenderung':
                $databaseGateway = $this->aenderungGateway;
                break;
            case 'oldtimer':
                $databaseGateway = $this->oldtimerGateway;
                break;
            default:
               throw new \Exception("Could not find Database");
        }

        $databaseRowset = $databaseGateway->select(array('id' => $pID));
        $row = $databaseRowset->current();
        if (!$row) {
            throw new \Exception("Could not find row");
        }

        $data = array(
            //'id_author' => $book->id_author,
            'id_fahrzeug'  => $row['id_fahrzeug'],
            'leistung' => $row['leistung'],
            'preis'  => $preis
        );

        $databaseGateway->update($data, array('id' => $pID));
        return true;
    }
}