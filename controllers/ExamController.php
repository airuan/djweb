<?php

namespace app\controllers;

use Yii;
use app\models\forms\ExamForm;

class ExamController extends \yii\web\Controller {

    public function actionIndex() {
        $this->layout = "exam_main";

        $model = new ExamForm();
        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
        }
        return $this->render('index', [
                    'model' => $model
        ]);
    }

}
