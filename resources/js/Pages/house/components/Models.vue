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
                                    <table class="table table-responsive m-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th v-if="$page.props.isAdmin">Owner</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(row,index) in param.data.data" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <jet-responsive-nav-link :href="row.link_edit">
                                                    {{ row.name }}
                                                </jet-responsive-nav-link>
                                            </td>
                                            <td>{{ row.code }}</td>
                                            <td v-if="$page.props.isAdmin">
                                                <jet-responsive-nav-link :href="row.user.url">
                                                    {{ row.user.name }}
                                                </jet-responsive-nav-link>
                                            </td>
                                            <td>
                                                <span class="custom-badge" v-bind:class="row.status == 'ACTIVE' ? 'status-green' : 'status-red'">{{ row.status }}</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <jet-responsive-nav-link :href="row.link_edit" class="dropdown-item">
                                                            <i class="fa fa-pencil m-r-5"></i>&nbsp; Edit
                                                        </jet-responsive-nav-link>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" @click="deleteRow(row)">
                                                            <i class="fa fa-trash-o m-r-5"></i> Delete </a>
                                                    </div>
                                                </div>
                                            </td>
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

export default {
    components: {
        JetResponsiveNavLink
    },
    props: ['param'],
    methods: {
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return
            data._method = 'DELETE'
            this.$inertia.post(data.link_delete.url, data)
        }
    }
}
</script>
