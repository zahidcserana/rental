<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <slot name="header"></slot>
                        <div class="m-portlet__body">
                            <!--begin::Section-->
                            <div class="m-section">
                                <div class="m-section__content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><b>Month</b></label>: {{ formatDate(param.data.date) }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><b>Flat</b></label>:
                                                <span v-for="(row,index) in param.data.invoice_items" :key="index">{{ row.flat.name }}({{ row.amount }})</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><b>Status</b></label>: {{ param.data.status }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                                <p>
                                                    <span style="font-size: 15px">Customer Details:</span>
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Name</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.customer.name }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Email</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.customer.email }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Mobile</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.customer.mobile }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Due</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.customer.account_balance }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Advance</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.customer.advance_balance }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <span style="font-size: 15px">Invoice Details:</span>
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Subtotal</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.subtotal }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Additional Amount</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.additional_cost }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Discount</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.discount }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Total Amount</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.total }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Paid Amount</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.paid }}</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Due Amount</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>{{ param.data.total - param.data.paid }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['param'],
    methods: {
        formatDate (value) {
            return moment(String(value)).format("MMMM YYYY");
        }
    }
}
</script>
