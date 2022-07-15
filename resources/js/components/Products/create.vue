<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'products.index' }">All Products</router-link>
            </li>
            <li class="active">{{ editMode ? 'Edit' : 'Add' }} Product</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Add Product </h4>

                            <router-link :to="{ name: 'products.index' }" v-if="can('view-products')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                Products</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="product_id" class="col-sm-4 col-form-label text-d">Barcode <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.product_id" class="form-control" type="text"
                                                placeholder="Barcode" id="product_id" autofocus>
                                            <HasError :form="form" field="product_id" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-d">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.name" class="form-control" type="text"
                                                placeholder="Name" id="name">
                                            <HasError :form="form" field="name" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-4 col-form-label text-d">Category <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select v-model="form.category_id" id="category_id" class="form-control">
                                                <option v-for="category in categories" :key="category.id"
                                                    :value="category.id" v-text="category.name"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label for="brand_id" class="col-sm-4 col-form-label text-d">Brand</label>
                                        <div class="col-sm-8">
                                            <select v-model="form.brand_id" id="brand_id" class="form-control">
                                                <option value="">Select a Brand</option>
                                                <option v-for="brand in brands" :key="brand.id" :value="brand.id"
                                                    v-text="brand.name"></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class=" form-group row">
                                        <label for="price" class="col-sm-4 col-form-label text-d">Price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.price" class="form-control" type="number" step="any"
                                                placeholder="Price" id="price">
                                            <HasError :form="form" field="price" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class=" form-group row">
                                        <label for="vat" class="col-sm-4 col-form-label text-d">VAT </label>
                                        <div class="col-sm-8">
                                            <input v-model="form.vat" class="form-control" type="number" step="any"
                                                placeholder="VAT" id="vat">
                                            <HasError :form="form" field="vat" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-4 col-form-label text-d">Description
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea v-model="form.description" class="form-control"
                                                placeholder="Description" id="description">
                                            </textarea>
                                            <HasError :form="form" field="description" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="stock_threshold" class="col-sm-4 col-form-label text-d">Alert
                                            Quantity
                                        </label>
                                        <div class="col-sm-8">
                                            <input v-model="form.stock_threshold" class="form-control" type="number"
                                                placeholder="Alert Quantity" id="stock_threshold">
                                            <HasError :form="form" field="stock_threshold" />
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
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-4 col-form-label text-d">Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" @change="uploadFile" class="form-control" id="image"
                                                tabindex="3" />
                                            <HasError :form="form" field="image" />
                                            <div id="image_preview" class="mt-2">
                                                <img class="elevation-2" :src="getProfileImage()">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-right">
                                    <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                    <Button v-if="can('create-products')" :form="form"
                                        class="btn btn-success w-md m-b-5">{{
                                                editMode ? "Update" : "Add"
                                        }}
                                    </Button>

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
import Select2 from 'v-select2-component';

export default {

    data: () => ({
        endPoint: '/api/products',
        categories: {},
        brands: {},
        editMode: false,
        form: new Form({
            id: '',
            name: '',
            product_id: '',
            category_id: 1,
            brand_id: '',
            image_src: null,
            description: '',
            price: '',
            vat: '',
            units_sold: '',
            stock_threshold: '',
            status: 'Active',
        })
    }),
    components: {
        Select2
    },
    methods: {
        store() {
            this.$Progress.start();
            this.form.post(this.endPoint).then(() => {
                Notification.success('Product Added');
                this.$Progress.finish();
                this.$router.push({ name: 'products.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });

        },
        update() {
            this.form.put(this.endPoint + '/' + this.form.id).then(() => {
                Notification.success('Product Updated');
                this.$router.push({ name: 'products.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });
        },
        getCategories() {
            axios.get("/api/categories?paginate=100"
            ).then(({ data }) => this.categories = data.data
            ).catch(error => console.log('Error: ' + error));
        },
        getBrands() {
            axios.get("/api/brands?paginate=100"
            ).then(({ data }) => this.brands = data.data
            ).catch(error => console.log('Error: ' + error));
        },
        uploadFile(e) {
            let file = e.target.files[0];
            if (file['size'] <= '2097152') {

                let reader = new FileReader()

                reader.onloadend = (file) => {
                    this.form.image_src = reader.result;
                }

                reader.readAsDataURL(file);
            } else {
                Notification.error('You are uploading a large file.');
            }
        },
        getProfileImage() {
            if (!this.form.image_src) return;
            return (this.form.image_src.length > 200)
                ? this.form.image_src
                : this.form.image_src;
        },
    },
    created() {
        this.getCategories();
        this.getBrands();

        if (this.$route.params.action === 'duplicate') {
            this.form.fill(this.$route.params.product);
            this.editMode = false;
        } else {
            if (this.$route.params.product) {
                this.form.fill(this.$route.params.product);
                this.editMode = true;
            }
        }

    }
}
</script>
