<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Logo" src="{{ asset('assets/image/Driveluxe_Logo_White_Update2022_300dpi_Transparent.png') }}" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/image/Driveluxe_Logo_Black_Update2022_300dpi_Transparent.png') }}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3"
                 data-kt-scroll="true"
                 data-kt-scroll-activate="true"
                 data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu"
                 data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true">

                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                     id="kt_app_sidebar_menu"
                     data-kt-menu="true">

                    <!-- Users Section -->
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion {{ request()->routeIs('admin.user') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-11 fs-2"></i>
                        </span>
                        <span class="menu-title">Users</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion {{ request()->routeIs('admin.user') ? 'show' : '' }}">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.user') ? 'active' : '' }}"
                                   href="{{ route('admin.user') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Manage Users</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Vehicle</span>
                        </div>
                    </div>

                    <!-- Vehicle Section -->
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-address-book fs-2"></i>
                        </span>
                        <span class="menu-title">Vehicle</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion ">
                            <div class="menu-item">
                                <a class="menu-link "
                                   href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Locations</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link "
                                   href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Category</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.vehicle*') ? 'active' : '' }}"
                                   href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Vehicles</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Packages & Extra Section -->
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion ">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-menu fs-2"></i>
                        </span>
                        <span class="menu-title">Packages & Extra</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion ">
                            <div class="menu-item">
                                <a class="menu-link "
                                   href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Protection Package</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link "
                                   href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Extras</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Dropbox Section -->
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion ">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-menu fs-2"></i>
                        </span>
                        <span class="menu-title">Dropbox</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <div class="menu-sub menu-sub-accordion ">
                            <div class="menu-item">
                                <a class="menu-link "
                                   href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Overview</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Domain Section -->
                    <div data-kt-menu-trigger="click"
                         class="menu-item">
                            <a class="menu-link "
                               href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Domain</span>
                            </a>
                        <a class="menu-link "
                           href="">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                            <span class="menu-title">Promocode</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--end::sidebar menu-->
</div>
<!--end::Sidebar-->
