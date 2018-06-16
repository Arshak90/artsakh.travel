<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 07.11.2017
 * Time: 23:59
 */

namespace common\widgets;

use Yii;
use pceuropa\menu\Menu;
use pceuropa\menu\models\Model;
use yii\helpers\Json;

class PceuropaMenu extends Menu
{
    public static function NavbarLeft($id){
        return self::processNavbar($id, 'left');
    }

    public static function processNavbar($id, $pos)
    {
        $m = Model::findModel($id);
        $m = Json::decode($m->menu);

        return $m[$pos] = self::getWithMultilingualLabel($m[$pos]);
    }

    public static function getWithMultilingualLabel($items){
        $tmp = [];

        foreach ($items as $item){

            $item['label'] = sprintf('%s %s',null, Yii::t('frontend', $item['label']));
            if (array_key_exists('items', $item)){
                $item['items'] = self::getWithMultilingualLabel($item['items']);
            }

            $tmp[] = $item;
        }

        return $tmp;
    }
}