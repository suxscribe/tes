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
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'solutions');
$APPLICATION->SetPageProperty('BARBA_INNER', 'barba-container-inner');
$APPLICATION->SetPageProperty('PAGE_NAVIGATION', true);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-8 col-md-7 offset-md-1">
            <h1 class="tpg__title">Решения</h1>
        </div>
    </div>
</div>
<div class="solution-group-inner" data-page-nav-item="Продукция &laquo;Таврида Энерго Строй&raquo;">
    <div class="info-block-1 container-fluid">
        <div class="row">
            <div class="col-8 col-md-6 offset-md-1">
                <div class="info-block-1__title">Продукция &laquo;Таврида Энерго Строй&raquo;
                </div>
                <div class="info-block-1__text-2">При строительстве и&nbsp;реконструкции объектов
                    электроэнергетики мы&nbsp;применяем собственные сертифицированные решения&nbsp;&mdash;
                    современные быстровозводимые трансформаторные подстанции и&nbsp;их&nbsp;отдельные компоненты
                </div>
            </div>
        </div>
    </div>
    <div class="solution-group-inner__items">
        <?
        $APPLICATION->IncludeComponent(
            'only:elements.list',
            'solutions',
            [
                'IBLOCK_ID' => $arParams['IBLOCK_ID']
            ],
            $component
        );
        ?>
        <?
        $APPLICATION->IncludeComponent(
            'only:elements.list',
            'solutions',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS_ORU','SOLUTIONS')
            ],
            $component
        );
        ?>
        <?
        $APPLICATION->IncludeComponent(
            'only:elements.list',
            'solutions',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS_KRUM','SOLUTIONS')
            ],
            $component
        );
        ?>
        <?
        $APPLICATION->IncludeComponent(
            'only:elements.list',
            'solutions',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS_KSO','SOLUTIONS'),
                'FILTER' => ['CODE' => 'kru104']
            ],
            $component
        );
        ?>
    </div>
</div>
<div class="solution-group-inner" data-page-nav-item="Продукция НЭТЗ">
    <div class="info-block-1 container-fluid">
        <div class="row">
            <div class="col-8 col-md-6 offset-md-1">
                <div class="info-block-1__title">Продукция НЭТЗ
                </div>
                <div class="info-block-1__text-2">
                    Для оснащения объектов дополнительно мы используем продукцию Нижегородского Электротехнического завода
                </div>
            </div>
        </div>
    </div>
    <div class="solution-group-inner__items">
        <?
        $APPLICATION->IncludeComponent(
            'only:elements.list',
            'solutions',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS_KSO','SOLUTIONS'),
                'FILTER' => ['!CODE' => 'kru104']
            ],
            $component
        );
        ?>
    </div>
</div>
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

