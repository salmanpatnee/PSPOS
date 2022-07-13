<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Brands</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Brands</template>

                    <template slot="header-right">
                        <button v-if="can('create-brands')" @click="create"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Brand</button>
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
                        <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                            <table-header :columns="columns" :sortOrder="sortOrder" :orderBy="orderBy"
                                @handleSort="sort($event)" />
                            <tbody>

                                <tr v-for="brand in brands.data" :key="brand.id">
                                    <td>{{ brand.id }}</td>
                                    <td>{{ brand.name }}</td>
                                    <td>
                                        <action-button @action="edit(brand)" class='btn-sm btn-info'
                                            permission="update-brands" label="Update">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </action-button>

                                        <delete-button @handleDelete="destroy(brand.id)" permission="delete-brands" />


                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="brands" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="brands" @pagination-change-page="getBrands" />
                            </div>
                        </div>
                    </template>
                </panel>
            </div>
        </div>
        <div class="modal fade modal-success" id="brand_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-vertical" @submit.prevent="editMode ? update() : store()"
                        @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h4 class="modal-title">
                                {{ editMode ? "Update" : "Add" }} Brand
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div id="customeMessage" class="alert hide"></div>
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Brand Name <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="form.name" class="form-control" name="name" id="name"
                                            type="text" placeholder="Brand Name" tabindex="1">
                                        <HasError :form="form" field="name" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" tabindex="5" data-dismiss="modal">Close</a>
                            <button type="submit" tabindex="6" class="btn btn-success" :disabled="form.busy">
                                {{ editMode ? "Update" : "Save" }}
                            </button>
                        </div>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';
export default {

    data: () => ({
        modal: "#brand_modal",
        baseEndPoint: '/api/brands',
        brands: {},
        columns: [
            {
                title: 'SL',
                name: ''
            },
            {
                title: 'Brand Name',
                name: 'name',
                sort: true
            },
            {
                title: 'Action',
                name: '',
            }
        ],
        dataLoaded: false,
        editMode: false,
        form: new Form({
            id: '',
            name: '',
        }),
        orderBy: 'created_at',
        paginate: 10,
        search: '',
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.brands.meta.total;
        }
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    watch: {
        paginate: function ($value) {
            this.getBrands();
        },
        search: function ($value) {
            this.getBrands();
        },
    },
    methods: {
        getBrands(page = 1) {
            this.$Progress.start();
            this.form.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.brands = data;
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
            this.getBrands();
        },
        create() {
            this.resetModal();
        },
        store() {
            this.$Progress.start();
            this.form.post(this.baseEndPoint).then(() => {
                Fire.$emit('refreshBrands');

                $(this.modal).modal('hide');
                Notification.success('Brand Added');
                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());

        },
        edit(brand) {
            this.resetModal(true);
            this.form.fill(brand);
        },
        update() {
            this.$Progress.start();
            this.form.put(this.baseEndPoint + '/' + this.form.id).then(() => {
                Fire.$emit('refreshBrands');

                $(this.modal).modal('hide');
                Notification.success('Brand Updated');

                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
        destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const refreshBrands = this.brands.data;

                    this.brands.data = this.brands.data.filter(brand => brand.id != id);

                    this.form.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Brand Deleted');

                        Fire.$emit('refreshBrands');

                        this.$Progress.finish();
                    }).catch((error) => {
                        this.brands.data = refreshBrands;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                        console.log('Error', error);
                    });
                }
            })
        },
        resetModal(mode = false) {
            this.editMode = mode;
            this.form.reset();
            $(this.modal).modal('show');
        },
    },
    created() {
        this.getBrands();
        Fire.$on('refreshBrands', () => {
            this.getBrands();
        });
    }
}
</script>
