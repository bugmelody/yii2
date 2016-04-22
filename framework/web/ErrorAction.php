<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\web;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\base\UserException;

/**
 * ErrorAction displays application errors using a specified view.
 *
 * To use ErrorAction, you need to do the following steps:
 *
 * First, declare an action of ErrorAction type in the `actions()` method of your `SiteController`
 * class (or whatever controller you prefer), like the following:
 *
 * ```php
 * public function actions()
 * {
 *     return [
 *         'error' => ['class' => 'yii\web\ErrorAction'],
 *     ];
 * }
 * ```
 *
 * Then, create a view file for this action. If the route of your error action is `site/error`, then
 * the view file should be `views/site/error.php`. In this view file, the following variables are available:
 *
 * - `$name`: the error name
 * - `$message`: the error message
 * - `$exception`: the exception being handled
 *
 * Finally, configure the "errorHandler" application component as follows,
 *
 * ```php
 * 'errorHandler' => [
 *     'errorAction' => 'site/error',
 * ]
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ErrorAction extends Action
{
    /**
     * @var string the view file to be rendered. If not set, it will take the value of [[id]].
     * That means, if you name the action as "error" in "SiteController", then the view name
     * would be "error", and the corresponding view file would be "views/site/error.php".
     */
    public $view;
    /**
     * @var string the name of the error when the exception name cannot be determined.
     * Defaults to "Error".
     */
    public $defaultName;
    /**
     * @var string the message to be displayed when the exception message contains sensitive information.
     * Defaults to "An internal server error occurred.".
     */
    public $defaultMessage;


    /**
     * Runs the action
     *
     * @return string result content
     */
    public function run()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        // 计算code
        if ($exception instanceof HttpException) {
            // 如果是 HttpException, code 设置为 http 状态
            $code = $exception->statusCode;
        } else {
            // 否则, code 设置为 $exception 的 code
            $code = $exception->getCode();
        }


        if ($exception instanceof Exception) {
            // 如果是 \yii\base\Exception, 说明是框架本身抛出的异常
            $name = $exception->getName();
        } else {
            // 否则,不是框架本身抛出的异常,是php的本身异常,可能包含敏感信息,因此使用 $this->defaultName 避免敏感信息暴露
            $name = $this->defaultName ?: Yii::t('yii', 'Error');
        }

        if ($code) {
            // 将 code 附加到 name 中
            $name .= " (#$code)";
        }

        // 计算 $message
        if ($exception instanceof UserException) {
            // 如果是用户造成的异常,属于非敏感信息
            $message = $exception->getMessage();
        } else {
            // 否则,可能包含敏感信息
            $message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            // 如果是 ajax 请求,直接返回字符串
            return "$name: $message";
        } else {
            // 否则,调用 render 进行模板渲染
            return $this->controller->render($this->view ?: $this->id, [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }
}
