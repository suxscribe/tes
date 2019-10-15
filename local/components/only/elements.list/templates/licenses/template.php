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
<div class="documents documents_trust">
    <div class="container-fluid">
        <div class="row documents__row">
            <div class="col-xl-2 col-md-4 documents__main">
                <div class="documents__title-1">Лицензии и сертификаты</div>
                <div class="documents__text-1">
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:main.include',
                        '.default',
                        array(
                            'AREA_FILE_SHOW' => 'file',
                            'AREA_FILE_SUFFIX' => 'inc',
                            'AREA_FILE_RECURSIVE' => 'Y',
                            'EDIT_TEMPLATE' => 'standard.php',
                            'COMPONENT_TEMPLATE' => '.default',
                            'PATH' => '/include/trust/licenses_desc.txt'
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <?foreach ($arResult['ITEMS'] as $arItem):?>
            <div class="document col-xl-2 col-md-4 documents__document document_text">
                <div class="document__wrapper">
                    <div class="document__wrapper-inner">
                        <div class="document__title-1"><?=$arItem['NAME']?></div>
                        <div class="document__text">
                            <?=$arItem['PREVIEW_TEXT']?>
                        </div>
                    </div>
                    <div class="document__bottom">
                        <a class="document__link" href="<?=$arItem['DOCUMENT']['SRC']?>" target="_blank">
                            Скачать (<?=$arItem['DOCUMENT']['FILE_SIZE']?>, <?=$arItem['DOCUMENT']['EXT']?>)
                        </a>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>
