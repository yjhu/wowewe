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
	),
	'orderRoutes'=>array(
		'guodu'=>array(
			'weight'=>100, 
			'config'=>array(
				'class'=>'app\models\sm\ESmsGuodu',
				'isOrder' => true,	
			),
		),
	),

];


