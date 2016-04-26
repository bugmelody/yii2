meta programming
http://php.net/manual/en/function.is-callable.php
http://php.net/manual/en/function.method-exists.php
http://php.net/manual/en/function.get-called-class.php
http://php.net/manual/en/function.class-parents.php
http://php.net/manual/en/class.traversable.php
http://php.net/manual/en/class.iterator.php
http://php.net/manual/en/class.iteratoraggregate.php
http://php.net/manual/en/class.arrayaccess.php
http://php.net/manual/en/class.arrayiterator.php
http://php.net/manual/en/class.arrayobject.php
http://php.net/manual/en/language.types.callable.php


http://stackoverflow.com/questions/5197300/new-self-vs-new-static
http://stackoverflow.com/questions/15898843/what-means-new-static

http://www.jb51.net/article/54167.htm

====================================================
PHP手册
##############
php5.3 之后的一些功能

http://www.php.net/manual/en/language.namespaces.php
http://www.php.net/manual/en/language.oop5.traits.php
Late Static Bindings: http://php.net/manual/en/language.oop5.late-static-bindings.php

Closures Class: http://php.net/manual/en/class.closure.php
Closures (Lambda/Anonymous functions): http://php.net/manual/en/functions.anonymous.php
const: http://php.net/manual/en/language.constants.syntax.php
nowdoc: http://php.net/manual/en/language.types.string.php#language.types.string.syntax.nowdoc


http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
expr1 ?: expr3 returns expr1 if expr1 evaluates to TRUE, and expr3 otherwise.


Dynamic access to static methods is now possible:
<?php
class C {
   public static $foo = 123;
}

$a = "C";
echo $a::$foo;
?>


Exceptions can now be nested:
<?php
class MyCustomException extends Exception {}

try {
    throw new MyCustomException("Exceptional", 112);
} catch (Exception $e) {
    /* Note the use of the third parameter to pass $e
     * into the RuntimeException. */
    throw new RuntimeException("Rethrowing", 911, $e);
}
?>


Short array syntax has been added, e.g. $a = [1, 2, 3, 4]; or $a = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4];.

Function array dereferencing has been added, e.g. foo()[0].

<?= is now always available, regardless of the short_open_tag php.ini option.  (php5.4)

Class member access on instantiation has been added, e.g. (new Foo)->bar().
Class::{expr}() syntax is now supported.
Binary number format has been added, e.g. 0b001001101.

##############


匿名类(php7): http://php.net/manual/en/language.oop5.anonymous.php
====================================================
$ composer global require "fxp/composer-asset-plugin:~1.1.1"
$ composer create-project yiisoft/yii2-app-advanced qadmin 2.0.7
====================================================
$  php ./init
$  php ./yii migrate
====================================================
$ ./yii migrate/create create_article
====================================================
$ php composer.phar require --prefer-dist cliff363825/yii2-kindeditor "*"
https://github.com/cliff363825/yii2-kindeditor
====================================================
Yii2 小贴士集合:     http://www.getyii.com/topic/47
教你在 Yii2 中添加全局函数:    http://www.getyii.com/topic/171
====================================================
<?php
echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
  'class' => 'btn btn-danger',
  'data' => [
      'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
      'method' => 'post',
  ],
]) ?>
====================================================
model

const STATUS_NOT_ACTIVE = 1;
const STATUS_ACTIVE = 2;
const STATUS_DELETED = 3;

/**
 * Returns user statuses list
 * @return array|mixed
 */
public static function statuses()
{
    return [
        self::STATUS_NOT_ACTIVE => Yii::t('common', 'Not Active'),
        self::STATUS_ACTIVE => Yii::t('common', 'Active'),
        self::STATUS_DELETED => Yii::t('common', 'Deleted')
    ];
}
#####
view

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'username',
        'email:email',
        [
            'class' => EnumColumn::className(),
            'attribute' => 'status',
            'enum' => User::statuses(),
            'filter' => User::statuses()
        ],
        'created_at:datetime',
        'logged_at:datetime',
        // 'updated_at',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

====================================================
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'class',
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{flush-cache}',
            'buttons'=>[
                'flush-cache'=>function ($url, $model) {
                    return \yii\helpers\Html::a('<i class="fa fa-refresh"></i>', $url, [
                        'title' => Yii::t('backend', 'Flush'),
                        'data-confirm' => Yii::t('backend', 'Are you sure you want to flush this cache?')
                    ]);
                }
            ]
        ],
    ],
]); ?>
====================================================
动态调用 ActiveRecord::deleteAll
/**
 * @param $key
 * @return bool
 */
public function remove($key)
{
    unset($this->values[$key]);
    return call_user_func($this->modelClass.'::deleteAll', ['key' => $key]);
}

动态调用find
/**
 * @param $key
 * @return mixed
 */
protected function getModel($key)
{
    $query = call_user_func($this->modelClass.'::find');
    return $query->where(['key'=>$key])->select(['key', 'value'])->one();
}
====================================================
<?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
]) ?>
====================================================
The application singleton can be accessed at any place via \Yii::$app.
An attribute is a model property (a class member variable or a magic property defined via __get()/__set()) that stores business data.
Bundle, known as package in Yii 1.1, refers to a number of assets and a configuration file that describes dependencies and lists assets.
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
====================================================
framework/Yii.php
framework/base/Configurable.php
framework/base/Object.php
framework/base/Arrayable.php
framework/web/Link.php
framework/web/Linkable.php
framework/base/ArrayableTrait.php
framework/base/Behavior.php
framework/base/Event.php
framework/base/Component.php
framework/base/ViewContextInterface.php
framework/di/ServiceLocator.php
framework/di/Instance.php                                           ******************
framework/di/Container.php                                          ******************
framework/base/ModelEvent.php
framework/base/Model.php
framework/base/Request.php
framework/base/Response.php
framework/web/RequestParserInterface.php
framework/web/Request.php
framework/web/Cookie.php
framework/web/CookieCollection.php
framework/web/Session.php
framework/web/Response.php
framework/widgets/Block.php
framework/widgets/ContentDecorator.php
framework/widgets/FragmentCache.php
framework/base/View.php
framework/web/View.php
framework/web/AssetBundle.php
framework/base/Module.php
framework/base/Application.php
framework/web/Application.php
framework/base/Widget.php
framework/web/User.php
framework/web/IdentityInterface.php
framework/db/Connection.php
framework/filters/VerbFilter.php
framework/web/AssetManager.php
framework/db/Command.php
framework/db/QueryInterface.php
framework/db/Expression.php
framework/db/QueryTrait.php
framework/BaseYii.php
framework/base/Controller.php
framework/base/Action.php
framework/base/InlineAction.php
framework/web/Controller.php
framework/base/DynamicModel.php
framework/db/ActiveRecordInterface.php
framework/db/BaseActiveRecord.php
framework/db/QueryInterface.php
framework/db/QueryTrait.php
framework/db/Query.php
framework/data/Pagination.php
framework/data/Sort.php
framework/data/DataProviderInterface.php
framework/data/BaseDataProvider.php
framework/db/ActiveQueryInterface.php
framework/db/ActiveQueryTrait.php
framework/helpers/BaseUrl.php
framework/db/BatchQueryResult.php
framework/behaviors/AttributeBehavior.php
framework/behaviors/BlameableBehavior.php
framework/behaviors/SluggableBehavior.php
framework/behaviors/TimestampBehavior.php
framework/rbac/ManagerInterface.php
framework/rbac/Rule.php
framework/rbac/Item.php
framework/rbac/Permission.php
framework/rbac/Role.php
framework/rbac/Assignment.php
framework/rbac/BaseManager.php
framework/rbac/DbManager.php
framework/widgets/LinkPager.php
framework/widgets/InputWidget.php
framework/widgets/LinkSorter.php
framework/rest/Action.php
framework/filters/auth/AuthInterface.php
framework/filters/auth/AuthMethod.php
framework/filters/auth/HttpBasicAuth.php
framework/filters/auth/HttpBearerAuth.php
framework/filters/auth/QueryParamAuth.php
framework/filters/auth/CompositeAuth.php
framework/filters/ContentNegotiator.php
framework/filters/RateLimiter.php
framework/rest/Controller.php
framework/rest/CreateAction.php
framework/rest/DeleteAction.php
framework/rest/IndexAction.php
framework/rest/OptionsAction.php





/home/qinchuan/code/yii2clone/yii2/framework/rest/Serializer.php
framework/db/ActiveRelationTrait.php xxxxxx
yii2-master/framework/validators/Validator.php
====================================================
live templates
ycookiehas: Yii::$app->getRequest()->getCookies()->has('name');
ycookiegetvalue: Yii::$app->getRequest()->getCookies()->getValue('name');
yheaderset: Yii::$app->getResponse()->getHeaders()->set('header_name', 'header_val');
jsonen: json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
time_today midnight: strtotime('today midnight');
###
yrule_update_profile:
修改用户名和邮件时候的rules,参考:https://github.com/trntv/yii2-starter-kit/blob/master/frontend/modules/user/models/AccountForm.php
['username', 'filter', 'filter' => 'trim'],
['username', 'required'],
['username', 'unique',
    'targetClass' => '\common\models\User',
    'message' => Yii::t('frontend', 'This username has already been taken.'),
    'filter' => function ($query) {
        $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
    }
],
['username', 'string', 'min' => 1, 'max' => 255],
['email', 'filter', 'filter' => 'trim'],
['email', 'required'],
['email', 'email'],
['email', 'unique',
    'targetClass' => '\common\models\User',
    'message' => Yii::t('frontend', 'This email has already been taken.'),
    'filter' => function ($query) {
        $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
    }
],
###
yrule_comfirm_pass:
确认密码功能,参考:https://github.com/trntv/yii2-starter-kit/blob/master/frontend/modules/user/models/AccountForm.php
['password', 'string'],
[
    'password_confirm',
    'required',
    'when' => function($model) {
        return !empty($model->password);
    },
    'whenClient' => new JsExpression("function (attribute, value) {
        return $('#caccountform-password').val().length > 0;
    }")
],
['password_confirm', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],
###
yrule_exist
确保email字段在数据库中存在
['email', 'exist',
    'targetClass' => '\common\models\User',
    'filter' => ['status' => User::STATUS_ACTIVE],
    'message' => 'There is no user with such email.'
],
###
设置cookie
$cookie = new Cookie(['name' => '_identity', 'httpOnly' => true]);
$cookie->value = 1;
$cookie->expire = time();
Yii::$app->getResponse()->getCookies()->add($cookie);

###
del_cookie
Yii::$app->getResponse()->getCookies()->remove(new Cookie($this->identityCookie));
###
splitbycomma
-1: A limit of -1, 0 or NULL means "no limit",不限制返回数量
PREG_SPLIT_NO_EMPTY: 只返回非空的部分
preg_split('/\s*,\s*/', trim($columns), -1, PREG_SPLIT_NO_EMPTY);
================================================================================================

