<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use app\components\grammar\languages\russian\rules\Cases;

/* @var $this yii\web\View */
/* @var $model \app\models\Word */
/* @var $cases array */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'word') ?>
            <?= Html::submitButton('Просколнять', ['class' => 'btn btn-primary']) ?>
            <?php $form = ActiveForm::end(); ?>
        </div>
        <?php if (isset($cases)) : ?>
            <div class="col-md-12" style="margin-top: 15px;">
                <table class="table table-bordered table-hover">
                    <?php foreach ($cases as $label => $case) : $labels = Cases::getLabels(); ?>
                        <tr>
                            <td><?= $labels[$label]; ?></td>
                            <td><?= $case; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
