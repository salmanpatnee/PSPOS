<template>
    <div :class="{ loggedIn: authenticated }">
        <Header></Header>
        <Sidebar></Sidebar>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <div class="content">
                <ol class="breadcrumb" v-if="authenticated">
                    <li><a href="#"><i class="pe-7s-home"></i> Home</a></li>
                    <li><a href="#">dashboard</a></li>
                    <li class="active">Dashboard</li>
                </ol>

                <!-- load messages -->
                <div class="se-pre-con"></div>
                <!-- load custom page -->
                <router-view></router-view>

                <!-- set progressbar -->
                <vue-progress-bar></vue-progress-bar>
            </div> <!-- /.content -->
        </div> <!-- /.content-wrapper -->
        <Footer></Footer>
    </div>
</template>

<script>
import Header from './partials/Header';
import Sidebar from './partials/Sidebar';
import Footer from './partials/Footer';
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters([
            'authenticated', 'user'
        ])
    },
    components: {
        Header, Sidebar, Footer
    }
}
</script>
