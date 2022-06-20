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

                            <router-link :to="{ name: 'users.create' }"
                                class="d-inline-block pull-right btn btn-success text-white">Add
                                User</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.role }}</td>
                                        <td>{{ user.status }}</td>
                                        <td>{{ user.last_login }}</td>
                                        <td>

                                            <router-link :to="{ name: 'users.edit', params: { user: user } }"
                                                class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                                title="" data-original-title="Update"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i></router-link>


                                            <button @click="destroy(user.id)" type="button"
                                                class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="right" title="" data-original-title="Delete "><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></button>


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
                        console.log('Error', error);

                    });
                }
            })
        },
    },

    created() {
        this.getUsers();
    }
}
</script>
