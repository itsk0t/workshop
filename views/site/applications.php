<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Applications $model */
/** @var ActiveForm $form */
?>
<div class="site-proposal">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus'=>true]) ?>
    <?= $form->field($model, 'surname')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'phone_number')->textInput()->widget(\yii\widgets\MaskedInput::class, ['mask' => '8-(999)-999-99-99']) ?>
    <?= $form->field($model, 'body')->textInput() ?>
    <?= $form->field($model, 'services_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Services::find()->all(), 'id', 'title')) ?>

    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="autoSizingCheck" required>
        <label class="form-check-label" for="autoSizingCheck">
            Согласен с правилами отправки заявки.
        </label>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-proposal -->
