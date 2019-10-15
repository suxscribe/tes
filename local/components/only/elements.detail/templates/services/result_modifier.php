<?php
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
/*
 * Готовим фотографии
 */
if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])){
    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as &$iPhoto){
        $iPhoto = CFile::GetFileArray($iPhoto);
    }
}
/*
 * И документы
 */
if (!empty($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])){
    foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as &$iDocument){
        $iDocument = CFile::GetFileArray($iDocument);
        $iDocument['FILE_SIZE'] = CFile::FormatSize($iDocument['FILE_SIZE']);
        /*
         * Если не задано описание файла то берем его имя без расширения.
         */
        if (empty($iDocument['DESCRIPTION'])){
            $iDocument['DESCRIPTION'] =  substr($iDocument['ORIGINAL_NAME'], 0, strripos($iDocument['ORIGINAL_NAME'], '.'));

        }
        $iDocument['EXT'] =  substr($iDocument['ORIGINAL_NAME'],  strripos($iDocument['ORIGINAL_NAME'], '.')+1);
    }
}
/*
 * Следующая услуга
 */
$arFilter = array(
    'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    'ACTIVE' => 'Y',
);
$rsElem = CIBlockElement::GetList(
    array('SORT' => 'ASC'),
    $arFilter,
    false,
    array('nPageSize' => 1, 'nElementID' => $arResult["ID"]),
    array('ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE')
);
$arElements = [];
while ($arElement = $rsElem->GetNext()) {
    $arElements[] = $arElement;
}

if (count($arElements) == 3) {
    $arResult['NEXT'] = $arElements[2];
} elseif (count($arElements) == 2) {
    if ($arElements[1]['ID'] != $arResult["ID"]) {
        /*
        $rsElem = CIBlockElement::GetList(
            array('SORT' => 'DESC'),
            $arFilter,
            false,
            array('nPageSize' => 1),
            array('ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE')
        );
        $arElementsFirst = [];
        while ($arElement = $rsElem->GetNext()) {
            $arElementsFirst[] = $arElement;
        }
        */
        $arResult['NEXT'] = $arElements[1];
    } else {
        $rsElem = CIBlockElement::GetList(
            array('SORT' => 'ASC'),
            $arFilter,
            false,
            array('nPageSize' => 1),
            array('ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE')
        );
        $arElementsLast = [];
        while ($arElement = $rsElem->GetNext()) {
            $arElementsLast[] = $arElement;
        }
        $arResult['NEXT'] = $arElementsLast[0];
    }

}
if (!empty($arResult['NEXT']['DETAIL_PICTURE'])){
    $arResult['NEXT']['DETAIL_PICTURE'] = CFile::GetFileArray($arResult['NEXT']['DETAIL_PICTURE']);
}


/*
 * Объекты
 */

$rsItems = CIBlockElement::GetList(
    [
        "SORT"=>"ASC"
    ],
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS','OBJECTS'),
        'ACTIVE' => 'Y',
        'PROPERTY_WORK_TYPE' => array($arResult['ID'])
    ],
    false,
    false,
    ['ID','NAME', 'PROPERTY_WORK_TYPE','PROPERTY_NAME_SLIDER','PROPERTY_PICTURE_SLIDER', 'DETAIL_PAGE_URL']
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


