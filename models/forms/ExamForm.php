<?php
namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ExamForm extends Model
{
    public $type;
    public $mth;
    public $num = 30;
    public $date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['type', 'mth'], 'safe'],            
            ['num', 'required'],
            ['num','integer'],
            ['date','date']
        ];
    }
    
    public function attributeLabels() {
        return [
            'type' => '题型',
            'mth' => '运算方法',
            'num' => '题数',
            'date'=>'日期'
        ];
    }
}
