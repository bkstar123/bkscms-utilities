# bkscms-utilities

> Provides neccessary utilities for a **BKSCMS** project  

For create a **BKSCMS** project, run the following command:  
```composer create-project --prefer-dist bkstar123/bkscms <your-project>```  

## 1. Requirement
It is recommended to install this package with PHP version 7.1.3+ and Laravel Framework version 5.6+

## 2. Installation
    composer require bkstar123/bkscms-utilities

Then, publish the package's configuration file:  
```php artisan vendor:publish --provider=Bkstar123\BksCMS\Utilities\Providers\UtilitiesServiceProvider```  

## 3. Usage

Currently, this package provides two helpers which can be used in a **BKSCMS** project:  
- MenuHelper  
- CrudViewHelper  

### 3.1 MenuHelper

After publishing the package's configuration file, you will get ***config/bkstar123_bkscms_sidebarmenu.php*** where you can a nested array which will then be converted to the content of the CMS side bar menu.  

The initial array is as follows:    
```php
<?php
/**
 * Menu array
 * Each link component consists of 'name', 'path', 'icon', 'children' keys
 * 'name', 'path', 'icon' are of string type, 'children' is of array type
 * 'path' for an expandable link should be '#'
 */
return [
    [
        'name' => 'Dashboard',
        'path' => '/cms/dashboard',
        'icon' => 'fas fa-tachometer-alt',
    ],
    
    [
        'name' => 'Admin Managment',
        'path' => '#',
        'icon' => 'far fa-user',
        'children' => [
            [
                'name' => 'Admins',
                'path' => '/cms/admins',
                'icon' => 'fa fa-users',
            ],
            [
                'name' => 'Create Admin',
                'path' => '/cms/admins/create',
                'icon' => 'fa fa-user-plus',
            ]
        ]
    ],

    [
        'name' => 'Role Managment',
        'path' => '#',
        'icon' => 'fa fa-certificate',
        'children' => [
            [
                'name' => 'Roles',
                'path' => '/cms/roles',
                'icon' => 'fa fa-user-circle',
            ],
            [
                'name' => 'Create Role',
                'path' => '/cms/roles/create',
                'icon' => 'fa fa-plus',
            ]
        ]
    ],

    [
        'name' => 'Permission Managment',
        'path' => '#',
        'icon' => 'fa fa-universal-access',
        'children' => [
            [
                'name' => 'Permissions',
                'path' => '/cms/permissions',
                'icon' => 'fa fa-ship',
            ],
            [
                'name' => 'Create Permission',
                'path' => '/cms/permissions/create',
                'icon' => 'fa fa-plus',
            ]
        ]
    ],
];
```

***name, path*** are mandatory, whereas ***icon, children*** are optional  

### 3.2 CrudViewHelper

Its purpose is to ensure the consistency in all views of your **BKSCMS** project by offering the following view piece:  
- ```php CrudView::checkAllBox(string $color = '')```  
Create a check-all button to check all view items, where **\$color** can be ```primary, danger, success, warning, info, secondary, dark, light```  

- ```php CrudView::checkBox(Model $resource, string $color = '')```  
Create a check button next to each item,  where **\$color** can be ```primary, danger, success, warning, info, secondary, dark, light```, **\$resource** is the item instance  

- ```php CrudView::activeStatus(Model $resource, string $followRoute, string $color = '', string $text = '')```  
Create a button showing a active status, where **$color** can be ```primary, danger, success, warning, info, secondary, dark, light```, **\$resource** is the item instance, **\$followRoute** is the route to be directed to after clicking the button, **\$text** is the text inside the button  

- ```php CrudView::disabledStatus(Model $resource, string $followRoute, string $color = '', string $text = '')```  
Create a button showing a disable status, where **\$color** can be ```primary, danger, success, warning, info, secondary, dark, light```, **\$resource** is the item instance, **\$followRoute** is the route to be directed to after clicking the button, **\$text** is the text inside the button  

- ```php CrudView::removeAllBtn(string $followRoute, string $color = '', string $text = '')```  
Create a button for removing all checked items, where **\$color** can be ```primary, danger, success, warning, info, secondary, dark, light```, **\$followRoute** is the route to be directed to after clicking the button, **\$text** is the text inside the button  

- ```php  CrudView::removeBtn(Model $resource, string $followRoute, string $color = '', string $text = '')```  
Create a removal button for each item, where **\$color** can be ```primary, danger, success, warning, info, secondary, dark, light```, **\$resource** is the item instance, **\$followRoute** is the route to be directed to after clicking the button, **\$text** is the text inside the button  

- ```php CrudView::searchInput(string $searchRoute, string $inputName = 'search')```  
Create a text input for searching item, where **\$searchRoute** is the route to be sent to for searching, **\$inputName** is the name of the text input used for searching  
