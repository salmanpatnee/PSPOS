<template>
    <header class="main-header" v-if="authenticated">

        <!-- <div class="se-pre-con"></div> -->
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <!-- Sidebar toggle button-->
                <span class="sr-only">Toggle navigation</span>
                <span class="pe-7s-keypad"></span>
            </a>
            <span class="top-fixed-link">
                <a href="" class="btn btn-success btn-outline"><i class="fa fa-balance-scale"></i> Sale</a>


                <a href="" class="btn btn-success btn-outline"><i class="fa fa-money"></i> Customer Receive</a>

                <a href="" class="btn btn-success btn-outline"><i class="fa fa-money" aria-hidden="true"></i>
                    Supplier
                    Payment</a>

                <a href="" class="btn btn-success btn-outline"><i class="ti-shopping-cart"></i> Purchase</a>
            </span>
            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <!-- settings -->
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href=""><i class="pe-7s-users"></i> Edit Profile</a>
                            </li>
                            <li><a href=""><i class="pe-7s-settings"></i>Change
                                    Password</a></li>
                            <li>
                                <a href="" @click.prevent="handleLogout">
                                    <i class="pe-7s-key"></i> Logout</a>

                            </li>

                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters([
            'authenticated', 'user'
        ])
    },
    methods: {
        async handleLogout() {

            await this.$store.dispatch('logout');
            this.$router.push({ name: 'login' });
            Toast.fire({
                icon: 'success',
                title: 'Logged out successfully'
            });
        }
    }
}
</script>