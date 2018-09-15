<?php
/**
 * Created by PhpStorm.
 * User: boss
 * Date: 15.09.18
 * Time: 1:30
 */

namespace common\helpers;

use Yii;
/**
 * Class Handler - handler of errors or messages
 *
 * @package common\helpers
 */
class Handler{
	
	/**
	 * @param     $array|string
	 * @param int $category
	 */
	private static function add($array, $category=1, $full_info=false){
		
		// yii log file
		Yii::debug($array,$category);
		
		// admin log for debug
		if($full_info){
			if(\Yii::$app->id == "app-console"){
				$who = "CONSOLE \n\n";
			}else{
				$uid = empty(Yii::$app->user->id) ? "empty" : Yii::$app->user->id;
				$ip = empty(Yii::$app->request->userIP) ? "empty" : Yii::$app->request->userIP;
				$who = "USER_ID=<b>".$uid."</b> "."USER_IP=<b>".$ip."</b>";
			}
			
			$url = empty(\Yii::$app->request->absoluteUrl) ? "no url" : \Yii::$app->request->absoluteUrl;
			$url_from = empty(\Yii::$app->request->referrer) ? "no url from" : \Yii::$app->request->referrer;
			$text = [];
		}
		$text[] = '<b>'.date("d.m.Y H:i:s ").'</b>';
		
		if(!empty($array['message'])){
			$text[] = '';
			$text[] = '<b>'.$array['message'].'</b>';
			$text[] = '';
			unset($array['message']);
		}
		
		if($full_info){
			$text[] = "URL: <b>".$url.'</b>';
			$text[] = "URL REFERRER: <b>".$url_from.'</b>';
			$text[] = $who;
			$text[] = '';
		}
		
		if(is_array($array)){
			$array = implode("\n", $array);
		}
		$text[] = $array;
		
		//message
		$er = new \common\models\Handler();
		$er->date = time();
		$er->category = (int)$category;
		$er->text = implode("\n", $text);
		$er->save();
	}
	
	/**
	 * 1
	 * @param      $text array|string
	 * @param bool $full_info
	 */
	public static function addText($text, $full_info=false){
		try{
			if(!empty($text)){
				self::add($text, 1, $full_info);
			}
		}catch(\Exception $e){
			self::addCatch($e);
		}
	}
	
	/**
	 * 2
	 * @param      $text array|string
	 * @param bool $full_info
	 */
	public static function addMessage($text, $full_info=false){
		try{
			if(!empty($text)){
				self::add($text, 2, $full_info);
			}
		}catch(\Exception $e){
			self::addCatch($e);
		}
	}
	
	/**
	 * 3
	 * @param      $text array|string
	 * @param bool $full_info
	 */
	public static function addError($text, $full_info=true){
		try{
			if(!empty($text)){
				self::add($text, 3, $full_info);
			}
		}catch(\Exception $e){
			self::addCatch($e);
		}
	}
	
	/**
	 * 4
	 * @param      $exception
	 * @param bool $full_info
	 */
	public static function addException($exception, $full_info=true){
			try{
				if(!empty($exception)){
					self::add([
						'message' => $exception->getMessage(),
						$exception->getTraceAsString()
					          ], 4, $full_info);
				}
			}catch(\Exception $e){
				self::addCatch($e);
			}
	}
}