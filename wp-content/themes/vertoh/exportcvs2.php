<?php
/**
 * ---------------------------------------------------------------------------------
 *
 * 1997-2015 Quadra Informatique
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ecommerce@quadra-informatique.fr so we can send you a copy immediately.
 *
 * @author    Quadra Informatique <ecommerce@quadra-informatique.fr>
 * @copyright 1997-2015 Quadra Informatique
 * @version Release: $Revision: 1.3.0 $
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * ---------------------------------------------------------------------------------
 */


	public function hookPostUpdateOrderStatus($params)
	{
		if ($params['newOrderStatus']->id == Configuration::get('PS_OS_PAYMENT'))
			$this->sendExportByEmail($params);
	}

	protected function sendExportByEmail($params)
	{
		if (Configuration::get('PS_SCE_SEND_COPY'))
		{
			$csv_header_sent = false;
			$orders = Db::getInstance()->ExecuteS ('SELECT
			                    o.id_order AS order_id,
			                    od.product_reference AS product_reference,
			                    od.product_name AS product_name,
			                    od.product_price AS product_price,
			                    od.product_weight AS product_weight,
			                    od.product_quantity AS product_quantity,
			                    od.product_quantity_refunded AS product_quantity_refunded,
			                    od.product_quantity_return AS product_quantity_return,
			                    od.tax_rate AS product_tax_rate,
			                    od.ecotax AS product_ecotax,
			                    od.discount_quantity_applied AS product_discount_quantity_applied,
			                    o.id_customer AS customer_id,
			                    ainv.firstname AS invoice_firstname,
			                    ainv.lastname AS invoice_lastname,
			                    ainv.company AS invoice_company,
			                    ainv.address1 AS invoice_address1,
			                    ainv.address2 AS invoice_address2,
			                    ainv.postcode AS invoice_postcode,
			                    ainv.city AS invoice_city,
			                    ainv.phone AS invoice_phone,
			                    ainv.phone_mobile AS invoice_phone_mobile,
			                    adel.firstname AS delivery_firstname,
			                    adel.lastname AS delivery_lastname,
			                    adel.company AS delivery_company,
			                    adel.address1 AS delivery_address1,
			                    adel.address2 AS delivery_address2,
			                    adel.postcode AS delivery_postcode,
			                    adel.city AS delivery_city,
			                    adel.phone AS delivery_phone,
			                    adel.phone_mobile AS delivery_phone_mobile,
			                    DATE(o.invoice_date) AS invoice_date,
			                    o.payment AS payment,
			                    DATE(o.delivery_date) AS delivery_date,
			                    o.shipping_number AS shipping_number,
			                    (SELECT osl.name
			                        FROM
			                            ps_order_history oh,
			                            ps_order_state_lang osl
			                        WHERE o.id_order=oh.id_order
			                        AND oh.id_order_state = osl.id_order_state
			                        ORDER BY id_order_history DESC LIMIT 1) AS status,
			                    o.total_discounts AS total_discounts,
			                    o.total_paid AS total_paid,
			                    o.total_paid_real AS total_paid_real,
			                    o.total_products AS total_products,
			                    o.total_products_wt AS total_products_wt,
			                    o.total_shipping AS total_shipping,
			                    o.total_wrapping AS total_wrapping,
			                    cur.name AS currency
			                FROM ps_orders o
			                LEFT JOIN ps_order_detail od ON o.id_order=od.id_order
			                LEFT JOIN ps_address ainv ON o.id_address_invoice=ainv.id_address
			                LEFT JOIN ps_address adel ON o.id_address_delivery=adel.id_address
			                LEFT JOIN ps_currency cur ON o.id_currency=cur.id_currency
			                WHERE o.valid=1 AND o.id_order='.pSQL($params['id_order']).'
			                ORDER BY o.id_order, od.id_order_detail ASC');

			$time = date('Y-m-d_H-i-s');
			$filename = 'export_orders_'.$time.'.csv';

			$stdout = fopen(_PS_MODULE_DIR_.'simplecsvexport/'.$filename, 'w');

			// BOM utf8
			fwrite($stdout, chr(239).chr(187).chr(191));
			// while ($row = Db::getInstance()->nextRow($orders))
			foreach ($orders as $row)
			{
				//number format
				foreach (array('product_price', 'product_weight', 'product_tax_rate', 'product_ecotax',
			'product_discount_quantity_applied', 'total_discounts', 'total_paid', 'total_paid_real',
			'total_products', 'total_products_wt', 'total_shipping', 'total_wrapping') as $field)
					$row[$field] = str_replace('.', ',', $row[$field]);

				//phone format
				foreach (array('invoice_phone', 'invoice_phone_mobile', 'delivery_phone', 'delivery_phone_mobile') as $field)
					$row[$field] = preg_replace('[^0-9]', '', $row[$field]).' ';

				//csv header
				if (!$csv_header_sent)
					$csv_header_sent = fputcsv($stdout, array_keys($row), ';', '"');
				//write line
				fputcsv($stdout, $row, ';', '"');

			}

			fclose($stdout);
