<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Customers</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Manage Customers </h4>

                            <router-link :to="{ name: 'customers.create' }" v-if="can('create-customers')"
                                class="d-inline-block pull-right btn btn-success text-white">Add
                                Customer</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="customersTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Mobile</th>
                                        <th>Balance</th>
                                        <th>Total Purchases</th>
                                        <th>Last Purchase</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="customer in customers" :key="customer.id">
                                        <td>{{ customer.name }}</td>
                                        <td>{{ customer.email }}</td>
                                        <td>{{ customer.phone }}</td>
                                        <td>{{ customer.mobile }}</td>
                                        <td>{{ customer.balance }}</td>
                                        <td>{{ customer.total_purchases }}</td>
                                        <td>{{ customer.last_purchase }}</td>
                                        <td>

                                            <router-link
                                                :to="{ name: 'customers.edit', params: { customer: customer } }"
                                                v-if="can('update-customers')" class="btn btn-info btn-sm"
                                                data-toggle="tooltip" data-placement="left" title=""
                                                data-original-title="Update"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i></router-link>


                                            <button @click="destroy(customer.id)" type="button"
                                                v-if="can('delete-customers')" class="btn btn-danger btn-sm"
                                                data-toggle="tooltip" data-placement="right" title=""
                                                data-original-title="Delete "><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></button>


                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {

    data: () => ({
        customers: {},
    }),
    methods: {
        getCustomers() {
            axios.get('/api/customers').then(({ data }) => (this.customers = data.data));
        },
        async destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                this.$Progress.start();
                if (result.isConfirmed) {
                    const originalCustomers = this.customers;

                    this.customers = this.customers.filter(user => user.id != id);
                    axios.delete('/api/customers/' + id).then(() => {

                        Notification.success('Customer Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.customers = originalCustomers;
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
