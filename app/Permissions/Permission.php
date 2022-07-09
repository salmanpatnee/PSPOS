<?php

namespace App\Permissions;

class Permission
{

    /*
    * Customers Permission
    */
    public const CAN_VIEW_CUSTOMERS   = 'view-customers';
    public const CAN_CREATE_CUSTOMERS = 'create-customers';
    public const CAN_UPDATE_CUSTOMERS = 'update-customers';
    public const CAN_DELETE_CUSTOMERS = 'delete-customers';

    /*
    * Customers Permission
    */
    public const CAN_VIEW_SUPPLIERS   = 'view-suppliers';
    public const CAN_CREATE_SUPPLIERS = 'create-suppliers';
    public const CAN_UPDATE_SUPPLIERS = 'update-suppliers';
    public const CAN_DELETE_SUPPLIERS = 'delete-suppliers';

    /*
    * Users Permission
    */
    public const CAN_VIEW_USERS = 'view-users';
    public const CAN_CREATE_USERS = 'create-users';
    public const CAN_UPDATE_USERS = 'update-users';
    public const CAN_DELETE_USERS = 'delete-users';

    /*
    * Categories Permission
    */
    public const CAN_VIEW_CATEGORIES = 'view-categories';
    public const CAN_CREATE_CATEGORIES = 'create-categories';
    public const CAN_UPDATE_CATEGORIES = 'update-categories';
    public const CAN_DELETE_CATEGORIES = 'delete-categories';

    /*
    * Product Permission
    */
    public const CAN_VIEW_PRODUCTS = 'view-products';
    public const CAN_CREATE_PRODUCTS = 'create-products';
    public const CAN_UPDATE_PRODUCTS = 'update-products';
    public const CAN_DELETE_PRODUCTS = 'delete-products';

    /*
    * Business Settings Permissions
    */
    public const CAN_VIEW_SETTINGS = 'view-settings';
    public const CAN_UPDATE_SETTINGS = 'update-settings';

    /*
    * Business Locations Permissions
    */
    public const CAN_VIEW_LOCATIONS = 'view-locations';
    public const CAN_CREATE_LOCATIONS = 'create-locations';
    public const CAN_UPDATE_LOCATIONS = 'update-locations';
    public const CAN_DELETE_LOCATIONS = 'delete-locations';
}
