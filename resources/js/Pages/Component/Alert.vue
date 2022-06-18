<script setup>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import swal from 'sweetalert2'
window.Swal = swal

const success = (status) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: status
    })
};

const error = (errors) => {
    let list = []
    $.each(errors, function (key, value) {
        list.push(value)
    })

    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: list[0],
        showConfirmButton: false,
        timer: 1500
    })
};

defineProps({
    title: String,
    flash: Object,
    errors: Object,
    link: String,
    label: String,
    param: Object,
});
</script>
<template>
    <div class="row">
        <div class="col-6 m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ title ? title : 'House Rent' }}
                    </h3>
                </div>
            </div>
            <div
                v-if="flash && flash.message"
                :type="success(flash.message)"
            ></div>
            <div v-if="Object.keys(errors).length" :type="error(errors)"></div>
        </div>
        <div class="col-6">
            <jet-responsive-nav-link
                style="right: 5%; position: absolute; top: 20%;"
                :href="route(link)"
                :active="route().current(link)"
                class="btn btn-success m-btn m-btn--icon m-btn--pill m-btn--ai side-button"
            >
                <i class="la la-angle-double-left" aria-hidden="true"></i>
                <span> &nbsp; {{ label }} </span>
            </jet-responsive-nav-link>
        </div>
    </div>
</template>
