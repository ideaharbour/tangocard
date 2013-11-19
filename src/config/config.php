<?php
/**
 * Tanngocard configurations
 */
return 
    array(
        "mode" => "sandbox",
        "sandbox" => array ( 
            "host" => "https://sandbox.tangocard.com/raas/v1/",
            "platform_name" => "<Your platform name>",
            "platform_key" => "<Your platform key>",
        ),
        "production" => array ( 
            "host" => "https://sandbox.tangocard.com/raas/v1/",
            "platform_name" => "<Your platform name>",
            "platform_key" => "<Your platform key>",
        ),
        "api" => array(
            "create_account" => "accounts",
            "get_account_info" => "accounts/<customer>/<account-id>",
            "fund_account" => "funds",
            "rewards_list" => "rewards",
            "place_orders" => "orders",
            "get_order_info" => "orders/<order-id>",
            "order_history" => "orders?<Query-String>&account_identifier=<account-id>&customer=<customer>",
        ),
    );
