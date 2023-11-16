<?php

use app\models\Applications;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ApplicationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'surname',
            'email:email',
            'phone_number',
            'body:ntext',
            ['attribute'=>'services_id',
                'value'=>'services.title'],
            ['attribute'=>'user_id',
                'value'=>'user.username'],
            [
                    'attribute' => 'status',
                    'value' => function($data){return $data->getStatus();},
            ],
            [
                    'attribute'=>'Администрирование',
                    'format'=>'html',
                    'value'=>function($data){
                        switch ($data->status) {
                            case 0:
                                return Html::a('Одобрить', Url::toRoute(['applications/good']))."|".Html::a('Отклонить', Url::toRoute(['applications/verybad']));
                            case 1:
                                return Html::a('Одобрить', Url::toRoute(['applications/good']));
                            case 2:
                                return Html::a('Отклонить', Url::toRoute(['applications/verybad']));
                        }
                    }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Applications $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
