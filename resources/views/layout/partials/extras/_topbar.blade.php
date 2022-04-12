{{-- Topbar --}}
<div class="topbar">

    {{-- Search --}}
    @if (config('layout.extras.search.display'))
        @if (config('layout.extras.search.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="mr-1 btn btn-icon btn-clean btn-lg" id="kt_quick_search_toggle">
                    {{ Metronic::getSVG("media/svg/icons/General/Search.svg", "svg-icon-xl svg-icon-primary") }}
                </div>
            </div>
        @else
            <div class="dropdown" id="kt_quick_search_toggle">
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="mr-1 btn btn-icon btn-clean btn-lg btn-dropdown">
                       {{ Metronic::getSVG("media/svg/icons/General/Search.svg", "svg-icon-xl svg-icon-primary") }}
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    @include('layout.partials.extras.dropdown._search-dropdown')
                </div>
            </div>
        @endif
    @endif

     {{--  Start SystemDev  --}}
     <div class="dropdown">
        {{-- Toggle --}}
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg pulse pulse-primary">
                {{ Metronic::getSVG("media/svg/icons/Tools/Tools.svg", "svg-icon-xl svg-icon-primary") }}
                <span class="pulse-ring"></span>
            </div>
        </div>

        {{-- Dropdown --}}
        <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
            <form>
                @include('layout.sysdev.dropdownmenu')
            </form>
        </div>
    </div>

     {{--  End SystemDev  --}}


     {{--  Start SystemAdministration  --}}
     <div class="dropdown">
        {{-- Toggle --}}
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg pulse pulse-primary">
                {{ Metronic::getSVG("media/svg/icons/Code/Settings4.svg", "svg-icon-xl svg-icon-primary") }}
                <span class="pulse-ring"></span>
            </div>
        </div>

        {{-- Dropdown --}}
        <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
            <form>
                @include('layout.sysadmin.dropdownmenu')
            </form>
        </div>
    </div>

     {{--  End SystemDev  --}}

    {{-- Notifications --}}
    @if (config('layout.extras.notifications.display'))
        @if (config('layout.extras.notifications.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="mr-1 btn btn-icon btn-clean btn-lg pulse pulse-primary" id="kt_quick_notifications_toggle">
                    {{ Metronic::getSVG("media/svg/icons/Code/Compiling.svg", "svg-icon-xl svg-icon-primary") }}
                    <span class="pulse-ring"></span>
                </div>
            </div>
        @else
            <div class="dropdown">
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg pulse pulse-primary">
                        {{ Metronic::getSVG("media/svg/icons/Code/Compiling.svg", "svg-icon-xl svg-icon-primary") }}
                        <span class="pulse-ring"></span>
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <form>
                        @include('layout.partials.extras.dropdown._notifications')
                    </form>
                </div>
            </div>
        @endif
    @endif

    {{-- Quick Actions --}}
    @if (config('layout.extras.quick-actions.display'))
        @if (config('layout.extras.quick-actions.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg" id="kt_quick_actions_toggle">
                    {{ Metronic::getSVG("media/svg/icons/Media/Equalizer.svg", "svg-icon-xl svg-icon-primary") }}
                </div>
            </div>
        @else
            <div class="dropdown">
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg">
                        {{ Metronic::getSVG("media/svg/icons/Media/Equalizer.svg", "svg-icon-xl svg-icon-primary") }}
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    @include('layout.partials.extras.dropdown._quick-actions')
                </div>
            </div>
        @endif
    @endif

    {{-- My Cart --}}
    @if (config('layout.extras.cart.display'))
        <div class="dropdown">
            {{-- Toggle --}}
            <div class="topbar-item"  data-toggle="dropdown" data-offset="10px,0px">
                <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg">
                    {{ Metronic::getSVG("media/svg/icons/Shopping/Cart3.svg", "svg-icon-xl svg-icon-primary") }}
                </div>
            </div>

            {{-- Dropdown --}}
            <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-xl dropdown-menu-anim-up">
                <form>
                    @include('layout.partials.extras.dropdown._cart')
                </form>
            </div>
        </div>
    @endif

    {{-- Quick panel --}}
    @if (config('layout.header.topbar.quick-panel.display'))
        <div class="topbar-item">
            <div class="mr-1 btn btn-icon btn-clean btn-lg" id="kt_quick_panel_toggle">
                {{ Metronic::getSVG("media/svg/icons/Layout/Layout-4-blocks.svg", "svg-icon-xl svg-icon-primary") }}
            </div>
        </div>
    @endif

    {{-- Languages --}}
    @if (config('layout.extras.languages.display'))
        <div class="dropdown">
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                <div class="mr-1 btn btn-icon btn-clean btn-dropdown btn-lg">
                    <img class="rounded-sm h-20px w-20px" src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt=""/>
                </div>
            </div>

            <div class="p-0 m-0 dropdown-menu dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                @include('layout.partials.extras.dropdown._languages')
            </div>
        </div>
    @endif

    {{-- User --}}
    @if (config('layout.extras.user.display'))
        @if (config('layout.extras.user.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="w-auto px-2 btn btn-icon btn-clean d-flex align-items-center btn-lg" id="kt_quick_user_toggle">
                    <span class="mr-1 text-muted font-weight-bold font-size-base d-none d-md-inline">Hi,</span>
                    <span class="mr-3 text-dark-50 font-weight-bolder font-size-base d-none d-md-inline">Sean</span>
                    <span class="symbol symbol-35 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                    </span>
                </div>
            </div>
        @else
            <div class="dropdown">
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="w-auto px-2 btn btn-icon btn-clean d-flex align-items-center btn-lg">
                        <span class="mr-1 text-muted font-weight-bold font-size-base d-none d-md-inline">Hi,</span>
                        <span class="mr-3 text-dark-50 font-weight-bolder font-size-base d-none d-md-inline">{{ Auth::user()->name }}</span>
                        <span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">{{ Auth::user()->name[0] }}</span>
                        </span>
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="p-0 m-0 dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    @include('layout.partials.extras.dropdown._user')
                </div>
            </div>
        @endif
    @endif
</div>
