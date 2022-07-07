<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'suppliers.index' }">All Suppliers</router-link>
            </li>
            <li class="active">{{ editMode ? 'Edit' : 'Add' }} Supplier</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Add Supplier </h4>

                            <router-link :to="{ name: 'suppliers.index' }" v-if="can('view-suppliers')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                Suppliers</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-d">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.name" class="form-control" type="text"
                                                placeholder="Name" id="name" required>
                                            <HasError :form="form" field="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-d">Email</label>
                                        <div class="col-sm-8">
                                            <input v-model="form.email" class="form-control" type="email"
                                                placeholder="Email" id="email">
                                            <HasError :form="form" field="email" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-4 col-form-label text-d">Phone</label>
                                        <div class="col-sm-8">
                                            <masked-input v-model="form.phone" class="form-control"
                                                mask="(02\1-3) 1111111" placeholder="Phone" id="phone">
                                            </masked-input>
                                            <HasError :form="form" field="phone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-4 col-form-label text-d">Mobile <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <masked-input v-model="form.mobile" class="form-control"
                                                mask="(03)11-1111111" placeholder="Mobile" id="mobile" required>
                                            </masked-input>
                                            <HasError :form="form" field="mobile" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-4 col-form-label text-d">Address</label>
                                        <div class="col-sm-8">
                                            <textarea v-model="form.address" name="address" class="form-control"
                                                type="text" placeholder="Address" id="address"></textarea>
                                            <HasError :form="form" field="address" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row" v-show="!this.form.id">
                                        <label for="previous_balance" class="col-sm-4 col-form-label text-d">Previous
                                            Balance</label>
                                        <div class="col-sm-8">
                                            <input v-model="form.previous_balance" name="previous_balance"
                                                class="form-control" type="number" placeholder="Previous Balance"
                                                id="previous_balance">
                                            <HasError :form="form" field="previous_balance" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row" v-show="!this.form.id">
                                        <label for="advance_balance" class="col-sm-4 col-form-label text-d">Advance
                                            Balance</label>
                                        <div class="col-sm-8">
                                            <input v-model="form.advance_balance" name="advance_balance"
                                                class="form-control" type="number" placeholder="Previous Balance"
                                                id="advance_balance">
                                            <HasError :form="form" field="advance_balance" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                        <Button v-if="can('create-suppliers')" :form="form"
                                            class="btn btn-success w-md m-b-5">{{
                                                    editMode ? "Update" : "Add"
                                            }}
                                        </Button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import maskedInput from 'vue-masked-input';

export default {

    data: () => ({
        endPoint: '/api/suppliers',
        editMode: false,
        form: new Form({
            id: '',
            name: '',
            email: '',
            phone: '',
            mobile: '',
            address: '',
            previous_balance: '',
            advance_balance: '',
        })
    }),
    components: {
        maskedInput
    },
    methods: {
        store() {
            this.$Progress.start();
            this.form.post(this.endPoint).then(() => {
                Notification.success('Supplier Added');
                this.$Progress.finish();
                this.$router.push({ name: 'suppliers.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });

        },
        update() {
            this.form.put(this.endPoint + '/' + this.form.id).then(() => {
                Notification.success('Supplier Updated');
                this.$router.push({ name: 'suppliers.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });
        }
    },
    created() {
        if (this.$route.params.supplier) {
            this.form.fill(this.$route.params.supplier);
            this.editMode = true;
        }
    }
}
</script>
