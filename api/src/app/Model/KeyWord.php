<?php

/**
 * @author : goodtimp
 * @time : 2019-3-1
*/

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;


class KeyWord extends NotORM
{

  protected function getTableName($id)
  {
    return 'keyword';
  }

  /**
     * 查找所有KeyWords
     * @return 返回数据库可操作类型
     */
  public function gesAllKeyWord()
  {
    return $this->getORM()
      ->select('*');
  }

  /**
     * 根据关键字Id得到关键字信息
     * @param string类型，逗号分隔类似"1,2,3,"
     * @return Array 关键字文字Array
     */
  public function gesKeyWordsByIds($idarr)
  {
    if ($idarr == null || $idarr == "") return [];

    $commond = "SELECT * FROM keyword where Id in (:ids)";
    $params = array(':ids' => $idarr);
    return $this->getORM()->queryAll($commond, $params);
  }
  /**
     * 根据KeyWord字段得到关键字信息
     * @param string类型，逗号分隔类似"三角函数,二元一次,"
     * @return 关键字Id Array
     */
  public function gesKeyWordsByWords($words)
  {
    if ($words == null || $words == "") return [];
  
    // 数据库查询语句，判断题目中存在的关键字
    $command = 'select * from keyword where :words like concat("%",Word,"%")';
    $params = array(':words' => $words);
    return  $this->getORM()->queryAll($command,$params);
  }

  /**
   * 添加关键字
   */
  public function addKeyword($data)
  {
    $model = $this->getORM();
    $model->insert($data);
    return $model->insert_id();
  }
}
