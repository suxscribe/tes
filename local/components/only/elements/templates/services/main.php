<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>

<?php
$this->setFrameMode(true);
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'services');
$APPLICATION->SetPageProperty('BARBA_INNER', 'barba-container-inner');
?>
<div class="services-inner">
    <svg class="d-none d-md-block services-inner__epc">
        <use xlink:href="#epc-services"></use>
    </svg>
    <div class="container-fluid services-inner__container-fluid">
        <div class="row services-inner__title" data-page-nav-item="Услуги">
            <h1 class="col-7 offset-md-1 tpg__title">Услуги</h1>
        </div>
        <div class="row services-inner__description col-md-6 offset-md-1">
            <? $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '.default',
                array(
                    'AREA_FILE_SHOW' => 'file',
                    'AREA_FILE_SUFFIX' => 'inc',
                    'AREA_FILE_RECURSIVE' => 'Y',
                    'EDIT_TEMPLATE' => 'standard.php',
                    'COMPONENT_TEMPLATE' => '.default',
                    'PATH' => '/include/services/main_desc.html'
                ),
                false
            ); ?>
        </div>
        <div class="row services-inner__row">
            <?
            $APPLICATION->IncludeComponent(
                'only:elements.list',
                'services',
                [
                    'IBLOCK_ID' => $arParams['IBLOCK_ID']
                ],
                $component
            );
            ?>
        </div>
    </div>
</div>
<?
$APPLICATION->IncludeComponent(
    'only:elements.detail',
    'services_main',
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SERVICE_MAIN','SERVICES'),
        'ELEMENT_CODE' => 'main',
        'SET_META_TAGS' => 'N'
    ],
    $component
);
?>
<?
$APPLICATION->IncludeComponent(
    'only:mailer',
    'feedback',
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('FEEDBACK','FEEDBACK'),
        'USE_CAPTCHA' => 'Y',
    ],
    $component
);
?>
<div class="static-footer"></div>

