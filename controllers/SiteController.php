<?php

namespace app\controllers;

use app\components\grammar\languages\russian\rules\Cases;
use app\models\Word;
use app\components\grammar\languages\russian\Word as GrammarWord;
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
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
        $model = new Word();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_ip = Yii::$app->request->userIP;
            try {
                if (!$model->validate()) {
                    throw new \Exception('Passed data is incorrect');
                }
                $word = new GrammarWord($model->word);
                $case = Yii::createObject(Cases::class);
                $cases = [
                    Cases::caseIm => $word->getWord(),
                    Cases::caseRod => $case->transform($word, Cases::caseRod),
                    Cases::caseDat => $case->transform($word, Cases::caseDat),
                    Cases::caseVin => $case->transform($word, Cases::caseVin),
                    Cases::caseTvor => $case->transform($word, Cases::caseTvor),
                    Cases::casePred => $case->transform($word, Cases::casePred),
                ];

                if (!$model->save(false)) {
                    throw new \Exception('Error was occured trying to handling data!');
                }

                return $this->render('index', [
                    'model' => $model,
                    'cases' => $cases
                ]);

            } catch (\Exception $e) {
                Yii::$app->session->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
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
            return $this->goBack();
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
}
