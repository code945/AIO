<?php

namespace modules\wechat\controllers;

use EasyWeChat\Foundation\Application;
use Overtrue\Socialite\User;
use Yii;
use yii\base\Object;
use yii\web\Controller;

/**
 * Default controller for the `wechat` module
 */
class MenuController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionUpdate()
    {
        $btns = [];
        for($i=0;$i<3;$i++)
        {
            $item = $this->getMenuItem(Yii::$app->request->bodyParams['menu_button_'.$i]);
            if(isset($item))
                $btns[] = $item;
        }
        $config = [
            'app_id' => 'wxb8328f360729fe40',
            'secret' => '2a88c8d45c9d4457edec92d8a3f51d90',
            'token'  => 'leotest',
        ];
        $app = new Application($config);
        //$app->menu->add($btns);
    }


    /**
     * @param $data array
     * @return array|null
     */
    function getMenuItem($data)
    {
        $result = [];
        if(isset($data["name"]) && !empty($data["name"]))
        {
            $subs = [];
            $result = [
                "type" =>  $data["type"],
                "name" => $data["name"],
                "url" => $data["url"],
                "key"  => $data["key"]
            ];
            for($i=0;$i<5;$i++)
            {
                if( isset($data["sub".$i]) )
                    $subs[] = $this->getMenuItem($data["sub".$i]);
            }
            if(isset($subs))
                $result[ "sub_button"] = $subs;

            return  $result;
        }
        else
            return null;
    }


}
