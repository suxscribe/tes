<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $component */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'news');
$APPLICATION->SetPageProperty('BARBA_INNER', 'barba-container-inner');
?>

<div class="container-fluid">
    <div class="row news-page__title">
        <h1 class="col-md-7 offset-md-1 tpg__title">Новости</h1>
    </div>
</div>
<!-- NEWS SLIDER -->
<?
$APPLICATION->IncludeComponent(
    'only:elements.list',
    'news_slider',
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'SORT_BY' => 'ACTIVE_FROM',
        'SORT_ORDER' => 'DESC',
        'SORT_BY_2' => 'ID',
        'SORT_ORDER_2' => 'DESC',
        'FILTER' => array(
                'PROPERTY_PUBLISH_SLIDER_VALUE' => 'Да'
        )
    ],
    $component
);
?>
<!-- END NEWS SLIDER-->
<?
if (Only\Site\Helper::isAjax()) {
    $APPLICATION->RestartBuffer();
}
?>
<?
$APPLICATION->IncludeComponent(
    'only:elements.list',
    'news',
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'COUNT' => '6',
        'SORT_BY' => 'ACTIVE_FROM',
        'SORT_ORDER' => 'DESC',
        'SORT_BY_2' => 'ID',
        'SORT_ORDER_2' => 'DESC',
        'FILTER' => array(
            '!PROPERTY_PUBLISH_SLIDER_VALUE' => 'Да'
        ),
        'PAGER_TEMPLATE' => 'more',
        'PAGEN' => $_REQUEST['page'],
    ],
    $component
);
?>

<?
$APPLICATION->IncludeComponent(
    'only:subscribe',
    $component
);
?>
<div class="static-footer"></div>
