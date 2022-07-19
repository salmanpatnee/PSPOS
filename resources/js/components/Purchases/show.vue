<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'products.index' }">All Products</router-link>
            </li>
            <li class="active">View Product</li>
        </ol>
        <div class="row product-view">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Product Details </h4>
                            <router-link :to="{ name: 'products.index' }" v-if="can('view-products')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                Products</router-link>
                            <router-link v-id="can('update-products')"
                                :to="{ name: 'products.edit', params: { product: product } }"
                                class="d-inline-block pull-right btn btn-info text-white m-r-15"><i class="fa fa-pencil"
                                    aria-hidden="true"></i> Edit
                            </router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row d-flex flex-y-center">
                            <div class="col-sm-6">
                                <h2> <span class="font-bold">Product Name: </span><span> {{ product.name }} </span></h2>
                                <h4> <span class="font-bold">Barcode/Product ID:</span> <span>{{ product.product_id
                                }}</span></h4>
                                <h4> <span class="font-bold">Category:</span> <span>{{ product.category }}</span></h4>
                                <h4> <span class="font-bold">Brand:</span> <span>{{ product.brand }}</span></h4>
                                <h4> <span class="font-bold">Price:</span> <span>{{ product.price }}</span></h4>
                                <h4> <span class="font-bold">VAT:</span> <span>{{ product.vat }}</span></h4>
                                <h4> <span class="font-bold">Alert Quantity:</span> <span>{{ product.stock_threshold
                                }}</span></h4>
                            </div>
                            <div class="col-sm-6 text-right" v-show="product.image_src">
                                <img :src="product.image_src" class="img-responsive img-thumbnail">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Stock Details </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Purchased</th>
                                        <th>Unit Adjusted</th>
                                        <th>Unit Sold</th>
                                        <th>Unit Transfered</th>
                                        <th>Current Stock</th>
                                        <th>Current Stock value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>XX</td>
                                        <td>XX</td>
                                        <td>XX</td>
                                        <td>XX</td>
                                        <td>XX</td>
                                        <td>XX</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Purchase Report -->
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Purchase Entries </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>Supplier Name</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>7 Feburary 2022</td>
                                        <td>789654123</td>
                                        <td>Acme</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>120</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sales Report -->
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Sales Entries </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>Customer Name</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>9 Feburary 2022</td>
                                        <td>321456987</td>
                                        <td>John Smith</td>
                                        <td>5</td>
                                        <td>16</td>
                                        <td>80</td>
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
        endPoint: '/api/products',
        product: {}
    }),

    methods: {
        show(productId) {
            this.$Progress.start();
            axios.get(this.endPoint + '/' + productId).then((data) => {
                this.product = data.data.data;
            }).catch((error) => {
                this.$Progress.fail();
            });

        },
    },
    created() {
        if (this.$route.params.product) {
            this.show(this.$route.params.product);
        }
    }
}
</script>
