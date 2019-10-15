<?foreach ($arResult['ITEMS'] as &$arItem){
    if (!empty($arItem['PROPERTIES']['DOCUMENT']['VALUE'])){
        $iDocument = CFile::GetFileArray($arItem['PROPERTIES']['DOCUMENT']['VALUE']);
        $iDocument['FILE_SIZE'] = CFile::FormatSize($iDocument['FILE_SIZE']);
        $iDocument['EXT'] =  substr($iDocument['ORIGINAL_NAME'],  strripos($iDocument['ORIGINAL_NAME'], '.')+1);
        $arItem['DOCUMENT'] = $iDocument;
    }
}
