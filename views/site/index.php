<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use app\components\grammar\languages\russian\rules\Cases;
use app\models\Word;

/* @var $this yii\web\View */
/* @var $model \app\models\Word */
/* @var $cases array */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'word')
                    ->hint('Слово должно быть существительным в иминительном падеже единственного числа'); ?>
                <?= Html::submitButton('Просколнять', ['class' => 'btn btn-primary']) ?>
            <?php $form = ActiveForm::end(); ?>
        </div>
        <?php if (isset($cases)) : ?>
            <div class="col-md-12" style="margin-top: 15px;">
                <table class="table table-bordered table-hover">
                    <thead>
                    <th>Название падежа</th>
                    <th>Единственное число</th>
                    </thead>
                     <tbody>
                         <?php foreach ($cases as $label => $case) : $labels = Cases::getLabels(); ?>
                             <tr>
                                 <td><?= $labels[$label]; ?></td>
                                 <td><?= $case; ?></td>
                             </tr>
                         <?php endforeach; ?>
                     </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if ($topUsers = Word::find()->topUsers(10, 7)): ?>
            <div class="col-md-12">
                <h3>Топ 10 пользователей, которые склоняли слово больше 3 раз за неделю</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>IP Адресс пользователя</th>
                        <th>Слово</th>
                        <th>Количество</th>
                    </thead>
                    <tbody>
                    <?php foreach ($topUsers as $user) : $labels = Cases::getLabels(); ?>
                        <tr>
                            <td><?= $user['user_ip']; ?></td>
                            <td><?= $user['word']; ?></td>
                            <td><?= $user['word_count']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <h5 class="text-danger">На данный момент нет пользователей.</h5>
        <?php endif; ?>

    </div>
</div>
