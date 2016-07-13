<?php
use kartik\editable\Editable;

Yii::$container->set(Editable::className(), [
    'submitButton' => [
        'class' => 'btn btn-sm btn-success',
        'icon' => '<i class="glyphicon glyphicon-ok"></i>'
    ],
    'resetButton' => [
        'class' => 'btn btn-sm btn-danger',
        'icon' => '<i class="glyphicon glyphicon-remove"></i>',
        'data-dismiss' => "popover-x"
    ]
]);