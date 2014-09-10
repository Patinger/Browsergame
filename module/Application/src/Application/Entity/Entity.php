<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
class Entity {
    /**
	* Magic getter to expose protected properties.
	*
	* @param string $property
	* @return mixed
	*/
	/*public function __call($func, $params)
	{
		$property = $this->extractProperty($func);
		if (count($params == 1))
		{
			if (substr($func, 0, 3) == 'set')
			{
				$this->$property = $params[0];
			}
			if (substr($func, 0, 3) == 'get')
			{
				return $this->$property;
			}
		}
	}
*/
	protected function extractProperty($prop)
	{
		$propertyShort = lcfirst(substr($prop, 3));
		$property = $propertyShort[0];
		for ($i = 1; $i< strlen($propertyShort); $i++)
		{
			if (ord($propertyShort[$i]) >= 65 && ord($propertyShort[$i]) <= 90)
			{

				$property .= '_'.strtolower($propertyShort[$i]);
			}
			else
			{
				$property .= $propertyShort[$i];
			}
		/*$property[$i] = 'Z';
		echo ord($property[$i]).'<br/>';*/
		}
		return $property;
	}

}