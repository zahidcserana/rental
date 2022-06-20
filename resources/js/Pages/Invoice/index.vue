<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Models from './components/Models'
import Alert from '@/Pages/Component/Alert'

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
    <AppLayout>
        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
            <Models :param="param">
                <template #header>
                    <Alert
                        :title="title"
                        :flash="flash"
                        :errors="errors"
                        :link="link"
                        :label="label"
                    />
                </template>
            </Models>
        </div>
    </AppLayout>
</template>

