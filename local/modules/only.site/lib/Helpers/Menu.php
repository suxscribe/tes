<?php
/**
 * Created by PhpStorm.
 * User: a123
 * Date: 28.06.2018
 * Time: 12:41
 */

namespace Only\Site\Helpers;


class Menu
{

    public static function buildTree($arItems, $iDepthLevel = 1)
    {
        $arTree = [];

        foreach ($arItems as $iKey => $arItem) {
            if ($arItem['DEPTH_LEVEL'] < $iDepthLevel)
                break;

            if ($arItem['DEPTH_LEVEL'] == $iDepthLevel) {

                if ($arItem['IS_PARENT'])
                    $arItem['ITEMS'] = self::buildTree(array_slice($arItems, $iKey + 1), $arItem['DEPTH_LEVEL'] + 1);

                $arTree[] = $arItem;
            }
        }

        return $arTree;
    }
    public static function getExtMenuFromIblockItems(&$aMenuLinks, $code, $typeId = '', $UseDescription = false, $arFilter = array()){
        if(\CModule::IncludeModule("iblock")){
            $arFilters = [
                'IBLOCK_ID' => IBlock::getIblockID($code,$typeId),
                'ACTIVE' => 'Y',
                ];
            if (!empty($arFilter)){
                $arFilters = array_merge($arFilters,$arFilter);
            }
            $rsItems = \CIBlockElement::GetList(
                [
                    "SORT"=>"ASC"
                ],
                    $arFilters,
                false,
                false,
                ['ID','NAME', 'PREVIEW_TEXT', 'DETAIL_PAGE_URL', 'PROPERTY_POWER']
            );
            $arMenuLinksExt = array();
            while($obItem = $rsItems->GetNextElement()){
                $arFields = $obItem->GetFields();

                if ($UseDescription === true){
                    $arFields['PROPERTIES'] = $obItem->GetProperties(false, array('CODE'=>'POWER'));
                    $sName = $arFields['PREVIEW_TEXT'].' '.$arFields['NAME'].' '.$arFields['PROPERTIES']['POWER']['VALUE'];
                }else{
                    $sName = $arFields['NAME'];
                }

                $arMenuLinksExt[] = Array(
                    $sName,
                    $arFields['DETAIL_PAGE_URL'],
                    Array(),
                    Array(),
                    ""
                );
            }
            $aMenuLinks = array_merge($aMenuLinks, $arMenuLinksExt);
        }
    }

}
