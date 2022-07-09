<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Locations</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Locations</template>

                    <template slot="header-right">
                        <router-link :to="{ name: 'locations.create' }" v-if="can('create-locations')"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Location</router-link>
                    </template>
                    <template name="before-content">

                        <div class="row mb-2">
                            <div class="col-md-4 form-inline">
                                <paginate-dropdown @updatePageSize="paginate = $event" />
                            </div>
                            <div class="col-md-4 text-center">

                            </div>
                            <div class="col-md-4 form-inline text-right">
                                <search @updateSearchTerm="search = $event" />
                            </div>
                        </div>
                    </template>

                    <div class="table-responsive">
                        <table id="locations_table" class="table table-bordered table-striped table-hover">
                            <table-header :columns="columns" :sortOrder="sortOrder" :orderBy="orderBy"
                                @handleSort="sort($event)" />
                            <tbody>

                                <tr v-for="(location, index) in locations.data" :key="location.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ location.name }}</td>
                                    <td>{{ location.location_id }}</td>
                                    <td>{{ location.city }}</td>
                                    <td>{{ location.mobile }}</td>
                                    <td>{{ location.email }}</td>
                                    <td>{{ location.status }}</td>
                                    <td>
                                        <edit-button routeName="locations.edit" :data="{ location: location }"
                                            permission="update-locations" />

                                        <delete-button @handleDelete="destroy(location.id)"
                                            permission="delete-locations" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="locations" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="locations" @pagination-change-page="getLocations" />
                            </div>
                        </div>
                    </template>
                </panel>
            </div>
        </div>
    </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';

export default {

    data: () => ({
        baseEndPoint: '/api/locations',
        columns: [
            {
                title: 'SL',
                name: ''
            },
            {
                title: 'Name',
                name: 'name',
                sort: true
            },
            {
                title: 'ID',
                name: 'location_id',
                sort: true
            },
            {
                title: 'City',
                name: 'city',
                sort: true
            },
            {
                title: 'Mobile',
                name: 'mobile',
            },
            {
                title: 'Email',
                name: 'email',
            },
            {
                title: 'Status',
                name: 'status'
            },
            {
                title: 'Action',
                name: '',
            }
        ],
        locations: {},
        orderBy: 'created_at',
        paginate: 10,
        search: '',
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.locations.meta.total;
        },
    },
    watch: {
        paginate: function ($value) {
            this.getLocations();
        },
        search: function ($value) {
            this.getLocations();
        },
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    methods: {
        getLocations(page = 1) {
            this.$Progress.start();
            axios.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.locations = data;
                this.dataLoaded = true;
                this.$Progress.finish();
            }).catch(error => {
                this.dataLoaded = false;
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
        sort(col) {
            this.orderBy = col;
            this.sortOrder = this.sortOrder == 'desc' ? 'asc' : 'desc';
            this.getLocations();
        },
        async destroy(id) {
            console.log(id);
            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalLocations = this.locations.data;

                    this.locations.data = this.locations.data.filter(location => location.id != id);
                    axios.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Location Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.locations.data = originalLocations;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
    },

    created() {
        this.getLocations();
    }
}
</script>
