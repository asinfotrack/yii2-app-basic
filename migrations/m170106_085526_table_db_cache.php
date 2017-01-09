<?php
use yii\helpers\FileHelper;

$classAlias = '@vendor/yiisoft/yii2/caching/migrations/m150909_153426_cache_init.php';
require(FileHelper::normalizePath(Yii::getAlias($classAlias)));

/**
 * Dummy class which extends the cache-migration
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class m170106_085526_table_db_cache extends m150909_153426_cache_init
{

}
