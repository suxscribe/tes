<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?


global $APPLICATION;
$arResult = \Only\Site\Helpers\Menu::buildTree($arResult);
?>
<div class="sandwich-menu">
    <div class="sandwich-menu__wrapper">
        <div class="sandwich-menu__bg">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                 data-src="/media/bg.f1b31356.jpg"
                 data-object-fit="cover"/>
            <div class="sandwich-menu__mask">
            </div>
        </div>
        <div class="sandwich-menu__right">
            <div class="sandwich-menu__top-space">
                <div class="sandwich-menu__header">
                    <div class="sandwich-menu__col sandwich-menu__col_links">
                        <a class="sandwich-menu__header-link" href="tel:<?=$APPLICATION->GetPageProperty('TES_PHONE_VALUE')?>"><?=$APPLICATION->GetPageProperty('TES_PHONE_PRINT')?></a>
                        <a class="sandwich-menu__header-link" href="mailto:<?=$APPLICATION->GetPageProperty('TES_MAIL')?>"><?=$APPLICATION->GetPageProperty('TES_MAIL')?></a>
                    </div>
                    <div class="sandwich-menu__col">
                        <div class="sandwich-menu__header-logo">
                            <svg>
                                <use xlink:href="#logo"></use>
                            </svg>
                        </div>
                        <div class="sandwich-menu-close sandwich-menu__close">
                            <div class="sandwich-menu-close__line sandwich-menu-close__line_top"></div>
                            <div class="sandwich-menu-close__line sandwich-menu-close__line_bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sandwich-menu__middle-space">
                <ul class="sandwich-menu__list sandwich-menu__list_scroll">
                    <?foreach ($arResult as $arItem):?>
                    <li class="sandwich-menu__item">
                        <a class="sandwich-menu__link <?=$arItem['SELECTED']? 'sandwich-menu__link_active':''?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
                        <?if (!empty($arItem['ITEMS'])):?>
                        <ul class="sandwich-menu__sublist sandwich-menu__list_scroll">
                            <?foreach ($arItem['ITEMS'] as $arSubItems):?>
                            <li class="sandwich-menu__subitem">
                                <a class="sandwich-menu__link <?=$arSubItems['SELECTED']? 'sandwich-menu__link_active':''?>" href="<?=$arSubItems['LINK']?>"><?=$arSubItems['TEXT']?></a>
                            </li>
                            <?endforeach;?>
                        </ul>
                        <?endif;?>
                    </li>
                    <?endforeach;?>
                </ul>
            </div>
            <div class="sandwich-menu__bottom-space">
                <div class="sandwich-menu__footer">
                    <div class="sandwich-menu__col"><a class="sandwich-menu__header-link" href="tel:88002343344">8 (800)
                            234-33-44</a><a class="sandwich-menu__header-link" href="mailto:info@tes.ru">info@tes.ru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
