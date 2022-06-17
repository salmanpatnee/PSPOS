<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="small-box bg-green whitecolor">
                    <div class="inner">
                        <h4><span class="count-number">21585</span></h4>
                        <p>Total Customer</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="http://erp.test\/customer_list" class="small-box-footer">Total Customer</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="small-box bg-pase whitecolor">
                    <div class="inner">
                        <h4><span class="count-number">8583</span></h4>

                        <p>Total Product</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                    <a href="http://erp.test\/product_list" class="small-box-footer">Total Product</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="small-box bg-bringal whitecolor">
                    <div class="inner">
                        <h4><span class="count-number">182</span></h4>

                        <p>Total Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="http://erp.test\/supplier_list" class="small-box-footer">Total Supplier </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="small-box bg-darkgreen whitecolor">
                    <div class="inner">
                        <h4><span class="count-number">36009</span> </h4>

                        <p>Total Sale</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="http://erp.test\/invoice_list" class="small-box-footer">Total Sale </a>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
