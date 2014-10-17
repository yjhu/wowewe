<?php
namespace app\models;
use Yii;
use yii\base\Model;
use ReflectionClass;

class FiltersForm extends Model
{
    private $_filters = array(); 

    private static $_names = array();

    public function attributeNames()
    {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }

    public function isAttributeActive($attribute)
    {
        return true;
    }

    public function __get($name) 
    {  
        if (!isset($this->_filters[$name]))
        $this->_filters[$name] = '';
        
        return $this->_filters[$name];
    } 

    public function __set($name, $value) 
    {  
        $this->_filters[$name] = $value; 
        
        return true;
    } 

    public function setAttributes($values,$safeOnly=true)
    {
        if(!is_array($values))
            return;
            
        foreach($values as $name=>$value)
        {
            $this->$name=$value;
        }
    }

    public function unsetAttributes($names=null)
    {
        if($names===null)
            $names=$this->attributeNames();
            
        foreach($names as $name)
            $this->$name=null;
    }

    public function filterArrayData($rawData)
    {
        $temp = $rawData;
        foreach ($temp as $index => $item)
        {
            foreach ($this->_filters as $key => $value)
            {
                if($value == '') 
                continue;

                $test = false;
                if($item instanceof Model)
                {
                    if(isset($item->$key) == false ) 
                        throw new Exception("Property ".get_class($item)."::{$key} does not exist!");
                    $test = $item->$key;
                }
                else if(is_array($item))
                {
                    if(!array_key_exists($key, $item)) 
                        throw new Exception("Key {$key} does not exist in Array!");
                    $test = $item[$key];
                }
                else if(is_object($item))
                {
                    if(isset($item->$key) == false ) 
                        throw new Exception("Property ".get_class($item)."::{$key} does not exist!");
                    $test = $item->$key;
                }
                else
                    throw new Exception("Data in ArrayDataProvider must be an array of arrays or Models or object!");

                if(stripos($test, $value) === false)
                unset($temp[$index]);
            }
        }
        
        return $temp;
    }

}

