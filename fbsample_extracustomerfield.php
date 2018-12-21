<?php
/**
 * 2007-2018 Frédéric BENOIST
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 *  @author    Frédéric BENOIST
 *  @copyright 2013-2018 Frédéric BENOIST <https://www.fbenoist.com/>
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class FbSample_ExtraCustomerField extends Module
{
    public function __construct()
    {
        $this->name = 'fbsample_extracustomerfield';
        $this->author = 'Frédéric BENOIST';
        $this->version = '1.0.0';
        $this->need_instance= 0;
        $this->bootstrap = true;
        $this->tab = 'others';
        parent::__construct();

        $this->displayName = $this->l('Extra customer field');
        $this->ps_versions_compliancy = array(
            'min' => '1.7',
            'max' => _PS_VERSION_
        );
        $this->description = $this->l('Add extra customer field');
    }

    /**
     * Install module
     *
     * @return bool true if success
     */
    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (!parent::install()
            || !$this->alterCustomerTable()
            || !$this->registerHook('additionalCustomerFormFields')
            || !$this->registerHook('validateCustomerFormFields')
            || !$this->registerHook('actionObjectCustomerUpdateAfter')
            || !$this->registerHook('actionObjectCustomerAddAfter')
        ) {
            return false;
        }
        return true;
    }

    /**
     * Alter customer table, add module fields
     *
     * @return bool true if success or already done.
     */
    protected function alterCustomerTable()
    {
        Db::getInstance()->execute('ALTER TABLE `'. _DB_PREFIX_.'customer` ADD `hobbies` text');
        return true;
    }

    /**
     * Read Module fields values
     *
     * @return array of module value
     */
    protected function readModuleValues()
    {
        $id_customer = Context::getContext()->customer->id;
        $query = 'SELECT c.`hobbies`'
            .' FROM `'. _DB_PREFIX_.'customer` c '
            .' WHERE c.id_customer = '.(int)$id_customer;
        return  Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);
    }

    /**
     * Write module fields values
     *
     * @return nothing
     */
    protected function writeModuleValues($id_customer)
    {
        $hobbies = Tools::getValue('hobbies');
        $query = 'UPDATE `'._DB_PREFIX_.'customer` c '
            .' SET  c.`hobbies` = "'.pSQL($hobbies).'"'
            .' WHERE c.id_customer = '.(int)$id_customer;
        Db::getInstance()->execute($query);
    }

    /**
     * Add fields in Customer Form
     *
     * @param array $params parameters (@see CustomerFormatter->getFormat())
     *
     * @return array of extra FormField
     */
    public function hookAdditionalCustomerFormFields($params)
    {
        $module_fields = $this->readModuleValues();

        $hobbies_value = Tools::getValue('hobbies');
        if (isset($module_fields['hobbies'])) {
            $hobbies_value = $module_fields['hobbies'];
        }

        $extra_fields = array();
        $extra_fields['hobbies'] = (new FormField)
            ->setName('hobbies')
            ->setType('text')
            ->setValue($hobbies_value)
            ->setLabel($this->l('Hobbies'));

        return $extra_fields;
    }

    /**
     * Validate fields in Customer form
     *
     * @param array $params hook call parameters (@see CustomerForm->validateByModules())
     *
     * @return array of extra FormField
     */
    public function hookvalidateCustomerFormFields($params)
    {
        $module_fields = $params['fields'];
        if ('Dance' != $module_fields[0]->getValue()
            && 'Shopping' != $module_fields[0]->getValue()
            && 'Yoga' != $module_fields[0]->getValue()
        ) {
            $module_fields[0]->addError(
                $this->l('Only "Dance", "Shopping" or "Yoga"')
            );
        }
        return array(
            $module_fields
        );
    }

    /**
     * Customer update
     */
    public function hookactionObjectCustomerUpdateAfter($params)
    {
        $id = (int)$params['object']->id;
        $this->writeModuleValues($id);
    }

    /**
     * Customer add
     */
    public function hookactionObjectCustomerAddAfter($params)
    {
        $id = (int)$params['object']->id;
        $this->writeModuleValues($id);
    }
}
