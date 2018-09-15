<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HandleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Handlers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="handler-index">
	
	<h1><?= Html::encode($this->title) ?></h1>
	<?php Pjax::begin(); ?>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<p>
		<?= Html::a('Delete all messages' , \yii\helpers\Url::to(['/handler/delete-all']) , ['class' => 'btn btn-primary' , 'data' => ['confirm' => 'Are you sure?']]); ?>
	</p>
	<?= Html::tag('div' ,GridView::widget([
		                     'dataProvider' => $dataProvider ,
		                     'filterModel'  => $searchModel ,
		                     'columns'      => [
			                     //            ['class' => 'yii\grid\SerialColumn'],
			
			                     //            'id',
			                     //            'category',
			
			                     [
				                     'label'     => 'Handler' ,
				                     'attribute' => 'text' ,
//				                     'filter'    => "" ,
				                     'format'    => 'raw' ,
				                     'value'     => function($data){
					                     $text = strip_tags($data->text , '<b><br><br />');
					                     $text = str_replace("\n" , "<br>" , $text);
//					                     $text = '<b>'.date("d.m.Y H:i:s" , $data->date).'</b><br />'.$text;
					
					                     switch($data->category){
						                     case 2:
							                     $cl = 'handlerMessage';
							                     break;
						                     case 3:
							                     $cl = 'handlerError';
							                     break;
						                     case 4:
							                     $cl = 'handlerException';
							                     break;
						                     default:
							                     $cl = 'handlerText';
							                     break;
					                     }
					
					                     return Html::tag('div' , $text.Html::tag('span' , 'X') , ['class' => 'handler '.$cl , 'data-id' => $data->id]);
				                     } ,
			                     ] ,
		                     ] ,
	                     ]),['class'=>'handler-table']); ?>
	<?php Pjax::end(); ?>
</div>
