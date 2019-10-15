<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <? \Only\Site\Helper::loadCssFolder('/css/'); ?>
    <link rel="icon" type="image/png" sizes="96x96" href="/media/favicon-96x96.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <? \Only\Site\Helper::showHead($SITE_LANG); ?>
</head>
<? $APPLICATION->ShowPanel() ?>
<body class="preloading">
<div class="header container-fluid">
    <div class="row">
        <div class="header__col col-2">
            <a class="header__logo-link" href="/">
                <svg class="header__logo">
                    <use xlink:href="#logo"></use>
                </svg>
            </a>
        </div>
        <div class="header__col col-5 d-none d-md-flex">
            <? $APPLICATION->IncludeComponent(
                'bitrix:menu',
                'top',
                Array(
                    'ALLOW_MULTI_SELECT' => 'N',
                    'CHILD_MENU_TYPE' => '',
                    'DELAY' => 'N',
                    'MAX_LEVEL' => '1',
                    'MENU_CACHE_GET_VARS' => array(''),
                    'MENU_CACHE_TIME' => '3600',
                    'MENU_CACHE_TYPE' => 'A',
                    'MENU_CACHE_USE_GROUPS' => 'Y',
                    'ROOT_MENU_TYPE' => 'top',
                    'USE_EXT' => 'N'
                )
            ); ?>
        </div>
        <div class="header__col col-6 col-md-1 justify-content-end">
            <a class="header__phone d-md-none" href="tel:88002343344">
                <svg>
                    <use xlink:href="#phone"></use>
                </svg>
            </a>
            <div class="sandwich-button header__sandwich-button">
                <div class="sandwich-button__line sandwich-button__line_top"></div>
                <div class="sandwich-button__line sandwich-button__line_middle"></div>
                <div class="sandwich-button__line sandwich-button__line_bottom"></div>
            </div>
        </div>
    </div>
</div>
<div id="barba-wrapper">
    <?$APPLICATION->ShowViewContent('BARBA_NAMESPASE');?>
    <?$APPLICATION->ShowViewContent('PAGE_NAVIGATION');?>
