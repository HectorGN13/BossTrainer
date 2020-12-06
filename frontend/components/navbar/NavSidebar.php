<?php

namespace frontend\components\navbar;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;


class NavSidebar extends Widget
{
    public $items = [];

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

        $navHtml = '<ul class="mb-5">';
        
        foreach ($this->items as $item) {
            if (Yii::$app->controller->route == trim($item['url'][0], '/')) {
                $activeMenu = 'active';
            } else {
                $activeMenu = '';
            }
            
            $navHtml .= '<li class="'.$activeMenu.'"><a href = "'.Url::to($item['url']).'">';
            $navHtml .= '<i data-toggle="tooltip" data-placement="right" title="'.$item['label'].'" class="'.$item['icon'].'"></i>';
            $navHtml .= '<span class="nav-label">'.$item['label'].'</span>';
            if (isset($item['badge'])) {
                $navHtml .= '<span class="badge">'.$item['badge'].'</span>';
            }
            $navHtml .= '</a>';
            $navHtml .= '</li>';
        }
    
        $navHtml .= '</ul>';
        

        return $navHtml;
    }



}
