<?php
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;

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
/*
 * Выбираем все модули решения с секциями.
 */
$iBlockId = \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS_KRUM_BUILDING', 'SOLUTIONS');
if (Loader::includeModule('iblock')) {
    $rsSections = \CIBlockSection::GetList(
        ['SORT' => 'ASC'],
        [
            'IBLOCK_ID' => $iBlockId,
            'ACTIVE' => 'Y',
        ]
    );
    while ($arSection = $rsSections->Fetch()){
        $arSection['PICTURE'] = CFile::GetFileArray($arSection['PICTURE']);
        $arResult['SECTIONS'][$arSection['ID']] = $arSection;
    }
    $rsItems = \CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        [
            'IBLOCK_ID' => $iBlockId,
            'ACTIVE' => 'Y',
        ],
        false,
        false
    );
    while ($arItem = $rsItems->Fetch()) {
        $arItem['PREVIEW_PICTURE'] = CFile::GetFileArray($arItem['PREVIEW_PICTURE']);
        if (isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])){
            $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']] = $arItem;
        }
    }
}

/*
 * Объекты
 */
if (!empty($arResult['PROPERTIES']['SOLUTIONS_FILTER']['VALUE'])){
    /*
     * Выбираем элементы
     */
    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS','OBJECTS'),
            'ACTIVE' => 'Y',
            'PROPERTY_SOLUTIONS' => $arResult['PROPERTIES']['SOLUTIONS_FILTER']['VALUE']
        ],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_SOLUTIONS','PROPERTY_NAME_SLIDER','PROPERTY_PICTURE_SLIDER', 'DETAIL_PAGE_URL']
    );
    while ($obItem = $rsItems->GetNextElement(true, false)) {
        $arItemObject = $obItem->GetFields();
        $arResult['OBJECTS'][$arItemObject['ID']] = $arItemObject;
        if (empty($arItemObject['PROPERTY_NAME_SLIDER_VALUE']) || empty($arItemObject['PROPERTY_PICTURE_SLIDER_VALUE'])){
            unset($arResult['OBJECTS'][$arItemObject['ID']]);
        }
        if (!empty($arResult['OBJECTS'][$arItemObject['ID']]['PROPERTY_PICTURE_SLIDER_VALUE'])){
            $arResult['OBJECTS'][$arItemObject['ID']]['PICTURE_SLIDER'] = CFile::GetFileArray($arResult['OBJECTS'][$arItemObject['ID']]['PROPERTY_PICTURE_SLIDER_VALUE']);
        }
    }
}
/* Готовим ссылки на фотографии */
if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])){
    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as &$iPhoto){
        $iPhoto = CFile::GetFileArray($iPhoto);
    }
}

