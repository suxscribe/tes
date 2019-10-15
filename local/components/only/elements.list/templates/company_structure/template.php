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
<div class="structure" data-page-nav-item="Структура">
    <div class="container-fluid">
        <div class="structure__content">
            <div class="row">
                <div class="col-md-8 tpg__title-2">Структура</div>
            </div>
            <?foreach ($arResult['SECTIONS'] as $arSection):?>
            <div class="row structure__row">
                <div class="d-none d-md-block col-md-1 offset-md-1">
                    <div class="structure__city"><?=$arSection['NAME']?></div>
                </div>
                <div class="col-md-5">
                    <?foreach ($arSection['ITEMS'] as $arItem):?>
                    <div class="structure__right">
                        <div class="structure__title"><?=$arItem['NAME']?></div>
                        <div class="structure__address">
                            <?=htmlspecialcharsback($arItem['PREVIEW_TEXT'])?>
                        </div>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>
