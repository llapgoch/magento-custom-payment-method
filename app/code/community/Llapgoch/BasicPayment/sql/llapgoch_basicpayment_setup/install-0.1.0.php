<?php
$this->startSetup();

// We have to create these columns so that our new fields show up in the sales_flat_order_payment table
// We don't need to create these columns for the quote payment table as the data is copied from the form
// To the quote object in code - it's then converted to an order payment object.
$this->getConnection()->addColumn(
	// getTable returns the name of the table as a string
	$this->getTable('sales/order_payment'),
	'check_no',
	array(
		// Use TYPE_TEXT instead of TYPE_VARCHAR, as it's deprecated and will throw an error
		// Adding a length will make it as varchar
		'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
		'nullable' => true,
		'default' => null,
		// Comment must be provided
		'comment' => 'Check Number',
		'length' => 100			
	)
);

$this->getConnection()->addColumn(
	$this->getTable('sales/order_payment'),
	'check_date',
	array(
		'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
		'nullable' => true,
		'default' => null,
		'comment' => 'Check Date',
		'length' => 255
	)
);

$this->endSetup();