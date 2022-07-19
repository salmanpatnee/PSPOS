<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'products.index' }">All Products</router-link>
            </li>
            <li class="active">Stock History</li>
        </ol>
        <div class="row product-view">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Product Stock History </h4>
                            <router-link :to="{ name: 'products.index' }" v-if="can('view-products')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                Products</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row d-flex flex-y-center">
                            <div class="col-sm-6">
                                <h2 class="m-t-0"> <span class="font-bold">Product Name: </span><span> {{ product.name
                                }} </span></h2>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row d-flex flex-y-center">
                                    <label class="col-md-3">
                                        Select Product
                                    </label>
                                    <div class="col-md-9">

                                        <select class="form-control">
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                            <option>Select a Product</option>
                                        </select>
                                    </div>
                                </div>
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
                            <h4 class="d-inline-block">History </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="font-bold">Quantities In</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Total Purchase</th>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <th>Opening Stock</th>
                                                <td>10</td>
                                            </tr>
                                            <tr>
                                                <th>Total Sell Return</th>
                                                <td>50</td>
                                            </tr>
                                            <tr>
                                                <th>Stock Transfers (In)</th>
                                                <td>0</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-bold">Quantities Out</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Total Sold</th>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <th>Total Stock Adjustment</th>
                                                <td>10</td>
                                            </tr>
                                            <tr>
                                                <th>Total Purchase Return</th>
                                                <td>50</td>
                                            </tr>
                                            <tr>
                                                <th>Stock Transfers (Out)</th>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-bold">Total</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Current stock</th>
                                                <td>100</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
