<?
namespace Only\Site\Helpers;
use Bitrix\Highloadblock as HL;

Class HLBlock{


    public static function getByName($name)
    {
        $rsData = HL\HighloadBlockTable::getList(array('filter' => array('NAME'=>$name)))->Fetch();
        if (!empty($rsData)){
            return $rsData;
        }else{
            return false;
        }

    }
    public static function getIdByName($name)
    {
        $rsData = self::getByName($name);
        if (!empty($rsData)){
            return $rsData['ID'];
        }else{
            return false;
        }

    }

    public static function getList($select, $filter, $order, $name){
        \CModule::IncludeModule('highloadblock');
        $arHl = self::getByName($name);
        $hlblock = HL\HighloadBlockTable::getById($arHl['ID'])->fetch();
        if (empty($hlblock)){
            return false;
        }
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $entity_table_name = $arHl['TABLE_NAME'];

        $sTableID = 'tbl_' . $entity_table_name;
        $rsData = $entity_data_class::getList(array(
            "select" => $select,
            "filter" => $filter,
            "order" => $order
        ));

        $rsData = new \CDBResult($rsData, $sTableID);
        return $rsData;
    }
}
?>