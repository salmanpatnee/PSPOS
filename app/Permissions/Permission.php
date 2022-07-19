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
    * Suppliers Permission
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
    * Taxes Permission
    */
    public const CAN_VIEW_TAXES = 'view-taxes';
    public const CAN_CREATE_TAXES = 'create-taxes';
    public const CAN_UPDATE_TAXES = 'update-taxes';
    public const CAN_DELETE_TAXES = 'delete-taxes';


    /*
    * Categories Permission
    */
    public const CAN_VIEW_CATEGORIES = 'view-categories';
    public const CAN_CREATE_CATEGORIES = 'create-categories';
    public const CAN_UPDATE_CATEGORIES = 'update-categories';
    public const CAN_DELETE_CATEGORIES = 'delete-categories';

    /*
    * Brands Permission
    */
    public const CAN_VIEW_BRANDS = 'view-brands';
    public const CAN_CREATE_BRANDS = 'create-brands';
    public const CAN_UPDATE_BRANDS = 'update-brands';
    public const CAN_DELETE_BRANDS = 'delete-brands';

    /*
    * Product Permission
    */
    public const CAN_VIEW_PRODUCTS = 'view-products';
    public const CAN_CREATE_PRODUCTS = 'create-products';
    public const CAN_UPDATE_PRODUCTS = 'update-products';
    public const CAN_DELETE_PRODUCTS = 'delete-products';

    /*
    * Purchase Permission
    */
    public const CAN_VIEW_PURCHASES   = 'view-purchases';
    public const CAN_CREATE_PURCHASES = 'create-purchases';
    public const CAN_UPDATE_PURCHASES = 'update-purchases';
    public const CAN_DELETE_PURCHASES = 'delete-purchases';

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
