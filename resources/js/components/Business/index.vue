<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Business</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Business Settings</template>
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#business" aria-controls="business"
                                    role="tab" data-toggle="tab">Business</a></li>
                            <li role="presentation"><a href="#tax" aria-controls="tax" role="tab"
                                    data-toggle="tab">Tax</a></li>
                            <li role="presentation"><a href="#email_settings" aria-controls="email_settings" role="tab"
                                    data-toggle="tab">Email Settings</a></li>
                            <!-- <li role="presentation"><a href="#sms_settings" aria-controls="sms_settings" role="tab"
                                    data-toggle="tab">SMS Settings</a></li> -->
                        </ul>

                        <!-- Tab panes -->
                        <form class="form-vertical" @submit.prevent="update()" @keydown="form.onKeydown($event)">
                            <div class="tab-content" style="padding: 2em 1em;">
                                <div role="tabpanel" class="tab-pane  active" id="business">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-4 col-form-label">
                                                    Business Name <i class="text-danger">*</i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.name" class="form-control" id="name"
                                                        type="text" placeholder="Business Name" tabindex="1">
                                                    <HasError :form="form" field="name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="currency_id" class="col-sm-4 col-form-label">
                                                    Currency <i class="text-danger">*</i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <Select2 v-model="form.currency_id" :options="currencies"
                                                        placeholder="Select Currency" />
                                                    <HasError :form="form" field="currency_id" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-4 col-form-label">
                                                    Business Symbol Placement
                                                </label>
                                                <div class="col-sm-8">
                                                    <select v-model="form.currency_symbol_placement"
                                                        class="form-control" id="currency_symbol_placement"
                                                        tabindex="3">
                                                        <option value="before">Before Amount</option>
                                                        <option value="after">After Amount</option>
                                                    </select>
                                                    <HasError :form="form" field="currency_symbol_placement" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="logo" class="col-sm-4 col-form-label">
                                                    Logo
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control" id="logo" />
                                                    <HasError :form="form" field="currency_symbol_placement" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane " id="tax">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="tax_number" class="col-sm-4 col-form-label">
                                                    Tax Number
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.tax_number" class="form-control"
                                                        id="tax_number" type="text" placeholder="Tax Number"
                                                        tabindex="1">
                                                    <HasError :form="form" field="tax_number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="email_settings">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    Mail Driver
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="text"
                                                        placeholder="Mail Driver" tabindex="1">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    Host
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="text" placeholder="Host"
                                                        tabindex="2">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    Port
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="number" placeholder="Port"
                                                        tabindex="3">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    Username
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="text" placeholder="Username"
                                                        tabindex="1">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    Password
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="text" placeholder="Password"
                                                        tabindex="5">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    Encryption
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="number"
                                                        placeholder="Encryption" tabindex="6">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    From Email
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="email"
                                                        placeholder="From Email" tabindex="7">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">
                                                    From Name
                                                </label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="" type="text"
                                                        placeholder="From Name" tabindex="8">
                                                    <!-- <HasError :form="form" field="email_settings" /> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- <div role="tabpanel" class="tab-pane " id="sms_settings">
                                    SMS
                                </div> -->
                            </div>
                        </form>

                    </div>

                </panel>
            </div>
        </div>


    </div>
</template>

<script>
import Select2 from 'v-select2-component';

export default {

    data: () => ({
        baseEndPoint: '/api/business',
        currencies: [],
        settings: {},
        form: new Form({
            id: '',
            name: '',
            currency_id: '',
            currency_symbol_placement: '',
            tax_number: '',
            email_settings: [
                {
                    'host': ''
                },
                {
                    'driver': ''
                }

            ]
        }),
    }),
    components: {
        Select2
    },

    methods: {
        getCurrencies() {
            this.$Progress.start();
            axios.get('/api/currencies'
            ).then(({ data }) => {
                this.currencies = data.data;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
        getSettings() {
            this.$Progress.start();
            this.form.get(this.baseEndPoint
            ).then(({ data }) => {
                this.form.fill(data.data);
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },

        update() {
            this.$Progress.start();
            this.form.put(this.baseEndPoint + '/' + this.form.id).then(() => {

                Notification.success('Settings Updated');

                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
    },
    created() {
        this.getSettings();
        this.getCurrencies();
    }
}
</script>
