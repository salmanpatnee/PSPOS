<template>
    <aside class="main-sidebar" v-if="authenticated">
        <!-- sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->

            <div class="user-panel text-center">
                <div class="image">
                    <img :src="'/admin/images/user.png'" class="img-circle" alt="User Image">
                </div>

                <div class="info">
                    <p>{{ user.data.name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ user.data.role }}</a>
                    <div class="branch" v-show="user.data.location_name">({{ user.data.location_name }})</div>
                </div>

            </div>

            <!-- sidebar menu -->
            <ul class="sidebar-menu">

                <li class="treeview active">
                    <router-link to="/dashboard">
                        <i class="ti-dashboard"></i> <span>Dashboard</span>
                    </router-link>
                </li>

                <!-- customer menu part -->
                <li class="treeview" v-if="can('view-customers')">
                    <a href="javascript:void(0)">
                        <i class="metismenu-icon pe-7s-user"></i> <span>Customers</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-customers')">
                            <router-link to="/customers">
                                Manage Customers
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/customers/create" v-if="can('create-customers')">
                                Add Customer
                            </router-link>
                        </li>
                    </ul>

                </li>

                <!-- supplier menu part -->
                <li class="treeview" v-if="can('view-suppliers')">
                    <a href="javascript:void(0)">
                        <i class="metismenu-icon fa fa-user-secret"></i> <span>Suppliers</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-suppliers')">
                            <router-link to="/suppliers">
                                Manage Suppliers
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/suppliers/create" v-if="can('create-suppliers')">
                                Add Supplier
                            </router-link>
                        </li>
                    </ul>

                </li>

                <!-- product menu part -->
                <li class="treeview" v-if="can('view-products')">

                    <a href="javascript:void(0)">

                        <i class="metismenu-icon fa fa-cubes"></i> <span>Product</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-categories')">
                            <router-link to="/categories">
                                Categories
                            </router-link>
                        </li>
                        <li v-if="can('view-brands')">
                            <router-link to="/brands">
                                Brands
                            </router-link>
                        </li>
                        <li v-if="can('create-products')">
                            <router-link :to="{ name: 'products.create' }">
                                Add Product
                            </router-link>
                        </li>
                        <li v-if="can('view-products')">
                            <router-link to="/products">
                                Products
                            </router-link>
                        </li>


                    </ul>

                </li>

                <!-- purchase menu part -->
                <li class="treeview" v-if="can('view-purchases')">
                    <a href="javascript:void(0)">
                        <i class="ti-shopping-cart"></i> <span>Purchases</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('create-purchases')">
                            <router-link to="/purchases/create">
                                Add Purchase
                            </router-link>
                        </li>
                        <li v-if="can('view-purchases')">
                            <router-link to="/purchases">
                                Manage Purchases
                            </router-link>
                        </li>
                    </ul>

                </li>

                <!-- user menu part -->
                <li class="treeview" v-if="can('view-users')">

                    <a href="javascript:void(0)">

                        <i class="metismenu-icon fa fa-users"></i> <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-users')">
                            <router-link to="/users">
                                Manage Users
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/users/create" v-if="can('create-users')">
                                Add User
                            </router-link>
                        </li>
                    </ul>

                </li>

                <!-- user menu part -->
                <li class="treeview" v-if="can('view-settings')">

                    <a href="javascript:void(0)">

                        <i class="ti-settings"></i> <span>Settings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-settings')">
                            <router-link to="/settings">
                                Business
                            </router-link>
                        </li>
                        <li v-if="can('view-locations')">
                            <router-link to="/locations">
                                Location / Branches
                            </router-link>
                        </li>
                        <li v-if="can('view-taxes')">
                            <router-link to="/taxes">
                                Tax
                            </router-link>
                        </li>
                    </ul>

                </li>
            </ul>
        </div> <!-- /.sidebar -->
    </aside>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters([
            'authenticated', 'user'
        ])
    }
}
</script>