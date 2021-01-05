<?php

namespace frontend\components\navbar;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;


/**
 * Este widget añade una barra de navegación lateral que puede esconderse. El siguiente ejemplo muestra como podemos
 * añadir elementos a la barra lateral, además podremos acompañarlos con iconos se recomienda usar FontAwesome.
 *
 * Ejemplo en la vista:
 *
 *echo NavSidebar::widget([
 * 'imgProfile' =>  $avatarImage,
 * 'nameProfile' => $value = (Yii::$app->user->isGuest) ? "invitado" : Html::encode(Yii::$app->user->identity->username),
 * 'items' => [['url' => ['movements/benchmark'],'label' => 'Mis Benchmarks','icon' => 'fas fa-trophy']],
 * ])
 *
 *
 *
 * Class NavSidebar
 * @package frontend\components\navbar
 */
class NavSidebar extends Widget
{
    public $items = [];
    public $imgProfile = "";
    public $nameProfile = "";

    /**
     * Inicializa el objeto.
     */
    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    /**
     * Registro de Assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        NavSidebarAsset::register($view);
    }

    /**
     * Función que ejecuta el widget
     * @return string
     */
    public function run()
    {

        $navHtml = '<nav id="sidebar">';

        //Toogle button
        $navHtml .= '<div id="togglebutton" class="button-special">
                    <i class="fas fa-chevron-right"></i></div>';
        //Profile
        $navHtml .= ' <div class="img bg-wrap text-center pt-5">';
        $navHtml .= '<div class="avatar">';
        $navHtml .= '<img src="'.$this->imgProfile.'" class="img-responsive" alt="foto perfil"/>';
        $navHtml .= '<h3>'.$this->nameProfile.'</h3>';
        $navHtml .= '</div></div>';

        //items
        $navHtml .= '<ul class="mb-5">';
        $navHtml .= '<hr>';
        foreach ($this->items as $item) {
            if (Yii::$app->controller->route == trim($item['url'][0], '/')) {
                $activeMenu = 'active';
            } else {
                $activeMenu = '';
            }
            
            $navHtml .= '<li class="'.$activeMenu.'"><a href = "'.Url::to($item['url']).'">';
            $navHtml .= '<i data-toggle="tooltip" data-placement="right" title="'.$item['label'].'" class="'.$item['icon'].'"></i>';
            $navHtml .= '<span class="nav-label" style="margin-left: 15px">'.$item['label'].'</span>';
            if (isset($item['badge'])) {
                $navHtml .= '<span class="badge">'.$item['badge'].'</span>';
            }
            $navHtml .= '<i class="fas fa-chevron-right" style="float: right;"></i>';
            $navHtml .= '</a>';
            $navHtml .= '</li>';
            $navHtml .= '<hr>';
        }
        $navHtml .= '</ul>';

        $navHtml .= '</nav>';
        

        return $navHtml;
    }



}
