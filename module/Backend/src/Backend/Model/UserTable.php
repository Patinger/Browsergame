<?php
namespace Backend\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select(function(Select $select){
       		$select->order( 'surname ASC, name ASC');
	    });	
    	return $resultSet;
    }

    public function getUser($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'name' => $user->name,
            'surname'  => $user->surname,
            'email' => $user->email,
            'username'  => $user->username,
            'password'  => $user->password
        );

        $id = (int)$user->id;
        if ($id == 0) 
        {
            $this->tableGateway->insert($data);
            $user->id = $this->tableGateway->lastInsertValue;
        } 
        else 
        {
            if ($this->getUser($id)) 
            {
                $this->tableGateway->update($data, array('id' => $id));
            } 
            else 
            {
                throw new \Exception('Form id does not exist');
            }
        }
        return $user;
    }

    public function deleteUser($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        $this->tableGateway->delete(array('id' => $id));
    }
}