<?
if (!empty($arResult['PROPERTIES']['DOCUMENT']['VALUE'])){
    foreach ($arResult['PROPERTIES']['DOCUMENT']['VALUE'] as &$idDocument){
        $arDocument = CFile::GetFileArray($idDocument);
        $arDocument['FILE_SIZE'] = CFile::FormatSize($arDocument['FILE_SIZE']);
        /*
         * Если не задано описание файла то берем его имя без расширения.
         */
        if (empty($arDocument['DESCRIPTION'])){
            $arDocument['DESCRIPTION'] =  substr($arDocument['ORIGINAL_NAME'], 0, strripos($arDocument['ORIGINAL_NAME'], '.'));

        }
        $arDocument['EXT'] =  substr($arDocument['ORIGINAL_NAME'],  strripos($arDocument['ORIGINAL_NAME'], '.')+1);
        $idDocument = $arDocument;
    }

}
