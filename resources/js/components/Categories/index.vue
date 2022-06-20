<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Categories</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Manage Categories </h4>
                            <button @click="create" class="d-inline-block pull-right btn btn-success text-white">Add
                                Category</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Category Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="category in categories" :key="category.id">
                                        <td>{{ category.id }}</td>
                                        <td>{{ category.name }}</td>
                                        <td>
                                            <center>

                                                <button @click="edit(category)" class="btn btn-info btn-sm"
                                                    data-toggle="tooltip" data-placement="left" title=""
                                                    data-original-title="Update">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </button>

                                                <button @click="deleteCategory(category.id)" type="button"
                                                    class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                    data-placement="right" title="" data-original-title="Delete "><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>

                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-success" id="category_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-vertical" @submit.prevent="editMode ? update() : store()"
                        @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h4 class="modal-title">
                                {{ editMode ? "Update" : "Add" }} Category
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div id="customeMessage" class="alert hide"></div>
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Category Name <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="form.name" class="form-control" name="name" id="name"
                                            type="text" placeholder="Category Name" tabindex="1" required>
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
export default {

    data: () => ({
        modal: "#category_modal",
        endPoint: '/api/categories/',
        categories: {},
        editMode: false,
        form: new Form({
            id: '',
            name: '',
        })
    }),
    methods: {
        getCategories() {
            this.form.get(this.endPoint).then(({ data }) => (this.categories = data.data));
        },
        create() {
            this.resetModal();
        },
        store() {
            this.$Progress.start();
            this.form.post(this.endPoint).then(() => {
                Fire.$emit('refreshCategories');

                $(this.modal).modal('hide');
                Notification.success('Category Added');
                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());

        },
        edit(category) {
            this.resetModal(true);
            this.form.fill(category);
        },
        update() {
            this.$Progress.start();
            this.form.put(this.endPoint + this.form.id).then(() => {
                Fire.$emit('refreshCategories');

                $(this.modal).modal('hide');
                Notification.success('Category Updated');

                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
        deleteCategory(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalCategories = this.categories;

                    this.categories = this.categories.filter(category => category.id != id);

                    this.form.delete(this.endPoint + id).then(() => {

                        Notification.success('Category Deleted');

                        Fire.$emit('refreshCategories');

                        this.$Progress.finish();
                    }).catch((error) => {
                        this.categories = originalCategories;
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
        this.getCategories();
        Fire.$on('refreshCategories', () => {
            this.getCategories();
        });
    }
}
</script>
