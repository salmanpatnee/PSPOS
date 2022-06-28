<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Users</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Manage Users </h4>

                            <router-link :to="{ name: 'users.create' }" v-if="can('create-users')"
                                class="d-inline-block pull-right btn btn-success text-white">Add
                                User</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joining Date</th>
                                        <th>Last Login</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr v-for="user in users" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.role }}</td>
                                        <td>{{ user.status }}</td>
                                        <td>{{ user.joining_date }}</td>
                                        <td>{{ user.last_login }}</td>
                                        <td>

                                            <router-link :to="{ name: 'users.edit', params: { user: user } }"
                                                v-if="can('update-users')" class="btn btn-info btn-sm"
                                                data-toggle="tooltip" data-placement="left" title=""
                                                data-original-title="Update"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i></router-link>


                                            <button @click="destroy(user.id)" type="button"
                                                v-if="can('delete-users') && user.id !== 1"
                                                class=" btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="right" title="" data-original-title="Delete "><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></button>


                                        </td>
                                    </tr> -->
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

import 'datatables.net';

let myVm = null;

export default {

    data: () => ({
        users: {},
    }),
    methods: {
        getUsers() {
            axios.get('/api/users').then(({ data }) => (this.users = data.data));
        },
        async destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                this.$Progress.start();
                if (result.isConfirmed) {
                    const originalUsers = this.users;

                    this.users = this.users.filter(user => user.id != id);
                    axios.delete('/api/users/' + id).then(() => {

                        Notification.success('User Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.users = originalUsers;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
    },
    created() {
        myVm = this;
    },
    mounted() {
        // this.getUsers();

        // Initialize DataTable Plugin.

        $(document).on('click', 'button.edit-btn', function () {
            const user = $(this).data('user')
            myVm.$router.push({ name: 'users.edit', params: { user: user } })
        });
        $(document).on('click', 'button.delete-btn', function () {
            const userId = $(this).data('userid');

            myVm.destroy(userId);
        });


        // $(document).on('click', 'button.edit-btn', function (e) {

        //     console.log($(this).data('user'));

        //     // const user = $(this).data('user')
        //     // $vm.$router.push({ name: 'users.edit', params: { user: user } })
        // });

        $("#usersTable").DataTable({
            'processing': true,
            'serveSide': true,
            'ajax': '/api/users',
            "pageLength": 100,
            'columns': [
                { 'data': 'id' },
                { 'data': 'name' },
                { 'data': 'email' },
                { 'data': 'role' },
                { 'data': 'status' },
                { 'data': 'joining_date' },
                { 'data': 'last_login' },
                { 'data': 'action' },
            ]
        });

    }
}
</script>
