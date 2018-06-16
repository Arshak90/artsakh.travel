<?php
return [
    'class' => 'codemix\localeurls\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'languages' => ['hy', 'en', 'ru', 'de','fr', 'es', 'ar', 'fa'],
    'rules'=> [

        //Site
        ['pattern'=>'site/', 'route'=>'site/index'],
        ['pattern'=>'site/search', 'route'=>'site/search'],
        ['pattern'=>'site/contact', 'route'=>'site/contact'],
        ['pattern'=>'site/subscription', 'route'=>'site/subscription'],
        ['pattern'=>'site/set-locale', 'route'=>'site/set-locale'],
        ['pattern'=>'site/captcha', 'route'=>'site/captcha'],
        ['pattern'=>'site/error', 'route'=>'site/error'],
        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],
        //Events
        ['pattern'=>'events', 'route'=>'event/index'],
        ['pattern'=>'events/<slug>', 'route'=>'event/view'],
        //News
        ['pattern'=>'news', 'route'=>'news/index'],
        ['pattern'=>'news/<slug>', 'route'=>'news/view'],
        // Articles
        ['pattern'=>'<category>/<slug>', 'route'=>'article/category-routing'],
        ['pattern'=>'<category>', 'route'=>'article/category-routing'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
//
//      ['pattern'=>'article/<slug>', 'route'=>'article/view'],

        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']]
    ]
];
