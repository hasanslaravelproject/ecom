<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'order_categories' => [
        'name' => 'Order Categories',
        'index_title' => 'OrderCategories List',
        'new_title' => 'New Order category',
        'create_title' => 'Create OrderCategory',
        'edit_title' => 'Edit OrderCategory',
        'show_title' => 'Show OrderCategory',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'product_categories' => [
        'name' => 'Product Categories',
        'index_title' => 'ProductCategories List',
        'new_title' => 'New Product category',
        'create_title' => 'Create ProductCategory',
        'edit_title' => 'Edit ProductCategory',
        'show_title' => 'Show ProductCategory',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'menu_types' => [
        'name' => 'Menu Types',
        'index_title' => 'MenuTypes List',
        'new_title' => 'New Menu type',
        'create_title' => 'Create MenuType',
        'edit_title' => 'Edit MenuType',
        'show_title' => 'Show MenuType',
        'inputs' => [
            'date' => 'Date',
        ],
    ],

    'products' => [
        'name' => 'Products',
        'index_title' => 'Products List',
        'new_title' => 'New Product',
        'create_title' => 'Create Product',
        'edit_title' => 'Edit Product',
        'show_title' => 'Show Product',
        'inputs' => [
            'name' => 'Name',
            'quantity' => 'Quantity',
            'unitprice' => 'Unitprice',
            'image' => 'Image',
            'status' => 'Status',
            'unit_id' => 'Unit',
            'product_category_id' => 'Product Category',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'Orders List',
        'new_title' => 'New Order',
        'create_title' => 'Create Order',
        'edit_title' => 'Edit Order',
        'show_title' => 'Show Order',
        'inputs' => [
            'quantity' => 'Quantity',
            'date' => 'Date',
            'product_id' => 'Product',
            'order_category_id' => 'Order Category',
            'menu_type_id' => 'Menu Type',
        ],
    ],

    'units' => [
        'name' => 'Units',
        'index_title' => 'Units List',
        'new_title' => 'New Unit',
        'create_title' => 'Create Unit',
        'edit_title' => 'Edit Unit',
        'show_title' => 'Show Unit',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'customers' => [
        'name' => 'Customers',
        'index_title' => 'Customers List',
        'new_title' => 'New Customer',
        'create_title' => 'Create Customer',
        'edit_title' => 'Edit Customer',
        'show_title' => 'Show Customer',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'passcode' => 'Passcode',
            'comapany_id' => 'Comapany',
        ],
    ],

    'setups' => [
        'name' => 'Setups',
        'index_title' => 'Setups List',
        'new_title' => 'New Setup',
        'create_title' => 'Create Setup',
        'edit_title' => 'Edit Setup',
        'show_title' => 'Show Setup',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'companies' => [
        'name' => 'Companies',
        'index_title' => 'Companies List',
        'new_title' => 'New Company',
        'create_title' => 'Create Company',
        'edit_title' => 'Edit Company',
        'show_title' => 'Show Company',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
