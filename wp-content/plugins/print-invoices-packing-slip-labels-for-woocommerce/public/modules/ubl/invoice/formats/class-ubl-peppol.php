<?php
namespace Wtpdf\Ubl\Invoice\Formats;
use \Wtpdf\Ubl\Documents\Invoice;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !class_exists( '\\Wtpdf\\Ubl\\Invoice\\Formats\\UblPeppol' ) ) {
    class UblPeppol extends \Wtpdf\Ubl\Documents\Invoice {

        CONST INVOICE_TYPE_CODE = '380';

        public $ubl_order = null;
        protected $typcode = self::INVOICE_TYPE_CODE;
        public $elements = array();
        public $ubl_format_name = 'ubl_peppol';
        
        public function __construct( $order = null ) {
            parent::__construct();

            $this->ubl_order = $order;
            $this->elements = array(

                // BT-24: Specification identifier or Customization identifier.
                'specification' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_specification(),
                ),

                // BT-23: Profile identifier.
                'profile_identifier' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_profile_identifier()
                ),

                // BT-1: Invoice number.
                'invoice_number' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_number( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-2: Invoice issue date.
                'issue_date' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_issue_date( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-9: Invoice due date.
                'due_date' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_due_date( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-3: Invoice type code.
                'invoice_typecode' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_typecode(),
                ),

                // BT-22: Invoice notes.
                'notes' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_notes( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-7: Invoice tax point date.
                'tax_points_date' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_tax_points_date( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-5: Invoice currency code.
                'currency_code' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_currency_code( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-6: Invoice tax currency code.
                'tax_currency_code' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_tax_currency_code( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-19: Buyer accounting reference.
                'buyer_accounting_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_buyer_accounting_reference( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BT-10: Buyer reference.
                'buyer_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_buyer_reference( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BG-14: Invoice period.
                'invoice_period' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_period( $this->ubl_order, $this->ubl_format_name ),
                ),

                // // BT-13: Purchase order reference and BT-14: Sales order reference
                'order_reference' => array(
                    'enabled' => false,
                    'value_arr' => $this->get_formatted_order_reference( $this->ubl_order, $this->ubl_format_name ),
                    
                ),

                // // BG-3: Originator document reference.
                'originator_document_reference' => array(
                    'enabled' => false,
                    'value_arr' => $this->get_formatted_originator_document_reference( $this->ubl_order, $this->ubl_format_name ),
                ),

                // // BT-12: Contract document reference.
                'contract_document_reference' => array(
                    'enabled' => false,
                    'value_arr' => $this->get_formatted_contract_document_reference( $this->ubl_order, $this->ubl_format_name ),
                ),

                // BG-24: Attachments node
                'attachments' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_attachments( $this->ubl_order, $this->ubl_format_name ),
                ),

                // Seller node
                'seller' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_accounting_supplier_party( $this->ubl_order, $this->ubl_format_name ),
                ),

                // Buyer node
                'buyer' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_accounting_customer_party( $this->ubl_order, $this->ubl_format_name ),
                ),

                
                // Payee node
                // Delivery node
                // Payment nodes
                // Allowances and charges

                // Invoice totals
                'tax_subtotal' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_tax_subtotal_details(),
                ),

                // // legal monitory tax total
                'legal_monitory_tax_total' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_legal_monitory_tax_total(),
                ),

                // Invoice lines
                'invoice_lines' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_lines(),
                ),
            );
        }
        
        /**
         * Creates a new instance of the class.
         *
         * This method returns a new instance of the class, optionally initialized with an order.
         *
         * @param mixed $order Optional. The order to initialize the instance with. Default is null.
         * @return self A new instance of the class.
         */
        public static function instance( $order = null ) {
            return new self( $order);
        }

        /**
         * Retrieves the document namespace for the UBL PEPPOL invoice format.
         *
         * This method returns an array containing the XML namespace declarations
         * required for the UBL PEPPOL invoice format. The namespaces include:
         * - 'xmlns': The main UBL invoice namespace.
         * - 'xmlns:cac': The namespace for common aggregate components.
         * - 'xmlns:cbc': The namespace for common basic components.
         *
         * @return array An associative array of XML namespace declarations.
         */
        public function get_document_namespace() {
            return array(
                'xmlns' => 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2',
                'xmlns:cac' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2',
                'xmlns:cbc' => "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
            );
        }

        /**
         * Retrieves the formatted elements for the UBL invoice.
         *
         * This method applies the 'wtpdf_ubl_format_elements' filter to the elements
         * of the UBL invoice, allowing for customization of the formatted elements.
         *
         * @return array The formatted elements for the UBL invoice.
         *
         * @hook wtpdf_ubl_format_elements Allows customization of the formatted elements.
         * @param array $elements The elements of the UBL invoice.
         * @param object $order The WooCommerce order object.
         * @param string $context The context in which the filter is applied, in this case 'ublinvoice'.
         */
        public function get_formatted_elements() {
            return apply_filters( 'wtpdf_ubl_format_elements', $this->elements, $this->ubl_order, $this->ubl_format_name, 'ublinvoice' );
        }
        
        /**
         * Retrieves the specification string for the UBL PEPPOL format.
         *
         * This method returns a string that specifies the compliance and billing
         * format for UBL PEPPOL invoices.
         *
         * @return string The specification string for UBL PEPPOL format.
         */
        public function get_specification(): string {
            return "urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0";
        }

        /**
         * Retrieves the formatted specification for the UBL PEPPOL invoice.
         *
         * This method returns an associative array containing the name and value
         * of the UBL PEPPOL invoice specification. The 'name' key is set to 
         * 'cbc:CustomizationID', which is the XML element name for the specification
         * identifier in UBL. The 'value' key is set to the result of the 
         * get_specification() method, which provides the actual specification string.
         *
         * @return array An associative array with 'name' and 'value' keys representing
         *               the formatted specification for UBL PEPPOL invoices.
         */
        public function get_formatted_specification(): array {
            return array(
                'name' => 'cbc:CustomizationID',
                'value' => $this->get_specification(),
            );
        }

        /**
         * Retrieves the formatted specification for the UBL Peppol invoice.
         *
         * This method returns an associative array containing the name and value
         * of the UBL Peppol invoice specification. The 'name' key is set to 
         * 'cbc:CustomizationID', and the 'value' key is set to the result of 
         * the get_specification() method.
         *
         * @return array An associative array with 'name' and 'value' keys.
         */
        public function get_formatted_profile_identifier(): array {
            return array(
                'name' => 'cbc:ProfileID',
                'value' => $this->get_profile_identifier(),
            );
        }

        /**
         * Retrieves the profile identifier for the UBL PEPPOL invoice.
         *
         * This method returns a string that represents the profile identifier
         * used in UBL PEPPOL invoices. The profile identifier specifies the
         * business process and transaction for which the invoice is intended.
         *
         * @return string The profile identifier for UBL PEPPOL invoices.
         */
        public function get_profile_identifier(): string {
            return "urn:fdc:peppol.eu:2017:poacc:billing:01:1.0";
        }

        /**
         * Retrieves the formatted invoice type code.
         *
         * This method returns an array containing the name and value of the invoice type code.
         *
         * @return array An associative array with the following keys:
         *               - 'name': The name of the invoice type code element.
         *               - 'value': The value of the invoice type code, retrieved from the UBL order.
         */
        public function get_formatted_invoice_typecode(): array {
            return array(
                'name' => 'cbc:InvoiceTypeCode',
                'value' => $this->get_invoice_typecode( $this->ubl_order ),
            );
        }

        /**
         * Retrieves the invoice type code.
         *
         * This method returns the invoice type code stored in the $typcode property.
         * The type code is typically used to identify the nature of the invoice
         * in UBL (Universal Business Language) documents.
         *
         * @param mixed $order The order object (not used in this method, but kept for consistency with other methods).
         * @return string The invoice type code.
         */
        public function get_invoice_typecode( $order ): string {
            return $this->typcode;
        }

        /**
         * Get formatted attachments for UBL order.
         *
         * This method generates an array representing the formatted attachments for a given UBL order.
         * It includes the order ID, a description of the document, and the PDF attachment encoded in base64.
         *
         * @param object $ubl_order The UBL order object.
         * @param string $ubl_format_name The name of the UBL format.
         * @return array The formatted attachments array.
         */
        public function get_formatted_attachments( $ubl_order, $ubl_format_name) {
            $order_id = $ubl_order->get_id();
            return array(
                'name' => 'cac:AdditionalDocumentReference',
                'value' => array(
                    array(
                        'name' => 'cbc:ID',
                        'value' => $order_id,
                    ),
                    array(
                        'name' => 'cbc:DocumentDescription',
                        'value' => 'The PDF Invoice',
                    ),
                    array(
                        'name' => 'cac:Attachment',
                        'value' => array(
                            array(
                                'name' => 'cbc:EmbeddedDocumentBinaryObject',
                                'value' => $this->convert_pdf_attachment_to_base64( $order_id, $ubl_format_name ),
                                'attributes' => array(
                                    'mimeCode' => 'application/pdf',
                                    'filename' => $this->get_attachment_name_for_ubl_invoice( $order_id, $ubl_format_name ) . '.pdf',
                                ),
                            )
                        ),
                    ),
                ),
            );
        }

        /**
         * Retrieves the shop's country code.
         *
         * This method attempts to get the shop's country code from the WooCommerce Packing List plugin's options.
         * If not found, it falls back to the WooCommerce default country setting.
         * If neither option is set, it returns an empty string.
         *
         * @return string The country code of the shop, or an empty string if not set.
         */
        public function get_shop_country() {
            if ( !empty( \Wf_Woocommerce_Packing_List::get_option( 'wf_country' ) ) ) {
                $result = \Wf_Woocommerce_Packing_List::get_option( 'wf_country' );   
            } else if ( !empty( get_option( 'woocommerce_default_country' ) ) ) {
                $result = get_option( 'woocommerce_default_country' );
            } else{
                $result = '';
            }
            
            // String type check before processing.
            if ( is_string( $result ) ) {
                $result = explode( ":", $result );
                return isset($result[0]) ? $result[0] : '';  // Added isset check to avoid undefined index notice.
            }
            
            return '';
        }

        /**
         * Retrieves the formatted tax subtotal details for the current order.
         *
         * This method processes the tax rates associated with the current WooCommerce order
         * and formats them into an array structure suitable for UBL (Universal Business Language) 
         * PEPPOL (Pan-European Public Procurement On-Line) invoices.
         *
         * @return array An array representing the formatted tax subtotal details, including
         *               taxable amounts, tax amounts, tax categories, and tax schemes.
         */
        public function get_formatted_tax_subtotal_details() {
            $formatted_tax_array = array_map( function( $item ) {
                return array(
                    'enabled' => true,
                    'name'  => 'cac:TaxSubtotal',
                    'value' => array(
                        array(
                            'name'       => 'cbc:TaxableAmount',
                            'value'      => round( $item['total_ex'], 2 ),
                            'attributes' => array(
                                'currencyID' => $this->ubl_order->get_currency(),
                            ),
                        ),
                        array(
                            'name'       => 'cbc:TaxAmount',
                            'value'      => round( $item['total_tax'], 2 ),
                            'attributes' => array(
                                'currencyID' => $this->ubl_order->get_currency(),
                            ),
                        ),
                        array(
                            'name'  => 'cac:TaxCategory',
                            'value' => array(
                                array(
                                    'name'  => 'cbc:ID',
                                    'value' => strtoupper( $item['category'] ),
                                ),
                                array(
                                    'name'  => 'cbc:Name',
                                    'value' => $item['name'],
                                ),
                                array(
                                    'name'  => 'cbc:Percent',
                                    'value' => round( $item['percentage'], 1 ),
                                ),
                                array(
                                    'name'  => 'cac:TaxScheme',
                                    'value' => array(
                                        array(
                                            'name'  => 'cbc:ID',
                                            'value' => strtoupper( $item['scheme'] ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                );
            }, $this->get_current_wc_order_tax_rates( $this->ubl_order ) );

            $formatted_tax_array = array_values( $formatted_tax_array );
            $tax_total_arr = array(
                'name'  => 'cac:TaxTotal',
                'value' => array(
                    array(
                        'name'       => 'cbc:TaxAmount',
                        'value'      => round( $this->ubl_order->get_total_tax(), 2 ),
                        'attributes' => array(
                            'currencyID' => $this->ubl_order->get_currency(),
                        ),
                    ),
                    $formatted_tax_array,
                ),
            );
            return $tax_total_arr;
        }

        /**
         * Get the formatted legal monetary tax total.
         *
         * This method calculates and returns the legal monetary total for the order
         * in a specific format required for UBL (Universal Business Language) PEPPOL invoices.
         *
         * @return array The formatted legal monetary total including:
         *               - LineExtensionAmount: The total amount excluding tax.
         *               - TaxExclusiveAmount: The total amount excluding tax.
         *               - TaxInclusiveAmount: The total amount including tax.
         *               - PayableAmount: The total amount payable.
         *               Each amount includes the currency ID attribute.
         */
        public function get_formatted_legal_monitory_tax_total() {
            $total         = $this->ubl_order->get_total();
            $total_inc_tax = $total;
            $total_exc_tax = $total - $this->ubl_order->get_total_tax();

            $legalMonetaryTotal = array(
                'enabled' => false,
                'name'  => 'cac:LegalMonetaryTotal',
                'value' => array(
                    array(
                        'name'       => 'cbc:LineExtensionAmount',
                        'value'      => $total_exc_tax,
                        'attributes' => array(
                            'currencyID' => $this->ubl_order->get_currency(),
                        ),
                    ),
                    array(
                        'name'       => 'cbc:TaxExclusiveAmount',
                        'value'      => $total_exc_tax,
                        'attributes' => array(
                            'currencyID' => $this->ubl_order->get_currency(),
                        ),
                    ),
                    array(
                        'name'       => 'cbc:TaxInclusiveAmount',
                        'value'      => $total_inc_tax,
                        'attributes' => array(
                            'currencyID' => $this->ubl_order->get_currency(),
                        ),
                    ),
                    array(
                        'name'       => 'cbc:PayableAmount',
                        'value'      => $total,
                        'attributes' => array(
                            'currencyID' => $this->ubl_order->get_currency(),
                        ),
                    ),
                ),
            );

            return $legalMonetaryTotal;
        }
        
        /**
         * Retrieves and formats the invoice lines for the UBL (Universal Business Language) PEPPOL (Pan-European Public Procurement Online) invoice.
         *
         * This method processes the items in the order, including line items, fees, and shipping, and formats them into a structured array
         * suitable for UBL PEPPOL invoices. It includes detailed tax information for each item.
         *
         * @return array $data An array of formatted invoice lines, each containing detailed information about the item, quantity, total amount, and tax details.
         */
        public function get_formatted_invoice_lines () {
            $items = $this->ubl_order->get_items( array( 'line_item', 'fee', 'shipping' ) );
            $data = array();

            // Build the invoice lines
            foreach ( $items as $item_id => $item ) {
                $taxSubtotal      = [];
                $taxDataContainer = ( 'line_item' === $item['type'] ) ? 'line_tax_data' : 'taxes';
                $taxDataKey       = ( 'line_item' === $item['type'] ) ? 'subtotal'      : 'total';
                $lineTotalKey     = ( 'line_item' === $item['type'] ) ? 'line_total'    : 'total';
                $line_tax_data    = $item[ $taxDataContainer ];

                foreach ( $line_tax_data[ $taxDataKey ] as $tax_id => $tax ) {
                    if ( ! is_numeric( $tax ) ) {
                        continue;
                    }

                    $order_tax_data = $this->get_current_wc_order_tax_rates( $this->ubl_order );
                    $taxOrderData  = $order_tax_data[ $tax_id ];

                    $taxSubtotal[] = array(
                        'enabled' => false,
                        'name'  => 'cac:TaxSubtotal',
                        'value' => array(
                            array(
                                'name'       => 'cbc:TaxableAmount',
                                'value'      => round( $item[ $lineTotalKey ], 2 ),
                                'attributes' => array(
                                    'currencyID' => $this->ubl_order->get_currency(),
                                ),
                            ),
                            array(
                                'name'       => 'cbc:TaxAmount',
                                'value'      => round( $tax, 2 ),
                                'attributes' => array(
                                    'currencyID' => $this->ubl_order->get_currency(),
                                ),
                            ),
                            array(
                                'name'  => 'cac:TaxCategory',
                                'value' => array(
                                    array(
                                        'name'  => 'cbc:ID',
                                        'value' => strtoupper( $taxOrderData['category'] ),
                                    ),
                                    array(
                                        'name'  => 'cbc:Name',
                                        'value' => $taxOrderData['name'],
                                    ),
                                    array(
                                        'name'  => 'cbc:Percent',
                                        'value' => round( $taxOrderData['percentage'], 2 ),
                                    ),
                                    array(
                                        'name'  => 'cac:TaxScheme',
                                        'value' => array(
                                            array(
                                                'name'  => 'cbc:ID',
                                                'value' => strtoupper( $taxOrderData['scheme'] ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    );
                }

                $invoiceLine = array(
                    'enabled' => false,
                    'name'  => 'cac:InvoiceLine',
                    'value' => array(
                        array(
                            'name'  => 'cbc:ID',
                            'value' => $item_id,
                        ),
                        array(
                            'name'  => 'cbc:InvoicedQuantity',
                            'value' => $item->get_quantity(),
                            'attributes' => array(
                                'unitCode' => apply_filters( 'wtpdf_ubl_invoice_line_quantity_unit', 'H87', $item, $this->ubl_order, $this->ubl_format_name, 'ublinvoice' ),
                            ),
                        ),
                        array(
                            'name'       => 'cbc:LineExtensionAmount',
                            'value'      => round( $item->get_total(), 2 ),
                            'attributes' => array(
                                'currencyID' => $this->ubl_order->get_currency(),
                            ),
                        ),
                        array(
                            'name'  => 'cac:Item',
                            'value' => array(
                                array(
                                    'name'  => 'cbc:Name',
                                    'value' => $item->get_name(),
                                ),
                            ),
                        ),
                        array(
                            'name'  => 'cac:TaxTotal',
                            'value' => array(
                                array(
                                    'name'       => 'cbc:TaxAmount',
                                    'value'      => round( $item->get_total_tax(), 2),
                                    'attributes' => array(
                                        'currencyID' => $this->ubl_order->get_currency(),
                                    ),
                                ),
                                $taxSubtotal,
                            ),
                        ),
                        
                    ),
                );
                
                $data[] = $invoiceLine;
                // Empty this array at the end of the loop per item, so data doesn't stack
                $taxSubtotal = array();
            }

            return $data;
        }
    }
}