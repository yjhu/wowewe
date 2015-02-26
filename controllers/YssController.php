<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\View;

use app\models\U;
use app\models\MUser;
use app\models\MUserSearch;


class YssController extends Controller
{
    //http://127.0.0.1/wx/web/index.php?r=yss/adabout
    public function actionAdabout()
    {
        $this->layout = 'yss';
        #$gh_id = U::getSessionParam('gh_id');
        #$openid = U::getSessionParam('openid');
        #Yii::$app->wx->setGhId($gh_id); 
        #return $this->render('adabout', ['gh_id'=>$gh_id, 'openid'=>$openid]);
        return $this->render('adabout');
    }    

    //http://127.0.0.1/wx/web/index.php?r=yss/teacher
    public function actionTeacher()
    {
        $this->layout = 'yss';
        #$gh_id = U::getSessionParam('gh_id');
        #$openid = U::getSessionParam('openid');
        #Yii::$app->wx->setGhId($gh_id); 
        #return $this->render('adabout', ['gh_id'=>$gh_id, 'openid'=>$openid]);
        return $this->render('teacher');
    }    

    //http://127.0.0.1/wx/web/index.php?r=yss/teacherx
    public function actionTeacherx()
    {
        $this->layout = false;
        #$gh_id = U::getSessionParam('gh_id');
        #$openid = U::getSessionParam('openid');
        #Yii::$app->wx->setGhId($gh_id); 
        #return $this->render('adabout', ['gh_id'=>$gh_id, 'openid'=>$openid]);
        return $this->render('teacherx');
    }    

    //http://127.0.0.1/wx/web/index.php?r=yss/teachery
    public function actionTeachery()
    {
        $this->layout = 'yss';
        #$gh_id = U::getSessionParam('gh_id');
        #$openid = U::getSessionParam('openid');
        #Yii::$app->wx->setGhId($gh_id); 
        #return $this->render('adabout', ['gh_id'=>$gh_id, 'openid'=>$openid]);
        return $this->render('teachery');
    }    

 
    //http://127.0.0.1/wx/web/index.php?r=yss/teacherz
    public function actionTeacherz()
    {
        $this->layout = false;
        #$gh_id = U::getSessionParam('gh_id');
        #$openid = U::getSessionParam('openid');
        #Yii::$app->wx->setGhId($gh_id); 
        #return $this->render('adabout', ['gh_id'=>$gh_id, 'openid'=>$openid]);
        return $this->render('teacherz');
    }

    //http://127.0.0.1/wx/web/index.php?r=yss/reserve
    public function actionReserve()
    {
        $this->layout = false;
        #$gh_id = U::getSessionParam('gh_id');
        #$openid = U::getSessionParam('openid');
        #Yii::$app->wx->setGhId($gh_id); 
        #return $this->render('adabout', ['gh_id'=>$gh_id, 'openid'=>$openid]);
        return $this->render('reserve');
    }


}

