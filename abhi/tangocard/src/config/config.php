<?php
/**
 * Tanngocard configurations
 */
return 
    array(
        "mode" => "sandbox",
        "sandbox" => array ( 
            "host" => "https://sandbox.tangocard.com/raas/v1/",
            "platform_name" => "FreshTest",
            "platform_key" => "pDKEiwJEd2l542d9vTb64ey4b+00o28P3+9Hn4at3y/IE4Rc66sqXV0RY0I=",
        ),
        "production" => array ( 
            "host" => "https://sandbox.tangocard.com/raas/v1/",
            "platform_name" => "FreshTest",
            "platform_key" => "pDKEiwJEd2l542d9vTb64ey4b+00o28P3+9Hn4at3y/IE4Rc66sqXV0RY0I=",
        ),
        "api" => array(
            "create_account" => "accounts",
            "get_account_info" => "accounts/<customer>/<account-id>",
            "fund_account" => "funds",
            "rewards_list" => "rewards",
            "place_orders" => "orders",
            "get_order_info" => "orders/<order-id>",
            "order_history" => "orders?",
        ),
    );
