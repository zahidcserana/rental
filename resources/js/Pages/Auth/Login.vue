<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: 'admin@admin.com',
    password: 'secret',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <JetAuthenticationCard>
        <div class="m-login__signin">
            <div class="m-login__head">
                <h3 class="m-login__title">
                    {{ $page.props.config.title }}
                </h3>
            </div>
            <form class="m-login__form m-form" @submit.prevent="submit">
                <div class="form-group m-form__group">
                    <input class="form-control m-input"  type="text" placeholder="Email" v-model="form.email" autocomplete="off">
                </div>
                <div class="form-group m-form__group">
                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" v-model="form.password">
                </div>
<!--                <div class="row m-login__form-sub">
                    <div class="m-checkbox  m-checkbox&#45;&#45;light">
                        <label class="flex items-center">
                            <JetCheckbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <label class="m-checkbox  m-checkbox&#45;&#45;light">
                            <input type="checkbox" name="remember" >
                            Remember me
                            <span></span>
                        </label>
                    </div>
                    <div class="col m&#45;&#45;align-right m-login__form-right">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="m-link">
                            Forgot your password?
                        </Link>
                        <a href="javascript:;" id="m_login_forget_password" class="m-link">
                            Forget Password ?
                        </a>
                    </div>
                </div>-->
                <div class="m-login__form-action">
                    <button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
                        Sign In
                    </button>
                </div>
            </form>
        </div>

<!--        <div class="m-login__forget-password">
            <div class="m-login__head">
                <h3 class="m-login__title">
                    Forgotten Password ?
                </h3>
                <div class="m-login__desc">
                    Enter your email to reset your password:
                </div>
            </div>
            <form class="m-login__form m-form" action="">
                <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                </div>
                <div class="m-login__form-action">
                    <button id="m_login_forget_password_submit" class="btn m-btn m-btn&#45;&#45;pill m-btn&#45;&#45;custom m-btn&#45;&#45;air m-login__btn m-login__btn&#45;&#45;primary">
                        Request
                    </button>
                    &nbsp;&nbsp;
                    <button id="m_login_forget_password_cancel" class="btn m-btn m-btn&#45;&#45;pill m-btn&#45;&#45;custom m-btn&#45;&#45;air m-login__btn">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        <div class="m-login__account">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>
            &nbsp;&nbsp;
            <a href="javascript:;" id="m_login_signup" class="m-link m-link&#45;&#45;light m-login__account-link">
                Sign Up
            </a>
        </div>-->
    </JetAuthenticationCard>
</template>
