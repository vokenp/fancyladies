<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],

        [
            'section' => 'Quick Menus',
        ],
        [
            'title' => 'My Appointments',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'Record Sales',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'apps/sales',
            'new-tab' => false,
        ],
        [
            'title' => 'Mpesa Transactions',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'apps/mpesa',
            'new-tab' => false
        ],
        [
            'title' => 'Record Expenses',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'apps/expenses',
            'new-tab' => false
        ],
        [
            'section' => '*************************',
        ],

        [
            'title' => 'My Records',
            'icon' => 'media/svg/icons/Shopping/Dollar.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Customers',
                    'page' => 'apps/customers',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Employees',
                    'page' => 'apps/employees',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Services',
                    'page' => 'apps/shopservices',
                    'new-tab' => false,
                ],
                
            ]
        ],


        [
            'title' => 'Communication',
            'icon' => 'media/svg/icons/Communication/Chat4.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Compose SMS',
                    'page' => 'apps/composesms',
                    'new-tab' => false,
                ],
                [
                    'title' => 'SMS Templates',
                    'page' => 'apps/smstemplate',
                    'new-tab' => false,
                ],
                [
                    'title' => 'SMS Groups',
                    'page' => 'apps/smsgroup',
                    'new-tab' => false,
                ],
                [
                    'title' => 'SMS Boxes',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'SMS Outbox',
                            'page' => 'apps/smsoutbox'
                        ],
                        [
                            'title' => 'Pending SMS Box',
                            'page' => 'apps/smspendingbox'
                        ],
                        [
                            'title' => 'Failed SMS Box',
                            'page' => 'apps/smsfailedbox'
                        ]
                    ]
                ]
                
                
            ]
        ],
    ]
 ];