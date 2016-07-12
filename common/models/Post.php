<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $lead_photo
 * @property string $lead_text
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $category_id
 * @property integer $sort
 *
 * @property Category $category
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }



    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category_id'], 'required'],
            [['lead_text', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_id', 'sort'], 'integer'],
            [['title',], 'string', 'max' => 128],
            [['lead_photo'], 'string', 'max' => 500],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题', 
            'lead_photo' => '图片',
            'lead_text' => '描述',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'category_id' => 'Category ID',
            'sort' => '排序',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryList($pid)
    {
        $model = Category::findAll(array('pid'=>null));
        if($pid != -1)
            $model = Category::findAll(array('pid'=>$pid));
        return ArrayHelper::map($model, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getPrePost()
    {
        $p = Post::find()
        ->where(['<', 'id', $this->id])
        ->orderBy([
            'id' => SORT_DESC
        ])
        ->limit(1)
        ->one();
        return $p;
    }

    public function getNextPost()
    {
        $p = Post::find()
            ->where(['>', 'id', $this->id])
            ->orderBy([
                'id'=>SORT_ASC,
            ])
            ->limit(1)
            ->one();
        return $p;
    }

}
