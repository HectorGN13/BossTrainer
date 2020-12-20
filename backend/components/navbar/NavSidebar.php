<?php

namespace backend\components\navbar;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;


class NavSidebar extends Widget
{
    public $items = [];
    public $imgProfile = "";
    public $nameProfile = "";

    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        NavSidebarAsset::register($view);
    }

    public function run()
    {

        $navHtml = '<nav id="sidebar" class="mt-5 navbar-inverse">';

        //Toogle button
        $navHtml .= '<div id="togglebutton" class="button-special">
                    <i class="fas fa-chevron-right"></i></div>';
        //Profile
        /*$navHtml .= ' <div class="img bg-wrap text-center pt-5">';
        $navHtml .= '<div class="avatar">';
        $navHtml .= '<img src="'.$this->imgProfile.'" class="img-responsive" alt="foto perfil"/>';
        $navHtml .= '<h3>'.$this->nameProfile.'</h3>';
        $navHtml .= '</div></div>';*/

        //items
        $navHtml .= '<ul class="mb-5 mt-5">';
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
