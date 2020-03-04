<?php
namespace Rasik\Contacts\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        /**
         * Create table 'rasik_contacts'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('rasik_contacts')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'ID'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Banner Name'
        )->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'URL Link'
        )->addColumn(
            'phone_number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'phone number'
        )->addColumn(
            'image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Attached Image'
        )->addColumn(
            'whats_your_mind',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'What’s on your mind?'
        )->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Contact Status: Enabled is 1 and Disabled is 2'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Banner Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Banner Modification Time'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable('rasik_contacts'),
                ['name','email'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['name','email'],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Contacts Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
