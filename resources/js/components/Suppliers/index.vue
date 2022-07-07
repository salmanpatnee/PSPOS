<template>
    <div>
        <breadcrumb></breadcrumb>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Suppliers</template>

                    <template slot="header-right">
                        <router-link :to="{ name: 'suppliers.create' }" v-if="can('create-suppliers')"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Supplier</router-link>
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
                        <table id="suppliers_table" class="table table-bordered table-striped table-hover">
                            <table-header :columns="columns" :sortOrder="sortOrder" :orderBy="orderBy"
                                @handleSort="sort($event)" />
                            <tbody>

                                <tr v-for="(supplier, index) in suppliers.data" :key="supplier.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ supplier.name }}</td>
                                    <td>{{ supplier.email }}</td>
                                    <td>{{ supplier.mobile }}</td>
                                    <td>{{ supplier.previous_balance }}</td>
                                    <td>{{ supplier.advance_balance }}</td>
                                    <td>
                                        <edit-button routeName="suppliers.edit" :data="{ supplier: supplier }"
                                            permission="update-suppliers" />

                                        <delete-button @handleDelete="destroy(supplier.id)"
                                            permission="delete-suppliers" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="suppliers" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="suppliers" @pagination-change-page="getSuppliers" />
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
        baseEndPoint: '/api/suppliers',
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
                title: 'Email',
                name: 'email',
                sort: true
            },
            {
                title: 'Mobile',
                name: 'mobile',
            },
            {
                title: 'Balance',
                name: 'previous_balance',
                sort: true
            },
            {
                title: 'Advance Balance',
                name: 'advance_balance',
                sort: true
            },
            {
                title: 'Action',
                name: '',
            }
        ],
        suppliers: {},
        dataLoaded: false,
        exportUrl: '',
        orderBy: 'created_at',
        paginate: 10,
        search: '',
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.suppliers.meta.total;
        },
    },
    watch: {
        paginate: function ($value) {
            this.getSuppliers();
        },
        search: function ($value) {
            this.getSuppliers();
        },
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    methods: {
        getSuppliers(page = 1) {
            this.$Progress.start();
            axios.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.suppliers = data;
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
            this.getSuppliers();
        },
        async destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalSuppliers = this.suppliers.data;

                    this.suppliers.data = this.suppliers.data.filter(supplier => supplier.id != id);
                    axios.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Supplier Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.suppliers.data = originalSuppliers;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
    },

    created() {
        this.getSuppliers();
    }
}
</script>
