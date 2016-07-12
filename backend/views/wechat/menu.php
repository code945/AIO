<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = '微信菜单管理';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile( yii\BaseYii::getAlias('@web/js/weixinmenu.js'),['depends'=>backend\assets\AppAsset::className()]);
$this->registerJsFile( yii\BaseYii::getAlias('@web/js/jquery.form.js'),['depends'=>backend\assets\AppAsset::className()]);
?>


<div id="menuEditor">
    <h3>使用说明及规则，请仔细阅读</h3>
    <ul>
        <li>官方要求：一级菜单按钮个数为2-3个</li>
        <li>官方要求：如果设置了二级菜单，子按钮个数为2-5个</li>
        <li>官方要求：按钮描述，既按钮名字，不超过16个字节，子菜单不超过40个字节</li>
        <li>如果name不填，此按钮将被忽略</li>
        <li>如果一级菜单为空，该列所有设置的二级菜单都会被忽略</li>
        <li>key仅在SingleButton（单击按钮，无下级菜单）的状态下设置，如果此按钮有下级菜单，key将被忽略</li>
        <li>所有二级菜单都为SingleButton</li>
        <li>如果要快速看到微信上的菜单最新状态，需要重新关注，否则需要静静等待N小时</li>
    </ul>
    <p></p>
    <h3>编辑工具</h3>
    <form action="/wechat/menu-update" method="post" id="form_Menu" >


    <p>
        <input id="btnGetMenu" class="btn btn-info" type="button" value="获取当前菜单" />
        <input id="btnDeleteMenu" class="btn btn-info" type="button" value="删除菜单" />
    </p>
    <p class="menu-state">
        操作状态：<strong id="menuState">-</strong>
    </p>
    <div class="col-md-8">
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th></th>
                <th>第一列</th>
                <th>第二列</th>
                <th>第三列</th>
            </tr>
            </thead>
            <tbody>
            <?php
                for ($i = 0; $i < 6; $i++)
                {
                    $isRootMenu = $i == 5;
                    if($i == 5)
                        echo '<tr id="subMenuRow_'.$i .'""> <td>一级菜单按钮</td>';
                    else
                        echo '<tr id="rootMenuRow"><td>二级菜单No.'.($i + 1).'</td>';
                    for ($j = 0; $j < 3; $j++)
                    {
                        $namePrefix = $isRootMenu ?"menu.button[".$j."]": "menu.button[".$j."].sub_button[".$i."]";
                        $idPrefix = $isRootMenu ? "menu_button".$j : "menu_button".$j."_sub_button".$i;
                        $dataRoot = $isRootMenu ?'data-root="'.$j.'"':"";
                        $tds = '<td>'
                        .'<input type="hidden" class="control-input" name="'.$namePrefix.'.key" id="'.$idPrefix.'_key" />'
                        .' <input type="hidden" class="control-input" name="'.$namePrefix.'.type" id="'.$idPrefix.'_type" value="click" />'
                        .' <input type="hidden" class="control-input" name="'.$namePrefix.'.url" id="'.$idPrefix.'_url" />'
                        .'<input type="text" class="control-input" name="'.$namePrefix.'.name" id="'.$idPrefix.'_name" class="txtButton" data-i="'.$i.'" data-j="'.$j.'" '.$dataRoot.' />'
                        .'</td>';
                        echo $tds;
                    }
                    echo '</tr>';




                }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4" id="buttonDetails">
        <h3>按钮其他参数</h3>
        <p>Name：<input type="text" id="buttonDetails_name" class="control-input txtButton" disabled="disabled" /></p>
        <p>
            Type：
            <select id="buttonDetails_type" class="dllButtonDetails">
                <option value="click" selected="selected">点击事件（传回服务器）</option>
                <option value="view">访问网页（直接跳转）</option>
                <option value="location_Select">弹出地理位置选择器</option>
                <option value="pic_photo_or_album">弹出拍照或者相册发图</option>
                <option value="pic_sysphoto">弹出系统拍照发图</option>
                <option value="pic_weixin">弹出微信相册发图器</option>
                <option value="scancode_push">扫码推事件</option>
                <option value="scancode_waitmsg">扫码推事件且弹出“消息接收中”提示框</option>
            </select>
        </p>
        <p id="buttonDetails_key_area">
            Key：<input id="buttonDetails_key" class="control-input txtButtonDetails" type="text" />
        </p>
        <p id="buttonDetails_url_area">
            Url：<input id="buttonDetails_url" class="control-input txtButtonDetails" type="text" />
        </p>
        <p>
            如果还有下级菜单请忽略Type和Key、Url。<br />
        </p>
    </div>
    <div class="clear"></div>
    <div id="submitArea" class="col-md-12">
        <input type="button" class="btn btn-info" value="更新到服务器" id="submitMenu" />
    </div>
    </form>

</div>
<div style=" clear:both"></div>
