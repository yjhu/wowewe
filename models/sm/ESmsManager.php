<?php

namespace app\models\sm;

use Yii;
use app\models\U;

class ESmsManager extends \yii\base\Object
{
	private $_commRoutes=array();
	
	private $_commRoutesWeight=array();	

	private $_orderRoutes=array();
	
	private $_orderRoutesWeight=array();	

	public function init()
	{
		parent::init();
		foreach($this->_commRoutes as $channel=>$row)
		{
			$route=Yii::createObject($row['config']);
			$route->init();
			$this->_commRoutes[$channel] = $route;
			$this->_commRoutesWeight[$channel] = $row['weight'];			
		}

		foreach($this->_orderRoutes as $channel=>$row)
		{
			$route=Yii::createObject($row['config']);
			$route->init();
			$this->_orderRoutes[$channel] = $route;
			$this->_orderRoutesWeight[$channel] = $row['weight'];			
		}		
	}

	public function getCommRoutes()
	{
		return $this->_commRoutes;
	}

	public function setCommRoutes($config)
	{
		foreach($config as $channel=>$route)
			$this->_commRoutes[$channel]=$route;
	}

	public function getOrderRoutes()
	{
		return $this->_orderRoutes;
	}

	public function setOrderRoutes($config)
	{
		foreach($config as $channel=>$route)
			$this->_orderRoutes[$channel]=$route;
	}

	public function S($mobiles_str, $message, $sendtime='', $channel=null, $isOrder=false, $params=array())
	{
		if (empty($channel))
		{
			if ($isOrder)
				$channel = U::getRandomWeightedElement($this->_orderRoutesWeight);	
			else
				$channel = U::getRandomWeightedElement($this->_commRoutesWeight);
		}
		$route = $isOrder ? $this->_orderRoutes[$channel] : $this->_commRoutes[$channel];
		$route->S($mobiles_str, $message, $sendtime, $params);
		return $route;
	}

}
