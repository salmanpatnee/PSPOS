<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\Permission as Rights;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => Rights::CAN_VIEW_USERS]);
        Permission::create(['name' => Rights::CAN_CREATE_USERS]);
        Permission::create(['name' => Rights::CAN_UPDATE_USERS]);
        Permission::create(['name' => Rights::CAN_DELETE_USERS]);

        Permission::create(['name' => Rights::CAN_VIEW_CUSTOMERS]);
        Permission::create(['name' => Rights::CAN_CREATE_CUSTOMERS]);
        Permission::create(['name' => Rights::CAN_UPDATE_CUSTOMERS]);
        Permission::create(['name' => Rights::CAN_DELETE_CUSTOMERS]);

        Permission::create(['name' => Rights::CAN_VIEW_SUPPLIERS]);
        Permission::create(['name' => Rights::CAN_CREATE_SUPPLIERS]);
        Permission::create(['name' => Rights::CAN_UPDATE_SUPPLIERS]);
        Permission::create(['name' => Rights::CAN_DELETE_SUPPLIERS]);

        Permission::create(['name' =>  Rights::CAN_VIEW_CATEGORIES]);
        Permission::create(['name' =>  Rights::CAN_CREATE_CATEGORIES]);
        Permission::create(['name' => Rights::CAN_UPDATE_CATEGORIES]);
        Permission::create(['name' => Rights::CAN_DELETE_CATEGORIES]);

        Permission::create(['name' =>  Rights::CAN_VIEW_BRANDS]);
        Permission::create(['name' =>  Rights::CAN_CREATE_BRANDS]);
        Permission::create(['name' => Rights::CAN_UPDATE_BRANDS]);
        Permission::create(['name' => Rights::CAN_DELETE_BRANDS]);

        Permission::create(['name' =>  Rights::CAN_VIEW_TAXES]);
        Permission::create(['name' =>  Rights::CAN_CREATE_TAXES]);
        Permission::create(['name' => Rights::CAN_UPDATE_TAXES]);
        Permission::create(['name' => Rights::CAN_DELETE_TAXES]);

        Permission::create(['name' =>  Rights::CAN_VIEW_PURCHASES]);
        Permission::create(['name' =>  Rights::CAN_CREATE_PURCHASES]);
        Permission::create(['name' => Rights::CAN_UPDATE_PURCHASES]);
        Permission::create(['name' => Rights::CAN_DELETE_PURCHASES]);

        Permission::create(['name' => Rights::CAN_VIEW_PRODUCTS]);
        Permission::create(['name' => Rights::CAN_CREATE_PRODUCTS]);
        Permission::create(['name' => Rights::CAN_UPDATE_PRODUCTS]);
        Permission::create(['name' => Rights::CAN_DELETE_PRODUCTS]);

        Permission::create(['name' => Rights::CAN_VIEW_SETTINGS]);
        Permission::create(['name' => Rights::CAN_UPDATE_SETTINGS]);

        Permission::create(['name' => Rights::CAN_VIEW_LOCATIONS]);
        Permission::create(['name' => Rights::CAN_CREATE_LOCATIONS]);
        Permission::create(['name' => Rights::CAN_UPDATE_LOCATIONS]);
        Permission::create(['name' => Rights::CAN_DELETE_LOCATIONS]);


        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin']);
        $managerRole = Role::create(['name' => 'Manager']);
        $cashierRole = Role::create(['name' => 'Cashier']);

        // $superAdminRole = Role::find(1);
        // $adminRole = Role::find(2);
        // $managerRole = Role::find(2);


        $superAdminRole->givePermissionTo([
            Rights::CAN_VIEW_USERS,
            Rights::CAN_CREATE_USERS,
            Rights::CAN_UPDATE_USERS,
            Rights::CAN_DELETE_USERS,
            Rights::CAN_VIEW_CATEGORIES,
            Rights::CAN_CREATE_CATEGORIES,
            Rights::CAN_UPDATE_CATEGORIES,
            Rights::CAN_DELETE_CATEGORIES,
            Rights::CAN_VIEW_BRANDS,
            Rights::CAN_CREATE_BRANDS,
            Rights::CAN_UPDATE_BRANDS,
            Rights::CAN_DELETE_BRANDS,
            Rights::CAN_VIEW_TAXES,
            Rights::CAN_CREATE_TAXES,
            Rights::CAN_UPDATE_TAXES,
            Rights::CAN_DELETE_TAXES,
            Rights::CAN_VIEW_PURCHASES,
            Rights::CAN_CREATE_PURCHASES,
            Rights::CAN_UPDATE_PURCHASES,
            Rights::CAN_DELETE_PURCHASES,
            Rights::CAN_VIEW_PRODUCTS,
            Rights::CAN_CREATE_PRODUCTS,
            Rights::CAN_UPDATE_PRODUCTS,
            Rights::CAN_DELETE_PRODUCTS,
            Rights::CAN_VIEW_CUSTOMERS,
            Rights::CAN_CREATE_CUSTOMERS,
            Rights::CAN_UPDATE_CUSTOMERS,
            Rights::CAN_DELETE_CUSTOMERS,
            Rights::CAN_VIEW_SUPPLIERS,
            Rights::CAN_CREATE_SUPPLIERS,
            Rights::CAN_UPDATE_SUPPLIERS,
            Rights::CAN_DELETE_SUPPLIERS,
            Rights::CAN_VIEW_SETTINGS,
            Rights::CAN_UPDATE_SETTINGS,
            Rights::CAN_VIEW_LOCATIONS,
            Rights::CAN_CREATE_LOCATIONS,
            Rights::CAN_UPDATE_LOCATIONS,
            Rights::CAN_DELETE_LOCATIONS,
        ]);

        $adminRole->givePermissionTo([
            Rights::CAN_VIEW_USERS,
            Rights::CAN_CREATE_USERS,
            Rights::CAN_UPDATE_USERS,
            Rights::CAN_DELETE_USERS,
            Rights::CAN_VIEW_CATEGORIES,
            Rights::CAN_CREATE_CATEGORIES,
            Rights::CAN_UPDATE_CATEGORIES,
            Rights::CAN_DELETE_CATEGORIES,
            Rights::CAN_VIEW_BRANDS,
            Rights::CAN_CREATE_BRANDS,
            Rights::CAN_UPDATE_BRANDS,
            Rights::CAN_DELETE_BRANDS,
            Rights::CAN_VIEW_TAXES,
            Rights::CAN_CREATE_TAXES,
            Rights::CAN_UPDATE_TAXES,
            Rights::CAN_DELETE_TAXES,
            Rights::CAN_VIEW_PRODUCTS,
            Rights::CAN_CREATE_PRODUCTS,
            Rights::CAN_UPDATE_PRODUCTS,
            Rights::CAN_DELETE_PRODUCTS,
            Rights::CAN_VIEW_CUSTOMERS,
            Rights::CAN_VIEW_PURCHASES,
            Rights::CAN_CREATE_PURCHASES,
            Rights::CAN_UPDATE_PURCHASES,
            Rights::CAN_DELETE_PURCHASES,
            Rights::CAN_CREATE_CUSTOMERS,
            Rights::CAN_UPDATE_CUSTOMERS,
            Rights::CAN_DELETE_CUSTOMERS,
            Rights::CAN_VIEW_SUPPLIERS,
            Rights::CAN_CREATE_SUPPLIERS,
            Rights::CAN_UPDATE_SUPPLIERS,
            Rights::CAN_DELETE_SUPPLIERS,
        ]);

        $managerRole->givePermissionTo([
            Rights::CAN_VIEW_CATEGORIES,
            Rights::CAN_CREATE_CATEGORIES,
            Rights::CAN_UPDATE_CATEGORIES,
            Rights::CAN_DELETE_CATEGORIES,
            Rights::CAN_VIEW_BRANDS,
            Rights::CAN_CREATE_BRANDS,
            Rights::CAN_UPDATE_BRANDS,
            Rights::CAN_DELETE_BRANDS,
            Rights::CAN_VIEW_PRODUCTS,
            Rights::CAN_CREATE_PRODUCTS,
            Rights::CAN_UPDATE_PRODUCTS,
            Rights::CAN_DELETE_PRODUCTS,
            Rights::CAN_VIEW_CUSTOMERS,
            Rights::CAN_CREATE_CUSTOMERS,
            Rights::CAN_UPDATE_CUSTOMERS,
            Rights::CAN_DELETE_CUSTOMERS,
            Rights::CAN_VIEW_SUPPLIERS,
            Rights::CAN_CREATE_SUPPLIERS,
            Rights::CAN_UPDATE_SUPPLIERS,
            Rights::CAN_DELETE_SUPPLIERS,
            Rights::CAN_VIEW_TAXES,
            Rights::CAN_CREATE_TAXES,
            Rights::CAN_UPDATE_TAXES,
            Rights::CAN_DELETE_TAXES,
            Rights::CAN_VIEW_PURCHASES,
            Rights::CAN_CREATE_PURCHASES,
            Rights::CAN_UPDATE_PURCHASES,
            Rights::CAN_DELETE_PURCHASES,
        ]);
    }
}
