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
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'objects');
$APPLICATION->SetPageProperty('BARBA_INNER', 'barba-container-inner');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-8 col-md-7 offset-md-1">
            <h1 class="tpg__title">Объекты</h1>
        </div>
    </div>
</div>

<div class="info-block-1 container-fluid">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1">
            <div class="info-block-1__text-1">День за&nbsp;днем коллектив &laquo;Таврида Энерго Строй&raquo;
                своей работой доказывает, что декларируемые нами принципы&nbsp;&mdash; не&nbsp;просто слова.
            </div>
            <div class="info-block-1__text-2">Наш опыт, знания и&nbsp;реализуемые проекты&nbsp;&mdash;
                лучшее тому подтверждение, &laquo;Таврида Энерго Строй&raquo; достигла определенных успехов,
                ей&nbsp;есть чем гордиться.
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?
    $arUserFilters = array();
    if (Only\Site\Helper::isAjax()){
        $APPLICATION->RestartBuffer();
        if (!empty($_REQUEST['year']) && $_REQUEST['year']!='all'){
            $arUserFilters['PROPERTY_YEAR'] = $_REQUEST['year'];
        }
        if (!empty($_REQUEST['typeWork']) && $_REQUEST['typeWork']!='all'){
            $arUserFilters['PROPERTY_WORK_TYPE'] = $_REQUEST['typeWork'];
        }
        if (!empty($_REQUEST['solutions']) && $_REQUEST['solutions']!='all'){
            $arUserFilters['PROPERTY_SOLUTIONS'] = $_REQUEST['solutions'];
        }
        if (!empty($_REQUEST['branch']) && $_REQUEST['branch']!='all'){
            $arUserFilters['PROPERTY_BRANCH'] = $_REQUEST['branch'];
        }
        if (!empty($_REQUEST['PAGEN_1']) && $_REQUEST['PAGEN_1']>1){
            $iPage = $_REQUEST['page'];
        }
    }
    ?>
    <?
    $APPLICATION->IncludeComponent(
        'only:elements.list',
        'objects',
        [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'COUNT' => '7',
            'PAGER_TEMPLATE' => 'more',
            'FILTER' => $arUserFilters,
            'PAGEN' => $iPage,
            'SORT_BY' => 'PROPERTY_YEAR',
            'SORT_ORDER' => 'DESC',
            'SORT_BY_2' => 'SORT',
            'SORT_ORDER_2' => 'ASC',
            'AJAX' => Only\Site\Helper::isAjax()
        ],
        $component
    );
    ?>
</div>

<?
$APPLICATION->IncludeComponent(
    'only:subscribe',
    $component
);
?>
<div class="static-footer"></div>
