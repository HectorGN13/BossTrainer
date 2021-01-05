<?php

namespace frontend\components\parallax;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Este widget crea un bonito paralax en tu vista. Además puedes añadir contenido dentro del paralax.
 *
 * Ejemplo de uso:
 *  echo CustomParallax::widget([
 * 'image' => '/images/bg-index.jpg',
 * 'element' => '.parallax1',
 * 'minHeight' => '400px',
 * 'content' => $parallaxContain2,]);
 *
 *
 *
 * Class CustomParallax
 * @package frontend\components\parallax
 */
class CustomParallax extends Widget
{
    public $image;
    public $element;
    public $minHeight;
    public $content;

    /**
     * Inicializa el objeto
     */
    public function init()
    {
        parent::init();
        $view = Yii::$app->getView();
        $this->registerAssets();
        $view->registerJs("
        $('" . $this->element . "').css('min-height', '" . $this->minHeight . "');
        $('" . $this->element . "').css('background', 'transparent');
        $('" . $this->element . "').parallax({imageSrc: '" . $this->image . "'});
        ", $view::POS_READY);
    }

    /**
     * Registro de Assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        CustomParallaxAsset::register($view);
    }

    /**
     * Función que ejecuta el widget
     * @return string
     */
    public function run()
    {
        return Html::tag('div', $this->content, ['class'=>preg_replace('/[^a-zA-Zа-яА-Я0-9]/ui', '', $this->element), 'data-parallax'=>"scroll", 'data-image-src'=> $this->image]);
    }
}
