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
                                <form id="filter-form">
                                    <div class="row filter-row">
                                        <div>
                                            <Datepicker v-model="month" monthPicker autoApply></Datepicker>
                                        </div>
                                        <div v-if="param.customers" class="col-sm-6 col-md-3">
                                            <div class="form-group form-focus">
                                                <select class="form-control select"  v-model="query.customer_id">
                                                    <option value="">-- Customer --</option>
                                                    <option  v-for="(row,index) in param.customers" :key="index" :value="row.id">{{ row.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div v-if="param.status" class="col-sm-2 col-md-2">
                                            <div class="form-group form-focus">
                                                <select class="form-control select mb-2 mr-sm-2"  v-model="query.status">
                                                    <option value="" selected>-- Status --</option>
                                                    <option value="paid" selected>Paid</option>
                                                    <option value="due" selected>Due/Unpaid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <button
                                                type="button"
                                                @click="getData()"
                                                class="btn btn-success btn-block"
                                            >
                                                Search
                                            </button>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <button type="button" @click="resetData()" class="btn btn-warning btn-block"> Reset </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Month</th>
                                                <th>Renter</th>
                                                <th>Subtotal</th>
                                                <th>Additional Cost</th>
                                                <th>Discount</th>
                                                <th>Payable Amount</th>
                                                <th>Paid Amount</th>
                                                <th>Due Amount</th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="row in param.data.data" :key="row.id">
                                                <td>
                                                    <jet-responsive-nav-link :href="row.link_edit">
                                                        {{ row.number }}
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td>{{ formatDate(row.date) }}</td>
                                                <td>
                                                    <jet-responsive-nav-link :href="row.customer.url">
                                                        <span class="m-menu__link-text">{{ row.customer.name }}</span>
                                                    </jet-responsive-nav-link>
                                                </td>
                                                <td>{{ row.subtotal }}</td>
                                                <td>{{ row.additional_cost }}</td>
                                                <td>{{ row.discount }}</td>
                                                <td>{{ row.total }}</td>
                                                <td>{{ row.paid }}</td>
                                                <td>{{ row.due_amount }}</td>
                                                <td>
                                                    <span class="m-badge m-badge--wide" v-bind:class="statusMap(row.status)">{{ param.status[row.status] }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <jet-responsive-nav-link :href="row.link_edit" class="dropdown-item">
                                                                <i class="fa fa-pencil m-r-5"></i>&nbsp; Edit
                                                            </jet-responsive-nav-link>
                                                            <jet-responsive-nav-link :href="row.link_show" class="dropdown-item">
                                                                <i class="fa fa-pencil m-r-5"></i>&nbsp; View
                                                            </jet-responsive-nav-link>
                                                            <a class="dropdown-item" href="#" data-toggle="modal" @click="deleteRow(row)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="grand-total">
                                                <td colspan="3">Grand Total</td>
                                                <td>{{ param.summary.subtotal }}</td>
                                                <td>{{ param.summary.additional_cost }}</td>
                                                <td>{{ param.summary.discount }}</td>
                                                <td>{{ param.summary.total }}</td>
                                                <td>{{ param.summary.paid }}</td>
                                                <td>{{ param.summary.due }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import ServiceModel from './ServiceModel'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { ref } from 'vue'

export default {
    components: {
        JetResponsiveNavLink,
        Datepicker
    },
    setup () {
        const month = ref({
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        })
        return {
            month
        }
    },
    props: ['param'],
    data () {
        return {
            customers: null,
            query: ServiceModel.search
        }
    },
    mounted () {
        if (!_.isEmpty(this.param.query)) {
            this.query = this.param.query
            this.month.year = this.query.date_invoice.year
            this.month.month = this.query.date_invoice.month
        }

        if (this.param.query.length === 0) {
            this.resetQuery()
        }
    },
    methods: {
        formatDate (value) {
            return moment(String(value)).format("MMMM-YY");
        },
        resetQuery: function () {
            this.query = {
                customer_id: '',
                status: 'unpaid',
            }
        },
        getData: function () {
            // this.month.month = (this.month.month + 1).toLocaleString('en-US', {
            //     minimumIntegerDigits: 2,
            //     useGrouping: false
            // })
            //
            // this.query.date_invoice.push(myMonth)
            // this.query.date_invoice.push(this.month.year)
            this.query.date_invoice = this.month

            this.$inertia.get('/invoice', this.query)
        },
        resetData: function () {
            this.resetQuery()
            this.$inertia.get('/invoice')
        },
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return
            data._method = 'DELETE'
            this.$inertia.post(data.link_delete.url, data)
        },
        statusMap(value) {
            const status = {
                unpaid: "m-badge--primary",
                paid: "m-badge--success",
                cancel: "m-badge--warning",
                INITIATED: "m-badge--brand",
                INITIATING: "m-badge--metal",
                APPROVED_BY_GM: "m-badge--info",
                APPROVED_BY_DF: "m-badge--danger",
                pending: "m-badge--primary",
                available: "m-badge--primary",
                rented: "m-badge--success",
                unavailable: "m-badge--warning",
                due: "m-badge--warning",
                active: "m-badge--success",
                inactive: "m-badge--warning",
            };

            return status[value];
        }
    }
}
</script>

<style>
.pl-3, .px-3 {
    padding-left: 0!important;
}
</style>
