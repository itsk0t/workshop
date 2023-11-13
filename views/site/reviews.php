<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Applications $model */
/** @var ActiveForm $form */
?>
<div class="site-proposal">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'body')->textInput(['autofocus'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<div>
    <?php foreach ($reviews as $el) { ?>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-text"><?php echo $el['body'] ?></h5>
                <p class="card-text"><span class="opacity-75">Отзыв отставил:</span> <?php echo $el->user->username ?></p>
            </div>
        </div>
    <?php } ?>
</div>

