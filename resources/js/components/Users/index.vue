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
                        <div class="row mb-2">
                            <div class="col-md-4 form-inline">
                                <div class="form-group">
                                    <label for="paginate">Show: </label>
                                    <select v-model="paginate" name="paginate" id="paginate" class="form-control">
                                        <option v-for="perPage in paginateLengthMenu" :key="perPage" :value="perPage">{{
                                                perPage
                                        }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 form-inline text-right">
                                <div class="form-group">
                                    <label for="search">Search: </label>
                                    <input v-model.trim.lazy="search" type="search" name="search" id="search"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>
                                            <a href="" @click.prevent="sort('name')">Name</a>
                                            <span v-show="sortOrder == 'desc' && orderBy == 'name'">&uarr;</span>
                                            <span v-show="sortOrder == 'asc' && orderBy == 'name'">&darr;</span>
                                        </th>
                                        <th>
                                            <a href="" @click.prevent="sort('email')">Email</a>
                                            <span v-show="sortOrder == 'desc' && orderBy == 'email'">&uarr;</span>
                                            <span v-show="sortOrder == 'asc' && orderBy == 'email'">&darr;</span>
                                        </th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>
                                            <a href="" @click.prevent="sort('created_at')">Joining Date</a>
                                            <span v-show="sortOrder == 'desc' && orderBy == 'created_at'">&uarr;</span>
                                            <span v-show="sortOrder == 'asc' && orderBy == 'created_at'">&darr;</span>
                                        </th>
                                        <th>Last Login</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users.data" :key="user.id">
                                        <td>{{ index + 1 }}</td>
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p v-if="dataLoaded" class="text-start">Showing {{ page }} to {{ users.meta.last_page }}
                                    of {{ total }} record(s)</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="users" @pagination-change-page="getUsers" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import EditButton from '../partials/EditButton';
import LaravelVuePagination from 'laravel-vue-pagination';

export default {

    data: () => ({
        baseEndPoint: '/api/users',
        users: {},
        dataLoaded: false,
        orderBy: 'created_at',
        page: 1,
        paginateLengthMenu: [10, 25, 50, 100, 250, 500],
        paginate: 10,
        search: '',
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.users.meta.total;
        }
    },
    watch: {
        paginate: function ($value) {
            this.getUsers();
        },
        search: function ($value) {
            this.getUsers();
        },
    },
    components: {
        'Edit': EditButton,
        'Pagination': LaravelVuePagination
    },
    methods: {
        getUsers(page = 1) {
            this.$Progress.start();
            this.page = page;
            axios.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.users = data;
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
            this.getUsers();
        },
        async destroy(id) {
            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                this.$Progress.start();
                if (result.isConfirmed) {
                    const originalUsers = this.users.data;

                    this.users.data = this.users.data.filter(user => user.id != id);
                    axios.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('User Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.users.data = originalUsers;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
    },
    mounted() {
        this.getUsers();
    }
}
</script>
