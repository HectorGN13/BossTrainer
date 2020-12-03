<?php
/**
 * MODIFICACION PROPIA DEL SIGUIENTE WIDGET
 * @copyright Copyright (c) Alexander Savelyev <http://weblancer.net/users/alexsava>
 * @license https://github.com/pa3py6aka/yii2-modal-alert-widget/blob/master/LICENSE.md
 * @link https://github.com/pa3py6aka/yii2-modal-alert-widget
 */

namespace frontend\components\modalalert;

use Yii;
use yii\bootstrap\Widget;

/**
 * This widget show bootstrap modal or magnific popup when you set session flash message
 * For magnific popups you must install magnific js before using this widget - http://dimsemenov.com/plugins/magnific-popup/
 *
 * Example:
 * ----------
 * in controller set flash message:
 *     Yii::$app->session->setFlash('success', 'My Message');
 * or you can set flash this title:
 *     Yii::$app->session->setFlash('success', [['My title', 'My Message']]);
 *
 * In your layout view show this widget:
 *     <?= ModalAlertWidget::widget(['popupCssClass' => 'my-popup-class']) ?>
 *
 * Thats all :)
 */
class ModalAlert extends Widget
{
    const TYPE_BOOTSTRAP = 'bootstrap';
    const TYPE_MAGNIFIC = 'magnific';

    /**
     * @var string Type of modal, it may be 'bootstrap' or 'magnific'
     */
    public $type = self::TYPE_BOOTSTRAP;

    /**
     * @var string CSS class for main popup block
     */
    public $popupCssClass = "";

    /**
     * @var string Id for main popup block
     */
    public $popupId = "pa3py6aka-modal-alert";

    /**
     * @var string Magnific popup type
     */
    public $magnificPopupType = "inline";

    /**
     * @var array List of CSS classes for flash-types
     */
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];

    /**
     * @var string Path to view for render popup, may be use aliases
     */
    public $popupView;

    /**
     * @var int Time in seconds after which the modal window will be closed (0 means that modal will be closed only by user)
     */
    public $showTime = 0;

    public function init()
    {
        parent::init();
        $this->showTime = ((int) $this->showTime) * 1000;
    }

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $messages = [];
        $show = false;
        $title = null;

        foreach ($flashes as $type => $data) {
            $cssClass = isset($this->alertTypes[$type]) ? $this->alertTypes[$type] : 'alert-info';
            $data = (array) $data;
            foreach ($data as $message) {
                if ($message) {
                    $show = true;
                }
                if (is_array($message)) {
                    if (count($message) > 1) {
                        $mTitle = array_shift($message);
                        $title = $title ?: $mTitle;
                    }
                    $message = array_shift($message);
                }
                $messages[] = [
                    'cssClass' => $cssClass,
                    'message' => $message,
                ];
            }

            $session->removeFlash($type);
        }

        if ($show) {
            echo $this->renderModal($messages, $title);
            $this->showModal();
        }
    }

    private function renderModal(array $messages, $title)
    {
        $path = $this->popupView ?: $this->type . '-modal';
        return $this->render($path, [
            'messages' => $messages,
            'popupCssClass' => $this->popupCssClass,
            'popupId' => $this->popupId,
            'title' => $title,
        ]);
    }

    private function showModal()
    {
        $bootstrapShowTimer = $this->showTime > 0 ? "setTimeout(\"$('#{$this->popupId}').modal('hide');\", {$this->showTime});" : "";
        $bootstrapJs = <<<JS
$('#{$this->popupId}').modal();
{$bootstrapShowTimer}
JS;

        $magnificShowTimer = $this->showTime > 0 ? "setTimeout(\"$.magnificPopup.close();\", {$this->showTime});" : "";
        $magnificJs = <<<JS
$.magnificPopup.open({
    items: {
        src: '#{$this->popupId}',
        type: '{$this->magnificPopupType}',
        midClick: true
    }
});
JS;
        $this->view->registerJs($this->type == self::TYPE_BOOTSTRAP ? $bootstrapJs : $magnificJs);
    }
}