<?php namespace Abhi\Tangocard;
 
use Illuminate\Config\Repository;
use Config;

class Tangocard {
 
  	/**
  	 * Create a new platform account on tango card
  	 * “Platform” is Invent Value
	 *
     * “Customer” is the Invent Value Client Manager
     *
     *
     * TODO:: order history
  	 * 
  	 */
    public static function createAccount($identifier, $email, $customer){
		$params = array();
		$params['identifier'] = $identifier;
		$params['email'] = $email;
		$params['customer'] = $customer;
		$tangocardCurl = new TangocardCurl;
		return $data = $tangocardCurl->postRequest(Config::get('tangocard::api.create_account'), $params);
    }

  	/**
  	 * Get platform account detail on tango card
	 *
     * “Customer” is the Invent Value Client Manager
  	 * 
  	 */
    public static function getAccountDetail($identifier, $customer){
		$params = array();
		$params['account-id'] = $identifier;
		$params['customer'] = $customer;
		$tangocardCurl = new TangocardCurl;
		return $data = $tangocardCurl->getRequest(Config::get('tangocard::api.get_account_info'), $params);
    }

  	/**
  	 * fund an account, amount will be provided in cents
	 * 
  	 */
    public static function fundAccount($identifier, $customer, $amount, $ip, $cardNumber, $expiry, $cvv, $fname, $lname, $address, $city, $state, $zip, $country, $email){
		$params = array();
		$params['account_identifier'] = $identifier;
		$params['customer'] = $customer;
		$params['amount'] = $amount; // in cents
		$params['client_ip'] = $ip;
		$params['credit_card'] = array();
		$params['credit_card']['number'] = $cardNumber;
		$params['credit_card']['expiration'] = $expiry;
		$params['credit_card']['security_code'] = $cvv;
		$params['credit_card']['billing_address'] = array();
		$params['credit_card']['billing_address']['f_name'] = $fname;
		$params['credit_card']['billing_address']['l_name'] = $lname;
		$params['credit_card']['billing_address']['address'] = $address;
		$params['credit_card']['billing_address']['city'] = $city;
		$params['credit_card']['billing_address']['state'] = $state;
		$params['credit_card']['billing_address']['zip'] = $zip;
		$params['credit_card']['billing_address']['country'] = $country;
		$params['credit_card']['billing_address']['email'] = $email;

		$tangocardCurl = new TangocardCurl;
		return $data = $tangocardCurl->postRequest(Config::get('tangocard::api.fund_account'), $params);
    }

  	/**
  	 * get rewards
	 *
  	 */
    public static function getRewards(){
		$params = array();
		$tangocardCurl = new TangocardCurl;
		return $data = $tangocardCurl->getRequest(Config::get('tangocard::api.rewards_list'), $params);
    }

  	/**
  	 * create new order
	 *
  	 */
    public static function newOrder($identifier, $customer, $campaign, $fromName, $subject, $recipientName, $recipientEmail, $sku, $amount, $message){
		$params = array();
		$params['account_identifier'] = $identifier;
		$params['customer'] = $customer;
		$params['campaign'] = $campaign;
		$params['from'] = $fromName;
		$params['subject'] = $subject;
		$params['recipient'] = array();
		$params['recipient']['name'] = $recipientName;
		$params['recipient']['email'] = $recipientEmail;
		$params['sku'] = $sku;
		$params['amount'] = $amount; // in cents
		$params['message'] = $message;
		$tangocardCurl = new TangocardCurl;
		return $data = $tangocardCurl->postRequest(Config::get('tangocard::api.place_orders'), $params);
    }

    public static function getOrderDetail($orderId) {
		$params = array();
		$params['order-id'] = $orderId;
		$tangocardCurl = new TangocardCurl;
		return $data = $tangocardCurl->getRequest(Config::get('tangocard::api.get_order_info'), $params);
    }
}