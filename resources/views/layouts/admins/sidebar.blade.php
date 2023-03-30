<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="{{route('admin.settings')}}"><i
                data-feather="settings"></i></a><img class="img-90 rounded-circle"
                                                     src="{{ auth()->user()->image ? auth()->user()->image : url('dashboard/images/1.png') }}"
                                                     alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="#">
            <h6 class="mt-3 f-14 f-w-600">{{auth()->user()->name}}</h6>
        </a>
        <p class="mb-0 font-roboto">{{auth()->user()->email }}</p>
        <div class="badge bg-success">Credit: {{auth()->user()->credits }}</div>
        <div class="badge btn-primary">Balance: {{auth()->user()->balance }}</div>

    </div>
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">

                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    <li class="dropdown mb-2">
                        <a class="nav-link menu-title link-nav {{request()->is('admin') ? 'active' : ''}}"
                           href="{{route('admin.home')}}">
                            <i data-feather="home"></i>
                            <span>{{__('Home')}}</span>
                        </a>
                    </li>

                    @if(auth()->user()->can('users show') )
                        <li class="dropdown mb-2">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/users') ? 'active' : ''}} "
                               href="{{route('admin.users')}}">
                                <i data-feather="users"></i>
                                <span>{{__("Users")}}</span>
                                <span
                                    class="badge badge-primary float-end mt-1">{{App\Models\User::whereNull('deleted_at')->count()}}</span>

                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('accounts show') )
                        <li class="dropdown mb-2">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/accounts') ? 'active' : ''}} "
                               href="{{route('admin.accounts')}}">
                                <i data-feather="airplay"></i>
                                <span>{{__("Accounts")}}</span>
                                <span
                                    class="badge badge-primary float-end mt-1">{{App\Models\Account::whereIn('id', App\Models\AccountUser::where('user_id',auth()->id())->pluck('account_id')->toArray())->count()}}</span>
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->can('roles show') )
                        <li class="dropdown mb-2">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/roles') ? 'active' : ''}} "
                               href="{{route('admin.roles')}}">
                                <i data-feather="lock"></i>
                                <span>{{__("Roles")}}</span>
                                <span
                                    class="badge badge-primary float-end mt-1">{{\Spatie\Permission\Models\Role::count()}}</span>

                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->can('transactions show') )
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/transactions') ? 'active' : ''}} "
                               href="{{route('admin.transactions')}}">
                                <i data-feather="clipboard"></i>
                                <span>{{__("Transactions")}}</span>
                                <span class="badge badge-danger float-end mt-1">
                                    @if(auth()->user()->hasRole('Admin'))
                                        {{App\Models\Transaction::whereNull('deleted_at')->count()}}
                                    @else
                                        {{App\Models\Transaction::where('user_id',auth()->id())->whereNull('deleted_at')->count()}}
                                    @endif
                                </span>
                            </a>
                        </li>
                    @endif


                    @if(auth()->user()->can('vouchers show') )
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/vouchers') ? 'active' : ''}} "
                               href="{{route('admin.vouchers')}}">
                                <i data-feather="clipboard"></i>
                                <span>{{__("Vouchers")}}</span>
                                <span class="badge badge-danger float-end mt-1">
                                    @if(auth()->user()->hasRole('Admin'))
                                        {{App\Models\Voucher::whereNull('deleted_at')->count()}}
                                    @else
                                        {{App\Models\Voucher::where('user_id',auth()->id())->whereNull('deleted_at')->count()}}
                                    @endif
                                </span>
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->can('settings show') )
                        <li class="dropdown mb-2">
                            <a class="nav-link menu-title link-nav {{request()->is('admin/settings') ? 'active' : ''}} "
                               href="{{route('admin.settings')}}">
                                <i data-feather="settings"></i>
                                <span>{{__("Settings")}}</span>
                            </a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </nav>
</header>
