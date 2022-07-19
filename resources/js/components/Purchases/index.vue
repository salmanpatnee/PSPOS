<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li class="active">Products</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Products</template>

                    <template slot="header-right">
                        <router-link :to="{ name: 'products.create' }" v-if="can('create-products')"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Product</router-link>
                    </template>
                    <template name="before-content">

                        <div class="row mb-2">
                            <div class="col-md-4 form-inline">
                                <paginate-dropdown @updatePageSize="paginate = $event" />
                            </div>
                            <div class="col-md-4 text-center">
                                <a :href="exportUrl" class="btn btn-outline btn-success"
                                    :class="{ 'disabled': !isRecordSelected }">Export to Excel</a>
                            </div>
                            <div class="col-md-4 form-inline text-right">
                                <search @updateSearchTerm="search = $event" />
                            </div>
                        </div>
                    </template>



                    <template name="before-content-additional">
                        <div class="row mt-3" v-show="isRecordSelected">
                            <div class="col-md-12">
                                <p v-if="isAllSelected" class="text-start">You are selecting all <b>{{ selectedRecords
                                }}</b>
                                    records.
                                </p>
                                <p v-else class="text-start">You have selected <b>{{ selectedRecords }}</b> record(s),
                                    Do
                                    you want to select
                                    all
                                    <b v-if="dataLoaded">{{ total }}</b> records?
                                    <a @click.prevent="selectAllRecords" href="">Select all</a>
                                </p>
                            </div>
                        </div>
                    </template>
                    <div class="table-responsive">
                        <table id="products_table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" v-model="checkAll">
                                    </th>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th><a href="" @click.prevent="sort('name')">Name</a>
                                        <span v-show="sortOrder == 'desc' && orderBy == 'name'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'name'">&darr;</span>
                                    </th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>
                                        <a href="" @click.prevent="sort('price')">Price</a>
                                        <span v-show="sortOrder == 'desc' && orderBy == 'price'">&uarr;</span>
                                        <span v-show="sortOrder == 'asc' && orderBy == 'price'">&darr;</span>
                                    </th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products.data" :key="product.id"
                                    :class="{ 'info': isRowSelected(product.id) }">
                                    <td><input type="checkbox" :value="product.id" v-model="checked"></td>
                                    <td>{{ product.product_id }}</td>
                                    <td><img v-show="product.image_src" class="img-thumbnail product-thumbnail"
                                            :src="product.image_src" /></td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.category }}</td>
                                    <td><span v-if="product.brand">{{ product.brand }}</span></td>
                                    <td>{{ product.price }}</td>
                                    <td>{{ product.status }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu action-btns">
                                                <li v-if="can('view-products')">
                                                    <router-link
                                                        :to="{ name: 'products.show', params: { product: product.id } }">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                    </router-link>
                                                </li>
                                                <li v-if="can('update-products')">
                                                    <router-link
                                                        :to="{ name: 'products.edit', params: { product: product } }"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                    </router-link>
                                                </li>
                                                <li v-if="can('delete-products')">
                                                    <a @click.prevent="destroy(product.id)" href="">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li><a @click.prevent="showBarcodeModal(product.id)" href=""><i
                                                            class="fa fa-barcode" aria-hidden="true"></i>
                                                        Barcode</a></li>
                                                <li><a @click.prevent="showStockModal(product.id)" href=""><i
                                                            class="fa fa-database" aria-hidden="true"></i> Stock
                                                        Management</a></li>
                                                <li>
                                                    <router-link
                                                        :to="{ name: 'products.stock.show', params: { product: product.id } }">
                                                        <i class="fa fa-history" aria-hidden="true"></i> Stock
                                                        History
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link
                                                        :to="{ name: 'products.create', params: { product: product, action: 'duplicate' } }">
                                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                                        Duplicate
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </div>


                                        <!-- <edit-button routeName="products.edit" :data="{ product: product }"
                                            permission="update-products" />
                                        <delete-button @handleDelete="destroy(product.id)"
                                            permission="delete-products" /> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="products" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="products" @pagination-change-page="getProducts" />
                            </div>
                        </div>
                    </template>
                </panel>

            </div>
        </div>

        <!-- Barcode Modal -->
        <div class="modal fade modal-success" id="barcode_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-vertical" @submit.prevent="updateBarcode()"
                        @keydown="barcodeForm.onKeydown($event)">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h4 class="modal-title">
                                Update Barcode
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Barcode/Product ID <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="barcodeForm.product_id" class="form-control" id="barode"
                                            type="text" placeholder="Barcode/Product ID" required>
                                        <HasError :form="barcodeForm" field="product_id" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" tabindex="5" data-dismiss="modal">Close</a>
                            <button type="submit" tabindex="6" class="btn btn-success" :disabled="barcodeForm.busy">
                                Update
                            </button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Stock Management Modal -->
        <div class="modal fade modal-success" id="stock_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-vertical" @submit.prevent="updateStock()" @keydown="stockForm.onKeydown($event)">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h4 class="modal-title">
                                Add/Edit Stock
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Product
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="stockForm.name" class="form-control" id="name" type="text"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Current Stock
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="stockForm.currentStock" class="form-control" id="currentStock"
                                            type="text" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Stock after Adjustment
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="stockForm.adjustedStock" class="form-control" id="adjustedStock"
                                            type="text" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Stock
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="stockForm.stock" class="form-control" id="stock" type="number"
                                            autofocus>
                                        <HasError :form="stockForm" field="stock" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" tabindex="5" data-dismiss="modal">Close</a>
                            <button type="submit" tabindex="6" class="btn btn-success" :disabled="stockForm.busy">
                                Update
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
        barcodeForm: new Form({
            product_id: ''
        }),
        baseEndPoint: '/api/products',
        checked: [],
        checkAll: false,
        dataLoaded: false,
        exportUrl: '',
        id: '',
        modal: "#barcode_modal",
        orderBy: 'created_at',
        paginate: 10,
        products: {},
        search: '',
        isAllSelected: false,
        sortOrder: 'desc',
        stockModal: "#stock_modal",
        stockForm: new Form({
            stock: ''
        }),
    }),
    computed: {
        total() {
            return this.products.meta.total;
        },
        selectedRecords() {
            return this.checked.length;
        },
        isRecordSelected() {
            return this.selectedRecords > 0;
        }
    },
    watch: {
        paginate: function ($value) {
            this.getProducts();
        },
        search: function ($value) {
            this.getProducts();
        },
        checkAll: function ($value) {
            this.checked = [];
            this.isAllSelected = false;

            if ($value) {
                this.products.data.map(products => this.checked.push(products.id));
                this.checkAll = true;
            }
        },
        checked: function ($value) {
            this.exportUrl = this.baseEndPoint + "/export/" + this.checked;
        }
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    methods: {
        getProducts(page = 1) {
            this.$Progress.start();
            axios.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.products = data;
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
            this.getProducts();
        },
        isRowSelected(id) {
            return this.checked.includes(id);
        },
        selectAllRecords() {
            axios.get(this.baseEndPoint + '/selectAll').then(response => {
                this.checked = response.data;
                this.isAllSelected = true;
            }).catch(error => {
                console.log('Error: ' + error);
            });
        },
        async destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalCustomers = this.products.data;

                    this.products.data = this.products.data.filter(product => product.id != id);
                    axios.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Product Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.products.data = originalCustomers;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
        showBarcodeModal(id) {
            this.barcodeForm.reset();
            this.id = id;
            $(this.modal).modal('show');
        },
        showStockModal(id) {
            this.stockForm.reset();
            this.id = id;
            $(this.stockModal).modal('show');
        },
        updateBarcode() {
            this.$Progress.start();
            this.barcodeForm.put('/api/products/barcode/' + this.barcodeForm.id).then(() => {
                this.getProducts();
                $(this.modal).modal('hide');
                Notification.success('Barcode Updated');
                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
        updateStock() {
            console.log('updated');
        }
    },

    created() {
        this.getProducts();
    }
}
</script>
