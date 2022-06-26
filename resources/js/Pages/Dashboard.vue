<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import {Inertia} from "@inertiajs/inertia";

defineProps({
    title: String,
    param: Object,
});

const formatDate = (value) => {
    return moment(String(value)).format("MMMM-YY");
};
</script>

<template>
  <AppLayout>
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
      <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
          <div class="d-flex align-items-center">
            <div class="mr-auto">
              <h3 class="m-subheader__title "> Dashboard </h3>
            </div>
            <div>
                <span class="title-total">{{ $page.props.auth.today }}</span>
<!--              <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                <span class="m-subheader__daterange-label">
                  <span class="m-subheader__daterange-title"></span>
                  <span class="m-subheader__daterange-date m&#45;&#45;font-brand"></span>
                </span>
                <a href="#" class="btn btn-sm btn-brand m-btn m-btn&#45;&#45;icon m-btn&#45;&#45;icon-only m-btn&#45;&#45;custom m-btn&#45;&#45;pill">
                  <i class="la la-angle-down"></i>
                </a>
              </span>-->
            </div>
          </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
          <!--Begin::Section-->
          <div class="row">
            <div class="col-xl-4">
              <!--begin:: Widgets/Top Products-->
              <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Customer </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                      <span class="title-total">{{ param.customerCount }}</span>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <!--begin::Widget5-->
                  <div class="m-widget4">
                    <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20" style="height:260px;">
                      <canvas id="m_chart_trends_stats"></canvas>
                    </div>
                    <div v-for="row in param.customer" :key="row.id" class="m-widget4__item">
                      <div class="m-widget4__img m-widget4__img--logo">
                        <img src="assets/app/media/img/client-logos/logo3.png" alt="">
                      </div>
                      <div class="m-widget4__info">
                        <span class="m-widget4__title"> {{ row.name }} </span>
                        <br>
                        <span class="m-widget4__sub"> {{ row.mobile }} </span>
                      </div>
                      <span class="m-widget4__ext">
                        <span class="m-widget4__number m--font-danger"> {{ row.account_balance }} </span>
                      </span>
                    </div>
                  </div>
                  <!--end::Widget 5-->
                </div>
              </div>
              <!--end:: Widgets/Top Products-->
            </div>
            <div class="col-xl-4">
              <!--begin:: Widgets/Activity-->
              <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded m-portlet--rounded-force">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text m--font-light">
                          <span class="title-total">{{ $page.props.config.company.title }}</span><br>
                          <span class="title-total"><small>{{ $page.props.config.company.mobile }}</small></span><br>
                      </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                      <span class="title-caption">{{ $page.props.config.company.caption }}</span><br>
                      <span class="title-caption"><small>{{ $page.props.config.company.email }}</small></span><br>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="m-widget17">
                    <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
                      <div class="m-widget17__chart" style="height:320px;">
                        <canvas id="m_chart_activities"></canvas>
                      </div>
                    </div>
                    <div class="m-widget17__stats">
                      <div class="m-widget17__items m-widget17__items-col1">
                        <div class="m-widget17__item">
                          <span class="m-widget17__icon">
                            <i class="flaticon-truck m--font-brand"></i>
                          </span>
                          <span class="m-widget17__subtitle"> Customer </span>
                          <span class="m-widget17__desc"> Total: &nbsp; {{ param.customerCount }} </span>
                        </div>
                        <div class="m-widget17__item">
                          <span class="m-widget17__icon">
                            <i class="flaticon-paper-plane m--font-info"></i>
                          </span>
                          <span class="m-widget17__subtitle"> Flat </span>
                          <span class="m-widget17__desc">Rented: &nbsp; {{ param.flatRentedCount }} </span>
                        </div>
                      </div>
                      <div class="m-widget17__items m-widget17__items-col2">
                        <div class="m-widget17__item">
                          <span class="m-widget17__icon">
                            <i class="flaticon-pie-chart m--font-success"></i>
                          </span>
                          <span class="m-widget17__subtitle"> Invoice </span>
                          <span class="m-widget17__desc">Due No: &nbsp; {{ param.summary.invoice }} </span>
                        </div>
                        <div class="m-widget17__item">
                          <span class="m-widget17__icon">
                            <i class="flaticon-time m--font-danger"></i>
                          </span>
                          <span class="m-widget17__subtitle"> Invoice </span>
                          <span class="m-widget17__desc"> Last Month Due: &nbsp; {{ param.summary.totalLastMonthDue }} </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--end:: Widgets/Activity-->
            </div>
            <div class="col-xl-4">
              <!--begin:: Widgets/Blog-->
              <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded m-portlet--rounded-force">
                <div class="m-portlet__head m-portlet__head--fit">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-action">
                      <button type="button" class="btn btn-sm m-btn--pill  btn-brand"> House </button>
                    </div>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="m-widget19">
                    <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                      <img :src="$page.props.config.images.house" alt="">
                      <h3 class="m-widget19__title m--font-light"> House Rent Mangement </h3>
                      <div class="m-widget19__shadow"></div>
                    </div>
                    <div class="m-widget19__content">
                      <div class="m-widget19__header">
                        <div class="m-widget19__user-img">
                          <img class="m-widget19__img" :src="$page.props.config.images.user" alt="">
                        </div>
                        <div class="m-widget19__info">
                          <span class="m-widget19__username"> {{ $page.props.user.name }} </span>
                          <br>
                          <span class="m-widget19__time"> {{ $page.props.user.email }} </span>
                        </div>
                        <div class="m-widget19__stats">
                          <span class="m-widget19__number m--font-brand"> {{ param.lastMonthCollect }} </span>
                          <span class="m-widget19__comment"> Tk. Paid </span>
                        </div>
                      </div>
                      <div class="m-widget19__body">
                          House:&nbsp; {{ $page.props.user.house.name }} <br>
                          Code:&nbsp; {{ $page.props.user.house.code }} <br>
                          Address:&nbsp; {{ $page.props.user.house.address }} <br>
                      </div>
                    </div>
                    <div class="m-widget19__action">
                      <a :href="$page.props.config.company.contact" type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom"> Read More </a>
                    </div>
                  </div>
                </div>
              </div>
              <!--end:: Widgets/Blog-->
            </div>
          </div>
          <!--End::Section-->
          <!--Begin::Section-->
          <div class="row">
            <div class="col-xl-8">
              <!--begin:: Widgets/Application Sales-->
              <div class="m-portlet m-portlet--full-height  m-portlet--rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Invoice Due Total: {{ param.summary.totalDue }}&nbsp;Tk, &nbsp; Last Month Due: {{ param.summary.totalLastMonthDue }}</h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab"> Last Month </a>
                      </li>
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab"> All Time </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="m_widget11_tab1_content">
                      <!--begin::Widget 11-->
                      <div class="m-widget11">
                        <div class="table-responsive">
                          <!--begin::Table-->
                          <table class="table">
                            <!--begin::Thead-->
                            <thead>
                              <tr>
                                <td class="m-widget11__label"> # </td>
                                <td class="m-widget11__app"> Customer </td>
                                <td class="m-widget11__sales"> Invoice </td>
                                <td class="m-widget11__change">Month </td>
                                <td class="m-widget11__price"> Total(Tk) </td>
                                <td class="m-widget11__total m--align-right"> Due(Tk) </td>
                              </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody>
                            <tr v-for="row in param.invoiceLastMonth.data" :key="row.id">
                                <td>
                                  <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                    <input type="checkbox">
                                    <span></span>
                                  </label>
                                </td>
                                <td>
                                    <JetResponsiveNavLink :href="row.customer.url">
                                        <span class="m-menu__link-text">{{ row.customer.name }}</span>
                                    </JetResponsiveNavLink>
                                </td>
                                <td>
                                    <jet-responsive-nav-link :href="row.link_edit">
                                        {{ row.number }}
                                    </jet-responsive-nav-link>
                                </td>
                                <td> {{ formatDate(row.date) }} </td>
                                <td> {{ row.total }} </td>
                                <td class="m--align-right m--font-brand"> {{ row.total - row.paid }} </td>
                              </tr>
                            </tbody>
                            <!--end::Tbody-->
                          </table>
                          <!--end::Table-->
                        </div>
                        <div class="m-widget11__action m--align-right">
                            <a :href="route('invoice.index', {'status':'due'})" type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--hover-brand"> View </a>
                        </div>
                      </div>
                      <!--end::Widget 11-->
                    </div>
                    <div class="tab-pane" id="m_widget11_tab2_content">
                      <!--begin::Widget 11-->
                      <div class="m-widget11">
                        <div class="table-responsive">
                          <!--begin::Table-->
                          <table class="table">
                            <!--begin::Thead-->
                            <thead>
                              <tr>
                                  <td class="m-widget11__label"> # </td>
                                  <td class="m-widget11__app"> Customer </td>
                                  <td class="m-widget11__sales"> Invoice </td>
                                  <td class="m-widget11__change">Month </td>
                                  <td class="m-widget11__price"> Total(Tk) </td>
                                  <td class="m-widget11__total m--align-right"> Due(Tk) </td>
                              </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody>
                            <tr v-for="row in param.invoice.data" :key="row.id">
                                <td>
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                        <input type="checkbox">
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <JetResponsiveNavLink :href="row.customer.url">
                                        <span class="m-menu__link-text">{{ row.customer.name }}</span>
                                    </JetResponsiveNavLink>
                                </td>
                                <td>
                                    <jet-responsive-nav-link :href="row.link_edit">
                                        {{ row.number }}
                                    </jet-responsive-nav-link>
                                </td>
                                <td> {{ formatDate(row.date) }} </td>
                                <td> {{ row.total }} </td>
                                <td class="m--align-right m--font-brand"> {{ row.total - row.paid }} </td>
                            </tr>
                            </tbody>
                            <!--end::Tbody-->
                          </table>
                          <!--end::Table-->
                        </div>
                        <div class="m-widget11__action m--align-right">
                          <a :href="route('invoice.index')" type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--hover-brand"> View </a>
                        </div>
                      </div>
                      <!--end::Widget 11-->
                    </div>
                  </div>
                </div>
              </div>
              <!--end:: Widgets/Application Sales-->
            </div>
            <div class="col-xl-4">
              <!--begin:: Widgets/Latest Updates-->
              <div class="m-portlet m-portlet--full-height m-portlet--fit  m-portlet--rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Available Flats </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                      <span class="title-total">{{ param.flatAvailableCount }}</span>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="m-widget4 m-widget4--chart-bottom" style="min-height: 350px">
                    <div v-for="row in param.flatAvailable.data" :key="row.id" class="m-widget4__item">
                      <div class="m-widget4__ext">
                        <a href="#" class="m-widget4__icon m--font-brand">
                            <i class="flaticon-line-graph"></i>
                        </a>
                      </div>
                      <div class="m-widget4__info">
                          <jet-responsive-nav-link :href="row.link_edit">
                              <span class="m-widget4__text"> {{ row.name }} </span>
                          </jet-responsive-nav-link>
                      </div>
                      <div class="m-widget4__ext">
                        <span class="m-widget4__number m--font-accent"> {{ row.rent }} </span>
                      </div>
                    </div>
                    <div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
                      <canvas id="m_chart_latest_updates"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <!--end:: Widgets/Latest Updates-->
            </div>
          </div>
          <!--End::Section-->
          <!--Begin::Section-->
<!--          <div class="row">
            <div class="col-xl-6 col-lg-12">
              &lt;!&ndash;Begin::Portlet&ndash;&gt;
              <div class="m-portlet  m-portlet&#45;&#45;full-height  m-portlet&#45;&#45;rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Recent Activities </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                      <li class="m-portlet__nav-item m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link m-portlet__nav-link&#45;&#45;icon m-portlet__nav-link&#45;&#45;icon-xl m-dropdown__toggle">
                          <i class="la la-ellipsis-h m&#45;&#45;font-brand"></i>
                        </a>
                        <div class="m-dropdown__wrapper">
                          <span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust"></span>
                          <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                              <div class="m-dropdown__content">
                                <ul class="m-nav">
                                  <li class="m-nav__section m-nav__section&#45;&#45;first">
                                    <span class="m-nav__section-text"> Quick Actions </span>
                                  </li>
                                  <li class="m-nav__item">
                                    <a href="" class="m-nav__link">
                                      <i class="m-nav__link-icon flaticon-share"></i>
                                      <span class="m-nav__link-text"> Activity </span>
                                    </a>
                                  </li>
                                  <li class="m-nav__item">
                                    <a href="" class="m-nav__link">
                                      <i class="m-nav__link-icon flaticon-chat-1"></i>
                                      <span class="m-nav__link-text"> Messages </span>
                                    </a>
                                  </li>
                                  <li class="m-nav__item">
                                    <a href="" class="m-nav__link">
                                      <i class="m-nav__link-icon flaticon-info"></i>
                                      <span class="m-nav__link-text"> FAQ </span>
                                    </a>
                                  </li>
                                  <li class="m-nav__item">
                                    <a href="" class="m-nav__link">
                                      <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                      <span class="m-nav__link-text"> Support </span>
                                    </a>
                                  </li>
                                  <li class="m-nav__separator m-nav__separator&#45;&#45;fit"></li>
                                  <li class="m-nav__item">
                                    <a href="#" class="btn btn-outline-danger m-btn m-btn&#45;&#45;pill m-btn&#45;&#45;wide btn-sm"> Cancel </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide" data-scrollbar-shown="true" data-scrollable="true" data-max-height="380" style="overflow: visible; height: 380px; max-height: 380px; position: relative;">
                    &lt;!&ndash;Begin::Timeline 2 &ndash;&gt;
                    <div class="m-timeline-2">
                      <div class="m-timeline-2__items  m&#45;&#45;padding-top-25 m&#45;&#45;padding-bottom-30">
                        <div class="m-timeline-2__item">
                          <span class="m-timeline-2__item-time"> 10:00 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-danger"></i>
                          </div>
                          <div class="m-timeline-2__item-text  m&#45;&#45;padding-top-5"> Lorem ipsum dolor sit amit,consectetur eiusmdd tempor <br> incididunt ut labore et dolore magna </div>
                        </div>
                        <div class="m-timeline-2__item m&#45;&#45;margin-top-30">
                          <span class="m-timeline-2__item-time"> 12:45 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-success"></i>
                          </div>
                          <div class="m-timeline-2__item-text m-timeline-2__item-text&#45;&#45;bold"> AEOL Meeting With </div>
                          <div class="m-list-pics m-list-pics&#45;&#45;sm m&#45;&#45;padding-left-20">
                            <a href="#">
                              <img src="assets/app/media/img/users/100_4.jpg" title="">
                            </a>
                            <a href="#">
                              <img src="assets/app/media/img/users/100_13.jpg" title="">
                            </a>
                            <a href="#">
                              <img src="assets/app/media/img/users/100_11.jpg" title="">
                            </a>
                            <a href="#">
                              <img src="assets/app/media/img/users/100_14.jpg" title="">
                            </a>
                          </div>
                        </div>
                        <div class="m-timeline-2__item m&#45;&#45;margin-top-30">
                          <span class="m-timeline-2__item-time"> 14:00 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-brand"></i>
                          </div>
                          <div class="m-timeline-2__item-text m&#45;&#45;padding-top-5"> Make Deposit <a href="#" class="m-link m-link&#45;&#45;brand m&#45;&#45;font-bolder"> USD 700 </a> To ESL. </div>
                        </div>
                        <div class="m-timeline-2__item m&#45;&#45;margin-top-30">
                          <span class="m-timeline-2__item-time"> 16:00 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-warning"></i>
                          </div>
                          <div class="m-timeline-2__item-text m&#45;&#45;padding-top-5"> Lorem ipsum dolor sit amit,consectetur eiusmdd tempor <br> incididunt ut labore et dolore magna elit enim at minim <br> veniam quis nostrud </div>
                        </div>
                        <div class="m-timeline-2__item m&#45;&#45;margin-top-30">
                          <span class="m-timeline-2__item-time"> 17:00 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-info"></i>
                          </div>
                          <div class="m-timeline-2__item-text m&#45;&#45;padding-top-5"> Placed a new order in <a href="#" class="m-link m-link&#45;&#45;brand m&#45;&#45;font-bolder"> SIGNATURE MOBILE </a> marketplace. </div>
                        </div>
                        <div class="m-timeline-2__item m&#45;&#45;margin-top-30">
                          <span class="m-timeline-2__item-time"> 16:00 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-brand"></i>
                          </div>
                          <div class="m-timeline-2__item-text m&#45;&#45;padding-top-5"> Lorem ipsum dolor sit amit,consectetur eiusmdd tempor <br> incididunt ut labore et dolore magna elit enim at minim <br> veniam quis nostrud </div>
                        </div>
                        <div class="m-timeline-2__item m&#45;&#45;margin-top-30">
                          <span class="m-timeline-2__item-time"> 17:00 </span>
                          <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m&#45;&#45;font-danger"></i>
                          </div>
                          <div class="m-timeline-2__item-text m&#45;&#45;padding-top-5"> Received a new feedback on <a href="#" class="m-link m-link&#45;&#45;brand m&#45;&#45;font-bolder"> FinancePro App </a> product. </div>
                        </div>
                      </div>
                    </div>
                    &lt;!&ndash;End::Timeline 2 &ndash;&gt;
                  </div>
                </div>
              </div>
              &lt;!&ndash;End::Portlet&ndash;&gt;
            </div>
            <div class="col-xl-6 col-lg-12">
              &lt;!&ndash;Begin::Portlet&ndash;&gt;
              <div class="m-portlet m-portlet&#45;&#45;full-height  m-portlet&#45;&#45;rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Recent Notifications </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills&#45;&#45;brand m-nav-pills&#45;&#45;align-right m-nav-pills&#45;&#45;btn-pill m-nav-pills&#45;&#45;btn-sm" role="tablist">
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab"> Today </a>
                      </li>
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content" role="tab"> Month </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="m_widget2_tab1_content">
                      &lt;!&ndash;Begin::Timeline 3 &ndash;&gt;
                      <div class="m-timeline-3">
                        <div class="m-timeline-3__items">
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;info">
                            <span class="m-timeline-3__item-time"> 09:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor sit amit,consectetur eiusmdd tempor </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Bob </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;warning">
                            <span class="m-timeline-3__item-time"> 10:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor sit amit </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Sean </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;brand">
                            <span class="m-timeline-3__item-time"> 11:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor sit amit eiusmdd tempor </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By James </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;success">
                            <span class="m-timeline-3__item-time"> 12:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By James </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;danger">
                            <span class="m-timeline-3__item-time"> 14:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor sit amit,consectetur eiusmdd </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Derrick </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;info">
                            <span class="m-timeline-3__item-time"> 15:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor sit amit,consectetur </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Iman </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;brand">
                            <span class="m-timeline-3__item-time"> 17:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem ipsum dolor sit consectetur eiusmdd tempor </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Aziko </a>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      &lt;!&ndash;End::Timeline 3 &ndash;&gt;
                    </div>
                    <div class="tab-pane" id="m_widget2_tab2_content">
                      &lt;!&ndash;Begin::Timeline 3 &ndash;&gt;
                      <div class="m-timeline-3">
                        <div class="m-timeline-3__items">
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;info">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-focus"> 09:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Contrary to popular belief, Lorem Ipsum is not simply random text. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Bob </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;warning">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-warning"> 10:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> There are many variations of passages of Lorem Ipsum available. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Sean </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;brand">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-primary"> 11:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Contrary to popular belief, Lorem Ipsum is not simply random text. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By James </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;success">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-success"> 12:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> The standard chunk of Lorem Ipsum used since the 1500s is reproduced. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By James </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;danger">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-warning"> 14:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Latin words, combined with a handful of model sentence structures. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Derrick </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;info">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-info"> 15:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Contrary to popular belief, Lorem Ipsum is not simply random text. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Iman </a>
                              </span>
                            </div>
                          </div>
                          <div class="m-timeline-3__item m-timeline-3__item&#45;&#45;brand">
                            <span class="m-timeline-3__item-time m&#45;&#45;font-danger"> 17:00 </span>
                            <div class="m-timeline-3__item-desc">
                              <span class="m-timeline-3__item-text"> Lorem Ipsum is therefore always free from repetition, injected humour. </span>
                              <br>
                              <span class="m-timeline-3__item-user-name">
                                <a href="#" class="m-link m-link&#45;&#45;metal m-timeline-3__item-link"> By Aziko </a>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      &lt;!&ndash;End::Timeline 3 &ndash;&gt;
                    </div>
                  </div>
                </div>
              </div>
              &lt;!&ndash;End::Portlet&ndash;&gt;
            </div>
          </div>-->
          <!--End::Section-->
          <!--Begin::Section-->
<!--          <div class="row">
            <div class="col-xl-8">
              <div class="m-portlet m-portlet&#45;&#45;mobile  m-portlet&#45;&#45;rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Exclusive Datatable Plugin </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                      <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown&#45;&#45;inline m-dropdown&#45;&#45;arrow m-dropdown&#45;&#45;align-right m-dropdown&#45;&#45;align-push" data-dropdown-toggle="hover" aria-expanded="true">
                          <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn&#45;&#45;icon m-btn&#45;&#45;icon-only m-btn&#45;&#45;pill  m-dropdown__toggle">
                            <i class="la la-ellipsis-h m&#45;&#45;font-brand"></i>
                          </a>
                          <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow&#45;&#45;right m-dropdown__arrow&#45;&#45;adjust"></span>
                            <div class="m-dropdown__inner">
                              <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                  <ul class="m-nav">
                                    <li class="m-nav__section m-nav__section&#45;&#45;first">
                                      <span class="m-nav__section-text"> Quick Actions </span>
                                    </li>
                                    <li class="m-nav__item">
                                      <a href="" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-share"></i>
                                        <span class="m-nav__link-text"> Create Post </span>
                                      </a>
                                    </li>
                                    <li class="m-nav__item">
                                      <a href="" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                        <span class="m-nav__link-text"> Send Messages </span>
                                      </a>
                                    </li>
                                    <li class="m-nav__item">
                                      <a href="" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                        <span class="m-nav__link-text"> Upload File </span>
                                      </a>
                                    </li>
                                    <li class="m-nav__section">
                                      <span class="m-nav__section-text"> Useful Links </span>
                                    </li>
                                    <li class="m-nav__item">
                                      <a href="" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-info"></i>
                                        <span class="m-nav__link-text"> FAQ </span>
                                      </a>
                                    </li>
                                    <li class="m-nav__item">
                                      <a href="" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                        <span class="m-nav__link-text"> Support </span>
                                      </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator&#45;&#45;fit m&#45;&#45;hide"></li>
                                    <li class="m-nav__item m&#45;&#45;hide">
                                      <a href="#" class="btn btn-outline-danger m-btn m-btn&#45;&#45;pill m-btn&#45;&#45;wide btn-sm"> Submit </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="m-portlet__body">
                  &lt;!&ndash;begin: Datatable &ndash;&gt;
                  <div class="m_datatable" id="m_datatable_latest_orders"></div>
                  &lt;!&ndash;end: Datatable &ndash;&gt;
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              &lt;!&ndash;begin:: Widgets/Audit Log&ndash;&gt;
              <div class="m-portlet m-portlet&#45;&#45;full-height  m-portlet&#45;&#45;rounded">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <h3 class="m-portlet__head-text"> Audit Log </h3>
                    </div>
                  </div>
                  <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills&#45;&#45;brand m-nav-pills&#45;&#45;align-right m-nav-pills&#45;&#45;btn-pill m-nav-pills&#45;&#45;btn-sm" role="tablist">
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab"> Today </a>
                      </li>
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab"> Week </a>
                      </li>
                      <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab3_content" role="tab"> Month </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="m-portlet__body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="m_widget4_tab1_content">
                      <div class="m-scrollable" data-scrollable="true" data-max-height="400" style="height: 400px; overflow: hidden;">
                        <div class="m-list-timeline m-list-timeline&#45;&#45;skin-light">
                          <div class="m-list-timeline__items">
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;success"></span>
                              <span class="m-list-timeline__text"> 12 new users registered </span>
                              <span class="m-list-timeline__time"> Just now </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;info"></span>
                              <span class="m-list-timeline__text"> System shutdown <span class="m-badge m-badge&#45;&#45;success m-badge&#45;&#45;wide"> pending </span>
                              </span>
                              <span class="m-list-timeline__time"> 14 mins </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;danger"></span>
                              <span class="m-list-timeline__text"> New invoice received </span>
                              <span class="m-list-timeline__time"> 20 mins </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;accent"></span>
                              <span class="m-list-timeline__text"> DB overloaded 80% <span class="m-badge m-badge&#45;&#45;info m-badge&#45;&#45;wide"> settled </span>
                              </span>
                              <span class="m-list-timeline__time"> 1 hr </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;warning"></span>
                              <span class="m-list-timeline__text"> System error - <a href="#" class="m-link"> Check </a>
                              </span>
                              <span class="m-list-timeline__time"> 2 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;brand"></span>
                              <span class="m-list-timeline__text"> Production server down </span>
                              <span class="m-list-timeline__time"> 3 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;info"></span>
                              <span class="m-list-timeline__text"> Production server up </span>
                              <span class="m-list-timeline__time"> 5 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;success"></span>
                              <span href="" class="m-list-timeline__text"> New order received <span class="m-badge m-badge&#45;&#45;danger m-badge&#45;&#45;wide"> urgent </span>
                              </span>
                              <span class="m-list-timeline__time"> 7 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;success"></span>
                              <span class="m-list-timeline__text"> 12 new users registered </span>
                              <span class="m-list-timeline__time"> Just now </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;info"></span>
                              <span class="m-list-timeline__text"> System shutdown <span class="m-badge m-badge&#45;&#45;success m-badge&#45;&#45;wide"> pending </span>
                              </span>
                              <span class="m-list-timeline__time"> 14 mins </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;danger"></span>
                              <span class="m-list-timeline__text"> New invoice received </span>
                              <span class="m-list-timeline__time"> 20 mins </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;accent"></span>
                              <span class="m-list-timeline__text"> DB overloaded 80% <span class="m-badge m-badge&#45;&#45;info m-badge&#45;&#45;wide"> settled </span>
                              </span>
                              <span class="m-list-timeline__time"> 1 hr </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;danger"></span>
                              <span class="m-list-timeline__text"> New invoice received </span>
                              <span class="m-list-timeline__time"> 20 mins </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;accent"></span>
                              <span class="m-list-timeline__text"> DB overloaded 80% <span class="m-badge m-badge&#45;&#45;info m-badge&#45;&#45;wide"> settled </span>
                              </span>
                              <span class="m-list-timeline__time"> 1 hr </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;warning"></span>
                              <span class="m-list-timeline__text"> System error - <a href="#" class="m-link"> Check </a>
                              </span>
                              <span class="m-list-timeline__time"> 2 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;brand"></span>
                              <span class="m-list-timeline__text"> Production server down </span>
                              <span class="m-list-timeline__time"> 3 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;info"></span>
                              <span class="m-list-timeline__text"> Production server up </span>
                              <span class="m-list-timeline__time"> 5 hrs </span>
                            </div>
                            <div class="m-list-timeline__item">
                              <span class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;success"></span>
                              <span href="" class="m-list-timeline__text"> New order received <span class="m-badge m-badge&#45;&#45;danger m-badge&#45;&#45;wide"> urgent </span>
                              </span>
                              <span class="m-list-timeline__time"> 7 hrs </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="m_widget4_tab2_content"></div>
                    <div class="tab-pane" id="m_widget4_tab3_content"></div>
                  </div>
                </div>
              </div>
              &lt;!&ndash;end:: Widgets/Audit Log&ndash;&gt;
            </div>
          </div>-->
          <!--End::Section-->
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
.pl-3, .px-3 {
    padding-left: 0 !important;
}
</style>
