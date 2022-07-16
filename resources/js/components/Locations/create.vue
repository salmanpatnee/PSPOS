<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'locations.index' }">All Locations</router-link>
            </li>
            <li class="active">{{ editMode ? 'Edit' : 'Add' }} Location</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Add Location </h4>

                            <router-link :to="{ name: 'locations.index' }" v-if="can('view-locations')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                Locations</router-link>
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
                                        <label for="email" class="col-sm-4 col-form-label text-d">Location ID </label>
                                        <div class="col-sm-8">
                                            <input v-model="form.location_id" class="form-control" type="text"
                                                placeholder="Location ID" id="location_id">
                                            <HasError :form="form" field="location_id" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="landmark" class="col-sm-4 col-form-label text-d">Landmark</label>
                                        <div class="col-sm-8">
                                            <input v-model="form.landmark" class="form-control" type="text"
                                                placeholder="Landmark" id="landmark">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label for="city" class="col-sm-4 col-form-label text-d">City</label>
                                        <div class="col-sm-8">
                                            <input v-model="form.city" class="form-control" type="text"
                                                placeholder="City" id="city">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-4 col-form-label text-d">Mobile <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <masked-input v-model="form.mobile" class="form-control"
                                                mask="(03)11-1111111" placeholder="Mobile" id="mobile">
                                            </masked-input>
                                            <HasError :form="form" field="mobile" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row" v-show="!this.form.id">
                                        <label for="email" class="col-sm-4 col-form-label text-d">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.email" class="form-control" type="email"
                                                placeholder="Email" id="email" required>
                                            <HasError :form="form" field="email" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-4 col-form-label text-d">Status</label>
                                        <div class="col-sm-8">
                                            <select v-model="form.status" class="form-control" id="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                        <Button v-if="can('create-locations')" :form="form"
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
        endPoint: '/api/locations',
        editMode: false,
        form: new Form({
            id: '',
            name: '',
            location_id: '',
            landmark: '',
            city: '',
            mobile: '',
            email: '',
            status: 'Active',
        })
    }),
    components: {
        maskedInput
    },
    methods: {
        store() {
            this.$Progress.start();
            this.form.post(this.endPoint).then(() => {
                Notification.success('Location Added');
                this.$Progress.finish();
                this.$router.push({ name: 'locations.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });

        },
        update() {
            this.form.put(this.endPoint + '/' + this.form.id).then(() => {
                Notification.success('Location Updated');
                this.$router.push({ name: 'locations.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });
        }
    },
    created() {
        if (this.$route.params.location) {
            this.form.fill(this.$route.params.location);
            this.editMode = true;
        }
    }
}
</script>
