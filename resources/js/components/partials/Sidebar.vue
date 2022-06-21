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
                    <p>{{ user.name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
                </div>

            </div>

            <!-- sidebar menu -->
            <ul class="sidebar-menu">

                <li class="treeview active">
                    <router-link to="/dashboard">
                        <i class="ti-dashboard"></i> <span>Dashboard</span>
                    </router-link>
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


                        <li><a href="units.html">Units</a></li>
                        <li><a href="add_product.html">Add Product</a></li>


                        <li class="">
                            <a href="http://erp.test\/bulk_products">

                                Add Product (CSV)
                            </a>

                        </li>



                        <li class="">
                            <a href="http://erp.test\/product_list">

                                Manage Product
                            </a>

                        </li>

                        <li class="">
                            <a href="http://erp.test\/barcode_management">

                                Barcode Management

                            </a>

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
                                All Users
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/users/create" v-if="can('create-users')">
                                Add User
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
    },
    created() {
        console.log(this.can('view-users'));
    }
}
</script>