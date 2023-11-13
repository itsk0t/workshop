<?php

namespace app\controllers;

use app\models\Applications;
use app\models\Category;
use app\models\Reviews;
use app\models\Services;
use app\models\SignupForm;
use app\models\Timetable;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'account'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $services = Category::find()->all();
        $timetable = Timetable::find()->all();
        return $this->render('index', ['services' => $services, 'timetable' => $timetable]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->isAdmin()) {
                return $this->redirect(['admin/']);
            }
            return $this->redirect(['site/account']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($user = $model -> signupSave())
            {
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionServicesinfo()
    {
        $services = Services::find()->all();
        $category = Category::find()->where(['id'=>$_GET['id']])->asArray()->one();
        return $this->render('servicesinfo', ['category'=>$category, 'services' => $services]);
    }

    public function actionServicesdetail()
    {
        $services = Services::find()->where(['id'=>$_GET['id']])->asArray()->one();
        return $this->render('servicesdetail', ['services'=>$services]);
    }

    public function actionApplications()
    {
        $model = new Applications();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success', 'Заявка отправлен успешно.');
                return $this->refresh();
            }
        }

        return $this->render('applications', ['model'=>$model]);
    }

    public function actionAccount()
    {
        $myapplications = Applications::find()->where(['user_id'=>Yii::$app->user->getId()])->all();
        return $this->render('account', compact('myapplications'));
    }

    public function actionReviews()
    {
        $reviews = Reviews::find()->all();;
        $model = new Reviews();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success', 'Отзыв отправлен.');
                return $this->refresh();
            }
        }

        return $this->render('reviews', compact('model', 'reviews')/*['model'=>$model, 'reviews'=>$reviews]*/);
    }
}
