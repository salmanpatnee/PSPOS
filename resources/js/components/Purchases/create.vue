<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'purchases.index' }">All Purchases</router-link>
            </li>
            <li class="active">Add Purchase</li>
        </ol>

        <form @submit.prevent="store()" @keydown="form.onKeydown($event)">
            <div class="row">
                <div class="col-sm-12">

                    <!-- Purchase Details -->
                    <panel>
                        <template slot="title">Add Purchase</template>

                        <template slot="header-right">
                            <router-link :to="{ name: 'purchases.index' }" v-if="can('view-purchases')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                Purchases</router-link>
                        </template>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="supplier_id" class="col-sm-4 col-form-label text-d">Supplier <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <v-select id="supplier_id" @search="fetchSuppliers" @input="selectSupplier"
                                            label="name" :options="suppliers">
                                            <template slot="no-options">
                                                Type to search Suppliers.
                                            </template>
                                        </v-select>
                                        <HasError :form="form" field="supplier_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="reference_no" class="col-sm-4 col-form-label text-d">Reference No <span
                                            class="text-info" data-toggle="tooltip" data-placement="top"
                                            title="Leave empty to autogenerate."><i class="fa fa-info-circle"
                                                aria-hidden="true"></i></span></label>
                                    <div class="col-sm-8">
                                        <input v-model="form.reference_no" class="form-control" type="text"
                                            placeholder="Reference No" id="reference_no">
                                        <HasError :form="form" field="reference_no" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="transaction_date" class="col-sm-4 col-form-label text-d">Purchase
                                        Date <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <datepicker wrapper-class="form-control" :calendar-button="true"
                                            placeholder="Select Date" calendar-button-icon="fa fa-calendar"
                                            v-model="form.transaction_date">
                                        </datepicker>
                                        <HasError :form="form" field="transaction_date" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="status" class="col-sm-4 col-form-label text-d">Purchase
                                        Status <span class="text-danger">*</span> <span class="text-info"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Products in the purchase will be available for sale only if the Order status is items Received."><i
                                                class="fa fa-info-circle" aria-hidden="true"></i></span></label>
                                    <div class="col-sm-8">
                                        <select v-model="form.status" id="status" class="form-control">
                                            <option value="received">Received</option>
                                            <option value="pending">Pending</option>
                                            <option value="ordered">Ordered</option>
                                        </select>
                                        <HasError :form="form" field="status" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class=" form-group row">
                                    <label for="location_id" class="col-sm-4 col-form-label text-d">Location/Branch
                                        <span class="text-danger">*</span> <span class="text-info" data-toggle="tooltip"
                                            data-placement="top"
                                            title="Location/Branch where the purchased product will be available for sale."><i
                                                class="fa fa-info-circle" aria-hidden="true"></i></span></label>
                                    <div class="col-sm-8">
                                        <select v-model="form.location_id" id="location_id" class="form-control">
                                            <option value="" selected>Select Location</option>
                                            <option v-for="location in locations" :value="location.id">{{ location.name
                                            }}
                                            </option>
                                        </select>
                                        <HasError :form="form" field="location_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </panel>

                    <!-- Products -->
                    <panel>
                        <template slot="title">Select Products</template>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"
                                            aria-hidden="true"></i></span>
                                    <v-select v-model="productSearch" ref="productSearch"
                                        placeholder="Enter Product Name / Code" @option:selected="productSelected"
                                        id="product_search" @search="fetchProducts" @input="selectProduct" label="name"
                                        :options="products">
                                        <template slot="no-options">
                                            Type to search Products.
                                        </template>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="m-t-20 table table-bordered table-striped text-center"
                                        id="product-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Cost (Before Dis)</th>
                                                <th>Dis %</th>
                                                <th>Cost (Before Tax)</th>
                                                <th>Tax %</th>
                                                <th>Total</th>
                                                <th>Price</th>
                                                <th>Profit %</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(product, index) in form.selected_products" :key="product.id">
                                                <td>
                                                    {{ product.name }}
                                                    <br>
                                                    <small class="text-muted"> Current stock: 0</small>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" placeholder="1">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" placeholder="1">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" placeholder="0">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" placeholder="1">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" placeholder="0">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" placeholder="0">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <a @click.prevent="removeProduct(index)" href="#">
                                                        <i class="fa fa-trash color-red" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>

                        <template name="footer">
                            <div class="pull-right col-md-3 col-xs-12 mt-2">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Total Items:</th>
                                            <td>{{ totalItemsDisplay }}</td>
                                        </tr>
                                        <!-- <tr v-show="form.total_before_tax">
                                            <th>Total Before Tax:</th>
                                            <td>{{ form.total_before_tax }}</td>
                                        </tr> -->
                                        <tr>
                                            <th>Total Amount:</th>
                                            <td>{{ getFormattedPrice(netTotalDisplay) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </panel>

                    <!-- Discount & Tax -->
                    <panel>
                        <template slot="title">Discount / Tax</template>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="discount_type" class="col-sm-5 col-form-label text-d">Discount
                                        Type</label>
                                    <div class="col-sm-7">
                                        <select v-model="form.discount_type" id="discount_type" class="form-control">
                                            <option value="" selected>None</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percentage">Percentage</option>
                                        </select>
                                        <HasError :form="form" field="discount_type" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="discount_rate" class="col-sm-5 col-form-label text-d">Discount
                                        Rate</label>
                                    <div class="col-sm-7">
                                        <input v-model.number="discountRate" class="form-control" type="number"
                                            placeholder="0" id="discount_rate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="discount_amount"
                                        class="col-sm-12 col-form-label text-d text-right">Discount:(-)
                                        <span>{{ getFormattedPrice(totalDiscountDisplay) }}</span> </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="tax_id" class="col-sm-5 col-form-label text-d">Purchase Tax</label>
                                    <div class="col-sm-7">
                                        <select v-model="form.tax_id" id="tax_id" class="form-control">
                                            <option value="" selected>None</option>
                                            <option v-for="tax in taxes" :value="tax.id">{{ tax.name }}</option>
                                        </select>
                                        <HasError :form="form" field="tax_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-form-label text-d text-right">Purchase Tax:(+)
                                        <span>{{ getFormattedPrice(taxAmountDisplay) }}</span> </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="additional_notes" class="col-sm-12 col-form-label text-d">Additional
                                        Notes</label>
                                    <div class="col-sm-12 mt-1">
                                        <textarea v-model="form.additional_notes" id="additional_notes"
                                            class="form-control" placeholder="Additional Notes" />
                                        <HasError :form="form" field="additional_notes" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </panel>

                    <!-- Shipping -->
                    <panel>
                        <template slot="title">Shipping</template>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="shipping_details" class="col-sm-5 col-form-label text-d">Shipping
                                        Details</label>
                                    <div class="col-sm-7">
                                        <input v-model="form.shipping_details" class="form-control" type="text"
                                            placeholder="Shipping Details" id="shipping_details">
                                        <HasError :form="form" field="shipping_details" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="shipping_charges" class="col-sm-5 col-form-label text-d">Shipping
                                        Charges</label>
                                    <div class="col-sm-7">
                                        <input v-model.number="form.shipping_charges" class="form-control" type="number"
                                            placeholder="0" id="shipping_charges">
                                        <HasError :form="form" field="shipping_charges" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <template name="footer">
                            <div class="pull-right col-md-3 col-xs-12 mt-2">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Total Purchase Amount:</th>
                                            <td>{{ getFormattedPrice(purchaseAmountDisplay) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </panel>

                    <!-- Payment -->
                    <panel>
                        <template slot="title">Payment</template>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="amount" class="col-sm-4 col-form-label text-d">Amount <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input v-model="form.amount" class="form-control" type="text"
                                            placeholder="Amount" id="amount">
                                        <HasError :form="form" field="amount" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="paid_on" class="col-sm-4 col-form-label text-d">Paid On <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <datepicker wrapper-class="form-control" :calendar-button="true"
                                            placeholder="Select Date" calendar-button-icon="fa fa-calendar"
                                            v-model="form.paid_on">
                                        </datepicker>
                                        <HasError :form="form" field="paid_on" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="payment_method" class="col-sm-4 col-form-label text-d">Payment Method
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select v-model="form.payment_method" id="payment_method" class="form-control">
                                            <option value="" selected>Cash</option>
                                            <option value="">Card</option>
                                            <option value="">Cheque</option>
                                            <option value="">Bank Transfer</option>
                                            <option value="">Other</option>
                                        </select>
                                        <HasError :form="form" field="payment_method" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="payment_note" class="col-sm-4 col-form-label text-d">Payment Note
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 mt-1">
                                        <textarea v-model="form.payment_note" id="payment_note" class="form-control"
                                            placeholder="Payment Note" />
                                        <HasError :form="form" field="payment_note" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <template name="footer">
                            <div class="pull-right col-md-3 col-xs-12 mt-2">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Payment Due:</th>
                                            <td>{{ getFormattedPrice(form.due_amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <Button v-if="can('create-purchases')" :form="form"
                                                    class="btn btn-success w-md m-b-5 mt-2">Add</Button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </panel>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import "vue-select/dist/vue-select.css";
import Datepicker from 'vuejs-datepicker';
import { _ } from 'vue-underscore';

export default {

    data: () => ({
        endPoint: '/api/purchases',
        suppliers: [],
        products: [],
        locations: {},
        taxes: {},
        totalItems: 5.00,
        netTotal: 150,
        discountRate: null,
        productSearch: null,
        form: new Form({
            supplier_id: '',
            location_id: '',
            reference_no: '',
            status: 'received',

            discount_type: '',
            discount_amount: 0.00,
            tax_id: '',
            tax_amount: 0.00,

            shipping_details: '',
            shipping_charges: null,

            payment_method: '',
            transaction_date: new Date(),
            paid_on: new Date(),
            payment_note: '',

            additional_notes: '',
            total_before_tax: 0.00,
            final_total: 0.00,
            due_amount: 0.00,

            selected_products: []
        })
    }),
    computed: {
        totalItemsDisplay() {
            return this.form.selected_products.length.toFixed(2);
        },
        netTotalDisplay() {
            return this.netTotal.toFixed(2);
        },
        totalDiscountDisplay() {
            return this.form.discount_amount.toFixed(2);
        },
        // totalBeforeTaxDisplay(){
        //     return this.form.total_before_tax.toFixed(2);
        // },
        taxAmountDisplay() {
            return this.form.tax_amount.toFixed(2);
        },
        purchaseAmountDisplay() {
            return this.form.netTotal = this.form.final_total = this.form.due_amount
                = ((this.netTotal + this.form.tax_amount + this.form.shipping_charges) - this.form.discount_amount).toFixed(2);

        }
    },
    watch: {
        'form.discount_type': function ($value) {
            this.calculateDiscount($value);
        },
        discountRate: function ($value) {
            this.calculateDiscount(this.form.discount_type);
        },
        'form.tax_id': function ($value) {
            if ($value !== "") {
                const tax = this.taxes.filter(tax => tax.id == $value);
                this.form.tax_amount = (tax[0].rate * this.netTotal) / 100;
                this.form.total_before_tax = this.netTotal - this.form.tax_amount;
            } else {
                this.form.tax_amount = 0;
            }
        },
        'form.amount': function ($value) {
            this.form.total_before_tax = this.netTotal - this.tax_amount;
            this.form.due_amount = this.form.netTotal - $value;
        }
    },
    methods: {
        calculateDiscount(type) {
            if (type === 'fixed') {
                this.form.discount_amount = this.discountRate;
            } else if (type === 'percentage') {
                this.form.discount_amount = (this.discountRate * this.netTotal) / 100;
            } else {
                this.form.discount_amount = 0;
            }
        },
        fetchSuppliers(search, loading) {
            if (search.length) {
                loading(true);
                this.searchSuppliers(loading, search, this);
            }
        },
        searchSuppliers: _.debounce((loading, search, vm) => {

            axios.get("/api/suppliers?search=" + search
            ).then(({ data }) => {
                vm.suppliers = data.data;
                loading(false);
            }
            ).catch(error => console.log('Error: ' + error));

        }, 350),
        selectSupplier(supplier) {
            this.form.supplier_id = supplier.id;
        },
        fetchProducts(search, loading) {
            if (search.length) {
                loading(true);
                this.searchProducts(loading, search, this);
            }
        },
        searchProducts: _.debounce((loading, search, vm) => {

            axios.get("/api/products?search=" + search
            ).then(({ data }) => {
                vm.products = data.data;
                loading(false);
            }
            ).catch(error => console.log('Error: ' + error));

        }, 350),
        selectProduct(product) {
            //
            this.form.selected_products.push(product);
        },
        productSelected() {
            this.productSearch = null;
            this.$refs.productSearch.$el.focus();
        },
        removeProduct(index) {
            this.form.selected_products.splice(this.form.selected_products.indexOf(index), 1);
        },
        getLocations() {
            axios.get("/api/locations?paginate=100"
            ).then(({ data }) => this.locations = data.data
            ).catch(error => console.log('Error: ' + error));
        },
        getTaxes() {
            axios.get("/api/taxes?paginate=100"
            ).then(({ data }) => this.taxes = data.data
            ).catch(error => console.log('Error: ' + error));
        },
        store() {
            this.$Progress.start();
            this.form.post(this.endPoint).then(() => {
                Notification.success('Purchase Added');
                this.$Progress.finish();
                // this.$router.push({ name: 'purchases.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });

        },
        update() {
            this.form.put(this.endPoint + '/' + this.form.id).then(() => {
                Notification.success('Purchase Updated');
                this.$router.push({ name: 'purchases.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });
        },
    },
    components: {
        Datepicker
    },
    created() {
        this.getLocations();
        this.getTaxes();
    }