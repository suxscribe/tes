<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'index');

?>
<div class="index-section-1 section" data-section="data-section">
    <div class="index-section-1__bg-wrapper">
        <video class="autoplay-video index-section-1__bg" data-object-fit="cover"
               data-keepplaying="data-keepplaying" src="/media/bg.afdb2f4a.mp4" preload="metadata"
               playsinline="playsinline" muted="muted" autoplay="autoplay" loop="loop"></video>
    </div>
    <div class="shade"></div>
    <div class="index-section-1__content container-fluid">
        <div class="index-section-1__top-space"></div>
        <div class="row">
            <h1 class="col-8 col-md-4 index-section-1__title-1">
                <? $APPLICATION->IncludeComponent(
                    'bitrix:main.include',
                    '.default',
                    array(
                        'AREA_FILE_SHOW' => 'file',
                        'AREA_FILE_SUFFIX' => 'inc',
                        'AREA_FILE_RECURSIVE' => 'Y',
                        'EDIT_TEMPLATE' => 'standard.php',
                        'COMPONENT_TEMPLATE' => '.default',
                        'PATH' => '/include/index/company_name.txt'
                    ),
                    false
                ); ?>
            </h1>
            <div class="index-section-1__block-1 col-8 col-lg-4">
                <div class="index-section-1__title-2">Компания</div>
                <div class="index-section-1__text-1 splitText">
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:main.include',
                        '.default',
                        array(
                            'AREA_FILE_SHOW' => 'file',
                            'AREA_FILE_SUFFIX' => 'inc',
                            'AREA_FILE_RECURSIVE' => 'Y',
                            'EDIT_TEMPLATE' => 'standard.php',
                            'COMPONENT_TEMPLATE' => '.default',
                            'PATH' => '/include/index/company_desc.txt'
                        ),
                        false
                    ); ?>
                </div>
                <div class="row d-none d-md-flex">
                    <div class="col-4 overflow-hidden d-flex flex-column align-items-start">
                        <div class="index-section-1__title-3">
                            <span class="index-section-1__region-value" data-value="<? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '.default',
                                array(
                                    'AREA_FILE_SHOW' => 'file',
                                    'AREA_FILE_SUFFIX' => 'inc',
                                    'AREA_FILE_RECURSIVE' => 'Y',
                                    'EDIT_TEMPLATE' => 'standard.php',
                                    'COMPONENT_TEMPLATE' => '.default',
                                    'PATH' => '/include/index/region_count.txt'
                                ),
                                false
                            ); ?>"></span>
                            <? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '.default',
                                array(
                                    'AREA_FILE_SHOW' => 'file',
                                    'AREA_FILE_SUFFIX' => 'inc',
                                    'AREA_FILE_RECURSIVE' => 'Y',
                                    'EDIT_TEMPLATE' => 'standard.php',
                                    'COMPONENT_TEMPLATE' => '.default',
                                    'PATH' => '/include/index/region_name.txt'
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="index-section-1__text-2">
                            <? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '.default',
                                array(
                                    'AREA_FILE_SHOW' => 'file',
                                    'AREA_FILE_SUFFIX' => 'inc',
                                    'AREA_FILE_RECURSIVE' => 'Y',
                                    'EDIT_TEMPLATE' => 'standard.php',
                                    'COMPONENT_TEMPLATE' => '.default',
                                    'PATH' => '/include/index/region_desc.txt'
                                ),
                                false
                            ); ?>
                        </div>
                    </div>
                    <div class="col-4 overflow-hidden d-flex flex-column align-items-start">
                        <div class="index-section-1__title-3">
                            <span class="index-section-1__year-value" data-value="<? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '.default',
                                array(
                                    'AREA_FILE_SHOW' => 'file',
                                    'AREA_FILE_SUFFIX' => 'inc',
                                    'AREA_FILE_RECURSIVE' => 'Y',
                                    'EDIT_TEMPLATE' => 'standard.php',
                                    'COMPONENT_TEMPLATE' => '.default',
                                    'PATH' => '/include/index/years_count.txt'
                                ),
                                false
                            ); ?>"></span>
                            <? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '.default',
                                array(
                                    'AREA_FILE_SHOW' => 'file',
                                    'AREA_FILE_SUFFIX' => 'inc',
                                    'AREA_FILE_RECURSIVE' => 'Y',
                                    'EDIT_TEMPLATE' => 'standard.php',
                                    'COMPONENT_TEMPLATE' => '.default',
                                    'PATH' => '/include/index/years_name.txt'
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="index-section-1__text-2">
                            <? $APPLICATION->IncludeComponent(
                                'bitrix:main.include',
                                '.default',
                                array(
                                    'AREA_FILE_SHOW' => 'file',
                                    'AREA_FILE_SUFFIX' => 'inc',
                                    'AREA_FILE_RECURSIVE' => 'Y',
                                    'EDIT_TEMPLATE' => 'standard.php',
                                    'COMPONENT_TEMPLATE' => '.default',
                                    'PATH' => '/include/index/years_desc.txt'
                                ),
                                false
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="index-section-1__bottom-space"></div>
    </div>
    <div class="index-section-1__move-next">
        <svg>
            <use xlink:href="#arrow-down"></use>
        </svg>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
    'only:elements.list',
    'solutions_main_slider',
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS','SOLUTIONS')
    ],
    $component
);
?>
<div class="index-section-3 section" data-section="data-section">
    <div class="index-section-3__wrapper">
        <?$APPLICATION->IncludeComponent(
            'bitrix:menu',
            'fake',
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

        <?$APPLICATION->IncludeComponent(
            'only:elements.list',
            'services_main',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SERVICES','SERVICES')
            ],
            $component
        );
        ?>
        <?$APPLICATION->IncludeComponent(
            'only:elements.list',
            'objects_slider',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS','OBJECTS'),
                'FILTER' => array(
                        'PROPERTY_PUBLISH_MAIN_VALUE'=> 'Да'
                )

            ],
            $component
        );
        ?>
        <?
        $APPLICATION->IncludeComponent(
            'only:subscribe',
            'main',
            $component
        );
        ?>
        <?$APPLICATION->IncludeComponent(
            'only:elements.list',
            'news_main',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('NEWS','NEWS'),
                'COUNT' => 3,
                'FILTER' => array(
                    'PROPERTY_PUBLISH_MAIN_VALUE'=> 'Да'
                ),
                'SORT_BY' => 'ACTIVE_FROM',
                'SORT_ORDER' => 'DESC',
                'SORT_BY_2' => 'ID',
                'SORT_ORDER_2' => 'DESC',
            ],
            $component
        );
        ?>

        <div class="clock container-fluid container-fluid_fix-left">
            <div class="clock__bg"></div>
            <div class="row clock__row">
                <div class="col-8 clock__col">
                    <div class="clock__value">
                        <span class="clock__hours">00</span>
                        <span class="clock__dots">:</span>
                        <span class="clock__minutes">00</span>
                        <span class="clock__ampm">am</span>
                    </div>
                </div>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent(
            'only:elements.detail',
            'main',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('MAIN','MAIN'),
                'ELEMENT_CODE' => 'main',
                'SET_META_TAGS' => 'N'
            ],
            $component
        );
        ?>
        <div class="static-footer"></div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
