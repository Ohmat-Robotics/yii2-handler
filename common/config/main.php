<?php
return [
	'aliases'    => [
		'@bower' => '@vendor/bower-asset' ,
		'@npm'   => '@vendor/npm-asset' ,
	] ,
	'vendorPath' => dirname(dirname(__DIR__)).'/vendor' ,
	'components' => [
		'cache'    => [
			'class' => 'yii\caching\FileCache' ,
		] ,
		'response' => [
			'class'         => 'yii\web\Response' ,
			'on beforeSend' => function($event = false){
				try{
					$e = \Yii::$app->getErrorHandler()->exception;
					if($e){
						\common\helpers\Handler::addException($e);
					}
				}catch(Exception $exception){
					\common\helpers\Handler::addException($e);
				}
				return false;
			} ,
		] ,
	] ,
];
