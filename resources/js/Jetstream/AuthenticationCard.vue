<script>
$('body').removeClass('m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default')
$('body').addClass('m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default')
</script>

<template>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-1.jpg);">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img src="assets/app/media/img//logos/logo-1.png">
                        </a>
                    </div>

                    <slot />

                </div>
            </div>
        </div>
    </div>
</template>
