<?php

return [
	'class' => 'app\models\sm\ESmsManager',
	'commRoutes'=>array(
		'guodu'=>array(
			'weight'=>100, 
			'config'=>array(
				'class'=>'app\models\sm\ESmsGuodu',
			),
		),
		'ymt'=>array(
			'weight'=>0, 
			'config'=>array(
				'class'=>'app\models\sm\ESmsYmt',
			)
		),				
		'juxin'=>array(
			'weight'=>0, 
			'config'=>array(
				'class'=>'app\models\sm\ESmsJuxin',
			),
		),
	),
	'orderRoutes'=>array(
		'guodu'=>array(
			'weight'=>100, 
			'config'=>array(
				'class'=>'app\models\sm\ESmsGuodu',
				'isOrder' => true,	
			),
		),
		'ymt'=>array(
			'weight'=>0, 
			'config'=>array(
				'class'=>'app\models\sm\ESmsYmt',
				'isOrder' => true,	
			)
		),				
		'juxin'=>array(
			'weight'=>0, 				
			'config'=>array(
				'class'=>'app\models\sm\ESmsJuxin',
				'isOrder' => true,	
			)
		),				
	),

];


