<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li class="active">Customers</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Customers</template>
                    <template slot="header-middle">
                        <button class="btn btn-outline btn-success" @click="customersType = ''">All
                            Customers</button>
                        <button class="btn btn-outline btn-success" @click="customersType = 'credit'">Credit
                            Customers</button>
                        <button class="btn btn-outline btn-success" @click="customersType = 'paid'">Paid
                            Customers</button>
                    </template>
                    <template slot="header-right">
                        <router-link :to="{ name: 'customers.create' }" v-if="can('create-customers')"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Customer</router-link>
                    </template>
                    <template name="before-content">

                        <div class="row mb-2">
                            <div class="col-md-4 form-inline">
                                <paginate-dropdown @updatePageSize="paginate = $event" />
                            </div>
                            <div class="col-md-4 text-center">
                                <a :href="exportUrl" class="btn btn-outline btn-success"
                                    :class="{ 'disabled': !isRecordSelected }">Export to Excel</a>
                            </div>
                            <div class="col-md-4 form-inline text-right">
                                <search @updateSearchTerm="search = $event" />
                            </div>
                        </div>
                    </template>



                    <template name="before-content-additional">
                        <div class="row mt-3" v-show="isRecordSelected">
                            <div class="col-md-12">
                                <p v-if="isAllSelected" class="text-start">You are selecting all <b>{{ selectedRecords
                                }}</b>
                                    records.
                                </p>
                                <p v-else class="text-start">You have selected <b>{{ selectedRecords }}</b> record(s),
                                    Do
                                    you want to select
                                    all
                                    <b v-if="dataLoaded">{{ total }}</b> records?
                                    <a @click.prevent="selectAllRecords" href="">Select all</a>
                                </p>
                            </div>
                        </div>
                    </template>
                    <div class="table-responsive">
                        <table id="customers_table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" v-model="checkAll">
                                    </th>
                                    <th>SL.</th>
                                    <th><a href="" @click.prevent="sort('name')">Name</a>
                                        <span v-show="sortOrder == 'desc' && orderBy == 'name'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'name'">&darr;</span>
                                    </th>
                                    <th> <a href="" @click.prevent="sort('email')">Email</a>
                                        <span v-show="sortOrder == 'desc' && orderBy == 'email'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'email'">&darr;</span>
                                    </th>
                                    <th>Mobile</th>
                                    <th> <a href="" @click.prevent="sort('previous_balance')">Balance</a>
                                        <span
                                            v-show="sortOrder == 'desc' && orderBy == 'previous_balance'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'previous_balance'">&darr;</span>
                                    </th>
                                    <th> <a href="" @click.prevent="sort('total_purchases')">Total Purchases</a>
                                        <span v-show="sortOrder == 'desc' && orderBy == 'total_purchases'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'total_purchases'">&darr;</span>
                                    </th>
                                    <th> <a href="" @click.prevent="sort('last_purchase')">Last Purchase</a>
                                        <span v-show="sortOrder == 'desc' && orderBy == 'last_purchase'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'last_purchase'">&darr;</span>
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customer, index) in customers.data" :key="customer.id"
                                    :class="{ 'info': isRowSelected(customer.id) }">
                                    <td><input type="checkbox" :value="customer.id" v-model="checked"></td>
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.mobile }}</td>
                                    <td>{{ customer.previous_balance }}</td>
                                    <td>{{ customer.total_purchases }}</td>
                                    <td>{{ customer.last_purchase }}</td>
                                    <td>
                                        <edit-button routeName="customers.edit" :data="{ customer: customer }"
                                            permission="update-customers" />
                                        <delete-button @handleDelete="destroy(customer.id)"
                                            permission="delete-customers" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="customers" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="customers" @pagination-change-page="getCustomers" />
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
        baseEndPoint: '/api/customers',
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
                title: 'Total Purchases',
                name: 'total_purchases',
                sort: true
            },
            {
                title: 'Last Purchase',
                name: 'last_purchase',
                sort: true
            },
            {
                title: 'Action',
                name: '',
            }
        ],
        customers: {},
        customersType: null,
        checked: [],
        checkAll: false,
        dataLoaded: false,
        exportUrl: '',
        orderBy: 'created_at',
        paginate: 10,
        search: '',
        isAllSelected: false,
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.customers.meta.total;
        },
        selectedRecords() {
            return this.checked.length;
        },
        isRecordSelected() {
            return this.selectedRecords > 0;
        }
    },
    watch: {
        paginate: function ($value) {
            this.getCustomers();
        },
        search: function ($value) {
            this.getCustomers();
        },
        customersType: function ($value) {
            this.getCustomers();
        },
        checkAll: function ($value) {
            this.checked = [];
            this.isAllSelected = false;

            if ($value) {
                this.customers.data.map(customers => this.checked.push(customers.id));
                this.checkAll = true;
            }
        },
        checked: function ($value) {
            this.exportUrl = this.baseEndPoint + "/export/" + this.checked;
        }
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    methods: {
        getCustomers(page = 1) {
            this.$Progress.start();
            axios.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&customersType=' + this.customersType
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.customers = data;
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
            this.getCustomers();
        },
        isRowSelected(id) {
            return this.checked.includes(id);
        },
        selectAllRecords() {
            axios.get(this.baseEndPoint + '/selectAll').then(response => {
                this.checked = response.data;
                this.isAllSelected = true;
            }).catch(error => {
                console.log('Error: ' + error);
            });
        },
        async destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalCustomers = this.customers.data;

                    this.customers.data = this.customers.data.filter(customer => customer.id != id);
                    axios.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Customer Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.customers.data = originalCustomers;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
    },

    created() {
        this.getCustomers();
    }
}
</script>
