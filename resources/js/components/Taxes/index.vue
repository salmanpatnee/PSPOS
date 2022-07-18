<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Taxes</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Taxes</template>

                    <template slot="header-right">
                        <button v-if="can('create-taxes')" @click="create"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Tax</button>
                    </template>
                    <template name="before-content">
                    </template>
                    <div class="table-responsive">
                        <table id="taxes_table" class="table table-bordered table-striped table-hover">
                            <table-header :columns="columns" @handleSort="sort($event)" />
                            <tbody>

                                <tr v-for="tax in taxes" :key="tax.id">
                                    <td>{{ tax.id }}</td>
                                    <td>{{ tax.name }}</td>
                                    <td>{{ tax.rate }}</td>
                                    <td>
                                        <action-button @action="edit(tax)" class='btn-sm btn-info'
                                            permission="update-taxes" label="Update">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </action-button>
                                        <delete-button @handleDelete="destroy(tax.id)" permission="delete-taxes" />

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <template name="footer">
                    </template>
                </panel>
            </div>
        </div>
        <div class="modal fade modal-success" id="tax_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-vertical" @submit.prevent="editMode ? update() : store()"
                        @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h4 class="modal-title">
                                {{ editMode ? "Update" : "Add" }} Tax
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Tax Name <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="form.name" class="form-control" id="name" type="text"
                                            placeholder="Tax Name" tabindex="1" required>
                                        <HasError :form="form" field="name" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Rate <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="form.rate" class="form-control" id="rate" type="number"
                                            placeholder="Rate" tabindex="2" required>
                                        <HasError :form="form" field="rate" />
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
        modal: "#tax_modal",
        baseEndPoint: '/api/taxes',
        taxes: {},
        columns: [
            {
                title: 'SL',
                name: ''
            },
            {
                title: 'Name',
                name: 'name',
            },
            {
                title: 'Rate',
                name: 'rate',
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
            rate: '',
        }),
    }),
    computed: {
    },

    methods: {
        getTaxes() {
            this.$Progress.start();
            this.form.get(this.baseEndPoint
            ).then(({ data }) => {
                this.taxes = data.data;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
        create() {
            this.resetModal();
        },
        store() {
            this.$Progress.start();
            this.form.post(this.baseEndPoint).then(() => {
                Fire.$emit('refreshTaxes');

                $(this.modal).modal('hide');
                Notification.success('Tax Added');
                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());

        },
        edit(tax) {
            this.resetModal(true);
            this.form.fill(tax);
        },
        update() {
            this.$Progress.start();
            this.form.put(this.baseEndPoint + '/' + this.form.id).then(() => {
                Fire.$emit('refreshTaxes');

                $(this.modal).modal('hide');
                Notification.success('Tax Updated');

                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
        destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalTaxes = this.taxes;

                    this.taxes = this.taxes.filter(tax => tax.id != id);

                    this.form.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Tax Deleted');

                        Fire.$emit('refreshTaxes');

                        this.$Progress.finish();
                    }).catch((error) => {
                        this.taxes = originalTaxes;
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
        this.getTaxes();
        Fire.$on('refreshTaxes', () => {
            this.getTaxes();
        });
    }
}
</script>
