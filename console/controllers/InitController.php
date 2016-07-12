<?php
/**
 * User: hongxu.lin
 * Date: 5/13/2016
 * Time: 6:30 PM
 */


namespace console\controllers;

use backend\models\Admin;
use common\models\Category;
use common\models\Post;
use common\models\PostTag;
use common\models\Tag;

class InitController extends \yii\console\Controller
{
    /**
     * Create init admin
     */
    public function actionAdmin()
    {
        echo "Create init admin ...\n";                  // 提示当前操作
        $username = $this->prompt('Admin Name:');        // 接收用户名
        $email = $this->prompt('Email:');               // 接收Email
        $password = $this->prompt('Password:');         // 接收密码
        $model = new Admin();                            // 创建一个新用户
        $model->username = $username;                   // 完成赋值
        $model->email = $email;
        $model->password = $password;//注意这个地方，用了Admin模型中的setPassword方法（魔术方法__set）
        if (!$model->save())                            // 保存新的用户
        {
            foreach ($model->getErrors() as $error)     // 如果保存失败，说明有错误，那就输出错误信息。
            {
                foreach ($error as $e)
                {
                    echo "$e\n";
                }
            }
            return 1;                                   // 命令行返回1表示有异常
        }
        return 0;                                       // 返回0表示一切OK
    }


    public function actionFakeCategoryUp()
    {
        echo "insert fake category ...\n";

        $transaction = Category::getDb()->beginTransaction();
        try {
            for($a=0;$a<2000;$a++)
            {
                $model = new Category();
                $model->name="Test Category".$a;
                $model->save();
                echo "insert ".$a."\n";
            }
            $transaction->commit();
            echo "transaction commited  ...\n";
        } catch(\Exception $e) {
            $transaction->rollBack();
            echo "transaction commited  failed,rollback ...\n";
        }

    }

    public function actionFakeCategoryDown()
    {
        echo "drop fake category data...\n";

        $transaction = Category::getDb()->beginTransaction();
        try {
            Category::deleteAll("name like 'Test Category%'");
            $transaction->commit();
            echo "transaction commited  ...\n";
        } catch(\Exception $e) {
            $transaction->rollBack();
            echo "transaction commited  failed,rollback ...\n";
        }
    }



    public function actionFakeBlogUp()
    {
        echo "insert fake post ...\n";

//        $transaction = Category::getDb()->beginTransaction();
        try {
            $cats=[1,2,3,4,5];
            $tags=[1,2,3,4,5,6,7,8,9,10];
            for($a=0;$a<200;$a++)
            {
                $model = new Post();
                $model->title="Test Post".$a;
                $model->category_id = $cats[array_rand($cats)];
                $model->content="testContent";
                $result = $model->save();
                echo "insert ".$a." result ".$result."\n";
                $tag = array_rand($tags,3);
                foreach ($tag as $item) {
                    $posttag = new PostTag();
                    $posttag->post_id = $model->id;
                    $posttag->tag_id = $tags[$item];
                    $posttag->save();
                }
            }
//            $transaction->commit();
            echo "transaction commited  ...\n";
        } catch(\Exception $e) {
//            $transaction->rollBack();
            echo "transaction commited  failed,rollback ...\n";
        }

    }

    public function actionFakeBlogDown()
    {
        echo "drop fake blog data...\n";

        $transaction = Post::getDb()->beginTransaction();
        try {
            Post::deleteAll("title like 'Test Post%'");
            $transaction->commit();
            echo "transaction commited  ...\n";
        } catch(\Exception $e) {
            $transaction->rollBack();
            echo "transaction commited  failed,rollback ...\n";
        }
    }





    public function actionFakeTagUp()
    {
        echo "insert fake tag ...\n";

        $transaction = Tag::getDb()->beginTransaction();
        try {
            for($a=0;$a<200;$a++)
            {
                $model = new Tag();
                $model->name="Test Tag".$a;
                $model->save();
                echo "insert ".$a."\n";
            }
            $transaction->commit();
            echo "transaction commited  ...\n";
        } catch(\Exception $e) {
            $transaction->rollBack();
            echo "transaction commited  failed,rollback ...\n";
        }

    }

    public function actionFakeTagDown()
    {
        echo "drop fake tag data...\n";

        $transaction = Tag::getDb()->beginTransaction();
        try {
            Tag::deleteAll("name like 'Test Tag%'");
            $transaction->commit();
            echo "transaction commited  ...\n";
        } catch(\Exception $e) {
            $transaction->rollBack();
            echo "transaction commited  failed,rollback ...\n";
        }
    }




}