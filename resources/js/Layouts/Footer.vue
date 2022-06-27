<template>
  <footer class="m-grid__item m-footer ">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
      <div class="m-footer__wrapper">
        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
          <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
            <span class="m-footer__copyright">
                {{ $page.props.config.company.year }} &copy; {{ $page.props.config.company.moto }} by <a :href="$page.props.config.company.website" target="_blank" class="m-link"> {{ $page.props.config.company.title }} </a>
            </span>
          </div>
          <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                <li class="m-nav__item">
                    <a :href="route('dashboard')" class="m-nav__link">
                        <span class="m-nav__link-text"> Home </span>
                    </a>
                </li>
                <li class="m-nav__item">
                    <a :href="route('invoice.index')" class="m-nav__link">
                        <span class="m-nav__link-text"> Invoice </span>
                    </a>
                </li>
                <li class="m-nav__item">
                    <a :href="route('flat.index')" class="m-nav__link">
                        <span class="m-nav__link-text"> Flat </span>
                    </a>
                </li>
                <li class="m-nav__item">
                    <a :href="route('customer.index')" class="m-nav__link">
                        <span class="m-nav__link-text"> Customer </span>
                    </a>
                </li>
              <li class="m-nav__item">
                <a :href="$page.props.config.company.contact" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                  <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
