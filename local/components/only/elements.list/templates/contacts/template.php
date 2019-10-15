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
<?foreach ($arResult['SECTIONS'] as $arSection):?>
<div class="company-list container-fluid" id="<?=$arSection['CODE']?>">
    <div class="modal fade map-modal" id="<?=$arSection['CODE']?>-modal">
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
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1 company-list__title"><?=$arSection['NAME']?></div>
    </div>
    <?foreach ($arSection['ITEMS'] as $iKey => $arItem):?>
    <div class="company-list-item">
        <div class="row company-list-item__toggle">
            <div class="col-8 col-md-2 offset-md-1 company-list-item__title collapsed" data-toggle="collapse"
                 data-target="#<?=$arSection['CODE']?>-<?=$iKey?>" aria-expanded="true">
                <?=$arItem['NAME']?>
            </div>
            <div class="d-none d-md-block col-2 company-list-item__address-wrapper collapsed"
                 data-toggle="collapse" data-target="#<?=$arSection['CODE']?>-<?=$iKey?>" aria-expanded="true">
                <div class="company-list-item__address">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
                <?$arLatLng = explode(',', $arItem['PROPERTIES']['MAP_POINT']['VALUE'])?>
                <span class="link company-list-item__show-on-map"
                      data-toggle="modal"
                      data-target="#<?=$arSection['CODE']?>-modal"
                      data-lat="<?=$arLatLng[0]?>"
                      data-lng="<?=$arLatLng[1]?>">Посмотреть на карте</span>
            </div>
            <div class="d-none d-md-block col-2 company-list-item__contacts collapsed" data-toggle="collapse"
                 data-target="#<?=$arSection['CODE']?>-<?=$iKey?>" aria-expanded="true">
                <?=$arItem['DETAIL_TEXT']?>
            </div>
            <div class="plus company-list-item__plus collapsed" data-toggle="collapse"
                 data-target="#<?=$arSection['CODE']?>-<?=$iKey?>" aria-expanded="true"></div>
        </div>
        <div class="row collapse company-list-item__content" id="<?=$arSection['CODE']?>-<?=$iKey?>">
            <div class="company-list-item__mobile-address d-md-none">
                <?=$arItem['PREVIEW_TEXT']?>
            </div>
            <div class="company-list-item__mobile-contacts d-md-none">
                <?=$arItem['DETAIL_TEXT']?>
            </div>
            <span class="link company-list-item__mobile-show-on-map d-md-none"
                  data-toggle="modal"
                  data-target="#companies-modal"
                  data-lat="<?=$arLatLng[0]?>"
                  data-lng="<?=$arLatLng[1]?>">Посмотреть на&nbsp;карте</span>
            <div class="col-8 col-md-2 offset-md-1 company-list-item__img-wrapper">
                <img class="company-list-item__img"
                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                     data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"/>
            </div>
            <div class="col-8 col-md-2 company-list-item__head-info">
                <div class="company-list-item__name"><?=$arItem['PROPERTIES']['PERSON_NAME']['VALUE']?></div>
                <div class="company-list-item__position"><?=$arItem['PROPERTIES']['PERSON_POSITION']['VALUE']?></div>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>
<?endforeach;?>
