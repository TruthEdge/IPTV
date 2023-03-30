<div style="display: contents">
    <!-- Page header -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Accounts')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Accounts')}}</li>
                        </ol>
                    </div>
                    @if(auth()->user()->can('accounts create') )
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#CreateAccount"
                               wire:click.prevent="CreateAccount" data-bs-original-title=""
                               title=""> {{__('Create Account')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
        <div class="container-fluid">

            @include('layouts.admins.alert')


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{--                            <form class="col-md-12" wire:submit.prevent="search">--}}
                            {{--                                <div class="input-group mb-3 " style="justify-content: center">--}}
                            {{--                                    <div>--}}
                            {{--                                        <input type="text" class="form-control form-control-sm"--}}
                            {{--                                               style="border-radius: .1875rem !important; margin-left: 10px !important"--}}
                            {{--                                               placeholder="{{__("First Name")}}" wire:model.defer="name">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div>--}}
                            {{--                                        <input type="text" class="form-control form-control-sm"--}}
                            {{--                                               style="border-radius: .1875rem !important; margin-left: 10px !important"--}}
                            {{--                                               placeholder="{{__("Email")}}" wire:model.defer="email">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div>--}}
                            {{--                                        <input type="text" class="form-control form-control-sm"--}}
                            {{--                                               style="border-radius: .1875rem !important; margin-left: 10px !important"--}}
                            {{--                                               placeholder="{{__("Mobile")}}" wire:model.defer="mobile">--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="input-group-append ">--}}
                            {{--                                        <button wire:loading.attr="disabled" class="btn btn-block btn-primary btn-sm"--}}
                            {{--                                                type="submit"><i wire:loading--}}
                            {{--                                                                 class="fas fa-sync fa-spin"></i> {{__("Search")}}--}}
                            {{--                                        </button>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </form>--}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($accounts->count() > 0)
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("username")}}</th>
                                        <th>{{__("exp_date")}}</th>
                                        <th>{{__("bouquet")}}</th>
                                        <th>{{__("output")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accounts as $key => $account)
                                        <tr>
                                            <td>{{ $key + $accounts->firstItem() }}</td>
                                            <td>{{$account->username}}</td>
                                            <td>{{ $account->exp_date ? date("Y-m-d H:i:s",$account->exp_date) : "Unlimited"}}</td>
                                            <td>{{\App\Models\Bouquet::whereIn('id',json_decode($account->bouquet))->count()}}</td>
                                            <td>{{$account->output}}</td>
                                            <td>
                                                @if(auth()->user()->can('accounts edit') )
                                                    <a class="btn btn-primary btn-xs"
                                                       href="#" data-bs-toggle="modal" data-bs-target="#EditAccount"
                                                       wire:click="EditAccount({{$account->id}})"
                                                       title="{{__("Edit")}}"><i
                                                            class="fa fa-edit"></i> </a>
                                                @endif

                                                @if(auth()->user()->can('accounts delete') )
                                                    <a class="btn btn-xs btn-danger"
                                                       href="#"
                                                       wire:click.prevent="deleteId({{$account->id}})"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#deleteModal"
                                                       title="{{__("Delete")}}"><i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pt-2">
                                    {{$accounts->links()}}
                                </div>

                            @else
                                <div class="alert alert-danger m-4">{{__("Empty list")}}</div>
                            @endif
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal deleteModal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{__("Delete Confirm")}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__("Are you sure want to delete?")}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"
                            data-bs-dismiss="modal">{{__("Close")}}</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                            data-bs-dismiss="modal">{{__("Yes, Delete")}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal deleteModal -->

    <!--  Modal CreateAccount -->
    <div wire:ignore.self class="modal fade " id="CreateAccount" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{__("Loading please wait")}} ...
                        </div>
                    </div>
                    @if($create_account)
                        @livewire('admin.accounts.accounts-create',[$account_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal CreateAccount -->

    <!--  Modal -->
    <div wire:ignore.self class="modal fade " id="EditAccount" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div wire:loading>
                            <i class="fas fa-sync fa-spin"></i>
                            {{__("Loading please wait")}} ...
                        </div>
                    </div>
                    @if($account_id)
                        @livewire('admin.accounts.accounts-edit',[$account_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--  Modal -->


</div>

