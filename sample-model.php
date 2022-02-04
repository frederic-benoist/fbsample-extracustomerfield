<?php declare(strict_types=1);
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    Frédéric BENOIST <info@fbenoist.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

class ExtraCustomerFormData extends ObjectModel
{
    public $id_customer;
    public $alergy;
    public $weight;
    public $diabetic;

    public static $definition = [
        'table' => 'acfo_extracustomerformdata',
        'primary' => 'id_acfo_extracustomerformdata',
        'fields' => [
            'id_customer' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'alergy' => ['type' => self::TYPE_STRING,  'size' => 120, 'validate' => 'isGenericName' ],
            'weight' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'diabetic' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool']
        ],
    ];

    public static function getByIdCustomer($idCustomer)
    {
        $query = new DbQuery();
        $query->from('acfo_extracustomerformdata', 'm');
        $query->select('id_acfo_extracustomerformdata');
        $query->where('m.id_customer = '.(int)$idCustomer);

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);
        if (!is_bool($result)) {
            if (1 == count($result)) {
                return new ExtraCustomerFormData((int)$result['id_acfo_extracustomerformdata']);
            }
        }
        // Return new
        $newExtraCustomerFormData = new ExtraCustomerFormData();
        $newExtraCustomerFormData->id_customer = $idCustomer;
        return $newExtraCustomerFormData;
    }

    public static function createDbTable() : bool
    {
        return Db::getInstance()->Execute(
            'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'acfo_extracustomerformdata`(
                    `id_acfo_extracustomerformdata` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `id_customer` INT(10) UNSIGNED NOT NULL,
                    `alergy` VARCHAR(120) DEFAULT NULL,
                    `weight` INT(10) UNSIGNED NOT NULL DEFAULT \'0\',
                    `diabetic` TINYINT(1) NOT NULL DEFAULT \'0\',
                    PRIMARY KEY (`id_acfo_extracustomerformdata`),
                    UNIQUE KEY (`id_customer`)
                ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8'
        );
    }

    public static function removeDbTable() : bool
    {
        return Db::getInstance()->execute('DROP TABLE `'._DB_PREFIX_.'acfo_extracustomerformdata`');
    }
}
