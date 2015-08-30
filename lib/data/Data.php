<?php


class Data
{
    /* connection data */
    const SERVER = "localhost:3306";
    const USERNAME = "root";
    const PASSWORD = "";
    const DB = "documents";


    /* name of table */
    const TABLE = "articles";
    /* fields of table */
    const FIRST_COLUMN = "id_article";
    const SECOND_COLUMN = "title_article";
    const THIRD_COLUMN = "content_article";

    const SELECT = "select";
    const INSERT = "insert";
    const UPDATE = "update";
    const DELETE = "delete";

    /**
     * @param $arr array
     * @param $delimiter string
     * @return string
     */
    static public function prepareParams($arr, $delimiter = ', '){
        $param_string = "";
        for($i = 0; $i < count($arr); $i++){

            if($i === (count($arr)-1)) {
                $param_string .= $arr[$i];
                continue;
            } else {
                $param_string .= $arr[$i] . $delimiter;
            }
            return $param_string;
        }
        return $param_string;
    }


}