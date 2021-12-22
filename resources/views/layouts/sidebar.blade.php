<div class="main-sidebar" style="overflow: auto;">
    <aside id="sidebar-wrapper  p-3">
        <div class="sidebar-brand">
            @if (Auth::user()->load('roles')->roles->contains('title', 'vehicle'))
                @if (Auth::user()->load('roles')->roles->contains('title', 'vehicle'))
                    @php
                        $vehicle = App\Models\Vehicle::where('user_id', auth()->user()->id)->first();
                    @endphp
                @endif
                <a href="{{ url('vehicle/vehicle_home') }}">
                    <img src="{{ $vehicle->vehicle_logo }}" class="rounded" width="150" height="150" alt="">
                </a>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ url('vehicle/vehicle_home') }}">
                        <img src="{{ $vehicle->vehicle_logo }}" class="rounded" width="20" height="20" alt="">
                    </a>
                </div>
            @endif

            @php
                $icon = App\Models\GeneralSetting::find(1)->company_black_logo;
            @endphp

            @if (Auth::user()->load('roles')->roles->contains('title', 'admin'))
                {{-- <div class="sidebar-brand"> --}}
                <a href="{{ url('admin/home') }}">
                    <img src="{{ url('images/upload/' . $icon) }}" width="150" height="150">
                </a>
                {{-- </div> --}}
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ url('admin/home') }}">
                        <img src="{{ url('images/upload/' . $icon) }}" width="20" height="20">
                    </a>
                </div>
            @endif
        </div>

        <ul class="sidebar-menu">
            @can('admin_dashboard')
                <li class="{{ $activePage == 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/home') }}">
                        <i class="fas fa-columns text-primary"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_dashboard')
                <li class="{{ $activePage == 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/vehicle_home') }}">
                        <i class="fas fa-columns text-warning"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicletype_access')
                <li class="{{ $activePage == 'vehicletype' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/vehicletype') }}">
                        <i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                        <span class="nav-link-text">{{ __('vehicletype') }}</span>
                    </a>
                </li>
            @endcan



            @can('admin_vehicle_access')
                <li class="{{ $activePage == 'vehicle' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/vehicle') }}">
                        <i class="fas fa-bicycle fa-lg"></i>
                        <span class="sr-only">Loading...</span>
                        <span class="nav-link-text">{{ __('vehicle') }}</span>
                    </a>
                </li>
            @endcan

            @can('delivery_zone_access')
                @if (Auth::user()->load('roles')->roles->contains('title', 'admin'))
                    <li class="{{ $activePage == 'delivery_zone' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/delivery_zone') }}">
                            <i class="fas fa-users text-success"></i><span>{{ __('Operating zone') }}</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->load('roles')->roles->contains('title', 'vehicle'))
                    @if (Session::get('vehicle_driver') == 1)
                        <li class="{{ $activePage == 'delivery_zone' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('vehicle/deliveryZone') }}">
                                <i class="fas fa-users text-success"></i><span>{{ __('Operating zone') }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endcan

            @can('order_access')
                <li class="{{ $activePage == 'order' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/order') }}">
                        <i class="fas fa-sort text-dark"></i>
                        <span>{{ __('Rides') }}</span>
                    </a>
                </li>
            @endcan

            @can('delivery_person_access')
                @if (Auth::user()->load('roles')->roles->contains('title', 'admin'))
                    <li class="{{ $activePage == 'delivery_person' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/delivery_person') }}">
                            <i class="fab fa-red-river text-danger"></i>
                            <span class="nav-link-text">{{ __('Fleet Operator') }}</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->load('roles')->roles->contains('title', 'vehicle'))
                    @if (Session::get('vehicle_driver') == 1)
                        <li class="{{ $activePage == 'delivery_person' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('vehicle/deliveryPerson') }}">
                                <i class="fab fa-red-river text-danger"></i>
                                <span class="nav-link-text">{{ __('Fleet Operator') }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endcan

            @can('livelocation')
                <li class="{{ $activePage == 'livelocation' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/livelocation') }}">
                        <i class="fas fa-tags text-info"></i>
                        <span class="nav-link-text">{{ __('Livelocation') }}</span>
                    </a>
                </li>
            @endcan


            @can('promo_code_access')
                <li class="{{ $activePage == 'promo_code' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/promo_code') }}">
                        <i class="fas fa-tags text-info"></i>
                        <span class="nav-link-text">{{ __('Promo code') }}</span>
                    </a>
                </li>
            @endcan

            @can('user_access')
                <li class="{{ $activePage == 'user' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/user') }}">
                        <i class="fas fa-users text-dark"></i>
                        <span class="nav-link-text">{{ __('user') }}</span>
                    </a>
                </li>
            @endcan

            @can('faq_access')
                <li class="{{ $activePage == 'faq' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/faq') }}">
                        <i class="far fa-address-card text-primary"></i>
                        <span class="nav-link-text">{{ __('FAQ') }}</span>
                    </a>
                </li>
            @endcan
            @can('admin_reports')
                <li
                    class="dropdown {{ $activePage == 'notification_template' ? 'active' : '' }} || {{ $activePage == 'send_notification' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link has-dropdown">
                        <i class="fas fa-address-card text-danger"></i>
                        <span>{{ __('Notifications') }}</span>
                    </a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li class="{{ $activePage == 'notification_template' ? 'active' : '' }}"><a
                                href="{{ url('admin/notification_template') }}">{{ __('Notification Template') }}</a>
                        </li>
                        <li class="{{ $activePage == 'send_notification' ? 'active' : '' }}"><a
                                href="{{ url('admin/send_notification') }}">{{ __('Send Notification') }}</a></li>
                    </ul>
                </li>
            @endcan

            @can('banner_access')
                <li class="{{ $activePage == 'banner' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/banner') }}">
                        <i class="fab fa-artstation text-info"></i>
                        <span class="nav-link-text">{{ __('Banner Management') }}</span>
                    </a>
                </li>
            @endcan

            @can('language_access')
                <li class="{{ $activePage == 'language' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/language') }}">
                        <i class="fas fa-language text-success"></i>
                        <span class="nav-link-text">{{ __('Language') }}</span>
                    </a>
                </li>
            @endcan

            @can('tax_access')
                <li class="{{ $activePage == 'tax' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/tax') }}">
                        <i class="fas fa-comments-dollar text-danger"></i>
                        <span>{{ __('Tax') }}</span>
                    </a>
                </li>
            @endcan

            @can('role_access')
                <li class="{{ $activePage == 'role' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/roles') }}">
                        <i class="fas fa-adjust"></i>
                        <span class="nav-link-text">{{ __('role and permissions') }}</span>
                    </a>
                </li>
            @endcan

            @can('feedback_support')
                <li class="{{ $activePage == 'feedback' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/feedback') }}">
                        <i class="fas fa-comment text-dark"></i>
                        <span class="nav-link-text">{{ __('Feedback and support') }}</span>
                    </a>
                </li>
            @endcan

            @can('admin_reports')
                <li
                    class="dropdown {{ $activePage == 'user_report' ? 'active' : '' }} || {{ $activePage == 'order_report' ? 'active' : '' }} || {{ $activePage == 'vehicle_report' ? 'active' : '' }} || {{ $activePage == 'driver_report' ? 'active' : '' }} || {{ $activePage == 'earning_report' ? 'active' : '' }} || {{ $activePage == 'wallet_transaction_report' ? 'active' : '' }} || {{ $activePage == 'deposit_report' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link has-dropdown">
                        <i class="fas fa-file-alt text-warning"></i>
                        <span>{{ __('Reports') }}</span>
                    </a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li class="{{ $activePage == 'user_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/user_report') }}">{{ __('User reports') }}</a></li>
                        <li class="{{ $activePage == 'order_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/order_report') }}">{{ __('Order reports') }}</a></li>
                        <li class="{{ $activePage == 'wallet_transaction_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/wallet_withdraw_report') }}">{{ __('Wallet withdraw reports') }}</a>
                        </li>
                        <li class="{{ $activePage == 'deposit_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/wallet_deposit_report') }}">{{ __('Wallet Deposit reports') }}</a>
                        </li>
                        <li class="{{ $activePage == 'vehicle_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/vehicle_report') }}">{{ __('Vehicle reports') }}</a></li>
                        <li class="{{ $activePage == 'vehicle_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/vehicle_report') }}">{{ __('Vehicle reports') }}</a></li>
                        <li class="{{ $activePage == 'driver_report' ? 'active' : '' }}"><a
                                href="{{ url('admin/driver_report') }}">{{ __('Delivery persons reports') }}</a></li>
                    </ul>
                </li>
            @endcan

            @can('refund_access')
                <li class="{{ $activePage == 'refund' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/refund') }}">
                        <i class="fas fa-shekel-sign text-danger"></i>
                        <span>{{ __('Refund') }}</span>
                    </a>
                </li>
            @endcan

            @can('admin_setting')
                <li class="{{ $activePage == 'setting' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('admin/setting') }}">
                        <i class="fas fa-cog text-success"></i>
                        <span class="nav-link-text">{{ __('setting') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_order_access')
                <li class="{{ $activePage == 'order' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/Orders') }}">
                        <i class="fas fa-sort text-info"></i>
                        <span>{{ __('Order') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_menu_access')
                <li class="{{ $activePage == 'vehicle_menu' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/vehicle_menu/') }}">
                        <i class="fas fa-bars  "></i>
                        <span>{{ __('Menu Category') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_reviews')
                <li class="{{ $activePage == 'rattings' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/rattings') }}">
                        <i class="fas fa-star text-danger"></i>
                        <span>{{ __('Reviews and ratings') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_discount_access')
                <li class="{{ $activePage == 'vehicle_discount' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/vehicle_discount') }}">
                        <i class="fas fa-tags text-dark"></i>
                        <span>{{ __('Vehicle discount') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_financeDetails')
                <li class="{{ $activePage == 'finance_details' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/vehicle/vehicle_finance_details') }}">
                        <i class="fas fa-wallet text-info"></i>
                        <span>{{ __('Finance Details') }}</span>
                    </a>
                </li>
            @endcan

            @can('vehicle_reports')
                <li
                    class="dropdown {{ $activePage == 'user_report' ? 'active' : '' }} || {{ $activePage == 'order_report' ? 'active' : '' }} || {{ $activePage == 'vehicle_report' ? 'active' : '' }} || {{ $activePage == 'driver_report' ? 'active' : '' }} || {{ $activePage == 'earning_report' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link has-dropdown">
                        <i class="fas fa-file-alt"></i>
                        <span>{{ __('Reports') }}</span>
                    </a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li class="{{ $activePage == 'user_report' ? 'active' : '' }}"><a
                                href="{{ url('vehicle/user_report') }}">{{ __('User reports') }}</a></li>
                        <li class="{{ $activePage == 'order_report' ? 'active' : '' }}"><a
                                href="{{ url('vehicle/order_report') }}">{{ __('Order reports') }}</a></li>
                    </ul>
                </li>
            @endcan

            @can('vehicle_bank_details')
                <li class="{{ $activePage == 'bank_details' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('vehicle/bank_details/') }}">
                        <i class="fas fa-money-check-alt text-warning"></i>
                        <span>{{ __('Bank details') }}</span>
                    </a>
                </li>
            @endcan

            @if (Gate::check('vehicle_deliveryTimeslots') || Gate::check('vehicle_pickupTimeslots') || Gate::check('vehicle_sellingTimeslots'))
                <li
                    class="dropdown {{ $activePage == 'delivery_timeslot' ? 'active' : '' }} || {{ $activePage == 'pickup_timeslot' ? 'active' : '' }} || {{ $activePage == 'selling_timeslot' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link has-dropdown">
                        <i class="fas fa-ellipsis-h text-dark"></i>
                        <span>{{ __('Timeslots') }}</span>
                    </a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li class="{{ $activePage == 'delivery_timeslot' ? 'active' : '' }}"><a
                                href="{{ url('vehicle/vehicle/delivery_timeslot') }}">{{ __('delivery timeslots') }}</a>
                        </li>
                        <li class="{{ $activePage == 'pickup_timeslot' ? 'active' : '' }}"><a
                                href="{{ url('vehicle/vehicle/pickup_timeslot') }}">{{ __('Pick up timeslots') }}</a>
                        </li>
                        <li class="{{ $activePage == 'selling_timeslot' ? 'active' : '' }}"><a
                                href="{{ url('vehicle/vehicle/selling_timeslot') }}">{{ __('selling timeslots') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </aside>
</div>
