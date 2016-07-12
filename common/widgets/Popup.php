<?php

namespace common\widgets;

class Popup extends \yii\bootstrap\Widget
{
    /**
     * 样式数组
     * @var [type]
     */
    public $popupTypes = [
        'default'   => 'BootstrapDialog.TYPE_DEFAULT',
        'info'  => 'BootstrapDialog.TYPE_INFO',
        'primary' => 'BootstrapDialog.TYPE_PRIMARY',
        'success'    => 'BootstrapDialog.TYPE_SUCCESS',
        'warning' => 'BootstrapDialog.TYPE_WARNING',
        'danger' => 'BootstrapDialog.TYPE_WARNING'
    ];
    /**
     * 尺寸数组
     * @var [type]
     */
    public $sizeTypes=[
        'nomal'=>'BootstrapDialog.SIZE_NORMAL',
        'small'=>'BootstrapDialog.SIZE_SMALL',
        'wide'=>'BootstrapDialog.SIZE_WIDE',
        'large'=>'BootstrapDialog.SIZE_LARGE'

    ];
    /**
     * 标题
     * @var [type]
     */
    public $title;
    /**
     * 尺寸
     * @var [type]
     */
    public $size;

    public function init()
    {
        parent::init();
        //默认标题
        if ($this->title === null) {
            $this->title = '消息提示';
        }
        //默认样式
        if ($this->size===null || !isset($this->sizeTypes[$this->size])){
            $this->size='small';
        }

        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();

        $view = $this->getView();

        foreach ($flashes as $type => $data) {
            if (isset($this->popupTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $i => $message) {
                    $view->registerJs("
                        var dialogShow=BootstrapDialog.show({
                            type:".$this->popupTypes[$type].",
                            title:'".$this->title."',
                            message:'".$message."',
                            size:".$this->sizeTypes[$this->size].",
                            buttons:[
                                {
                                    label: '关闭',
                                    action: function(dialogItself){
                                        dialogItself.close();
                                    }
                                }
                            ]
                        });
                    ");
                    // 如果是成功，需要增加3s后自动关闭，其余警告等则不需要
                    if($type=='success'){
                        $view->registerJs("
                            setTimeout(function(){ dialogShow.close() }, 1500);
                        ");
                    }
                }

                $session->removeFlash($type);
            }
        }
    }
}