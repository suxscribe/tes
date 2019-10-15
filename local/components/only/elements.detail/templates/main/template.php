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
<div class="contacts container-fluid container-fluid_fix-left">
    <?$arLatLng = explode(',', $arResult['PROPERTIES']['MAP_POINT']['VALUE'])?>
    <div class="modal fade map-modal" id="map-modal" data-lat="<?=$arLatLng[0]?>" data-lng="<?=$arLatLng[1]?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="map-modal__map"></div>
                <div class="sandwich-menu-close sandwich-menu__close modal__close" data-dismiss="modal">
                    <div class="sandwich-menu-close__line sandwich-menu-close__line_top"></div>
                    <div class="sandwich-menu-close__line sandwich-menu-close__line_bottom"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="contacts__animation-bg"></div>
    <div class="row">
        <div class="contacts__col col-8 col-md-4 col-xl-3 col-xxl-2 offset-xl-1 contacts__row-1">
            <a class="link contacts__all" href="/contacts/">Все контакты</a>
        </div>
        <div class="contacts__booklets contacts__col col-8 col-md-4 col-xl-3 offset-xxl-1 contacts__row-1">
            <?if ($arResult['PROPERTIES']['DOCUMENT']['VALUE']):?>
                <?foreach ($arResult['PROPERTIES']['DOCUMENT']['VALUE'] as $arDocument):?>
                <a class="contacts__booklet" href="<?=$arDocument['SRC']?>" target="_blank">
                    <svg class="contacts__icon">
                        <use xlink:href="#paper"></use>
                    </svg>
                    <?=$arDocument['DESCRIPTION']?>
                    <br class="d-none d-md-inline"/>
                    (<?=$arDocument['FILE_SIZE']?>, <?=$arDocument['EXT']?>)
                </a>
                <?endforeach;?>
            <?endif;?>
        </div>
        <div class="contacts__col col-8 col-md-4 col-xl-3 col-xxl-2 offset-xl-1 contacts__email-phone contacts__row-2">
            Т/Ф&nbsp;<a class="contacts__phone"
                        href="tel:<?=substr(preg_replace('~[^\+0-9]+~','',$arResult['PROPERTIES']['OFFICE_PHONE']['VALUE']),0,12)?>">
                <?=$arResult['PROPERTIES']['OFFICE_PHONE']['VALUE']?>
            </a>
            <br/>
            e-mail:
            <a class="contacts__email" href="mailto:<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>">
                <?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>
            </a>
        </div>
        <div class="contacts__col col-8 col-md-4 col-xl-3 offset-xxl-1 contacts__text contacts__row-2">
            <?=$arResult['PREVIEW_TEXT']?>
        </div>
        <div class="contacts__col col-8 col-md-4 col-xl-3 col-xxl-2 offset-xl-1 contacts__row-3">
            <div class="contacts__city"><?=$arResult['PROPERTIES']['OFFICE_CITY']['VALUE']?></div>
            <div class="contacts__address"><?=$arResult['PROPERTIES']['OFFICE_ADDRESS']['VALUE']?></div>
            <a class="link contacts__show-on-map" data-toggle="modal" data-target="#map-modal">На&nbsp;карте</a>
        </div>
        <div class="contacts__col col-8 col-md-4 col-xl-3 offset-xxl-1 contacts__row-3">
            <a class="contacts__phone-2"
               href="tel:<?=substr(preg_replace('~[^\+0-9]+~','',$arResult['PROPERTIES']['PHONE']['VALUE']),0,12)?>">
                <?=$arResult['PROPERTIES']['PHONE']['VALUE']?>
            </a>
            <div class="contacts__text-2">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['PHONE_DESC']['VALUE']['TEXT'])?>
            </div>
        </div>
    </div>
    <div class="contacts__green-block"></div>
</div>
