<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Prices')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Prices')}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @if(auth()->user()->can('prices create'))
                            <a class="btn btn-primary float-end" data-bs-toggle="modal"
                               wire:click.prevent="CreatePrice" data-bs-target="#CreatePrice"
                               data-bs-original-title="" title=""> {{__('Create Price')}}</a>
                        @endif
                    </div>
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
                            <form class="col-md-12" wire:submit.prevent="search">
                                <div class="input-group mb-3 " style="justify-content: center">
                                    <div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select wire:model.deffer="bouquet_id"
                                                        class="form-control @error('bouquet_id') is-invalid @enderror">
                                                    <option value="0">{{__("Bouquet")}} ...</option>
                                                    @foreach($bouquets as $bouquet)
                                                        @if(($count = count(json_decode($bouquet->bouquet_channels))) > 0)
                                                            <option value="{{$bouquet->id}}">{{$bouquet->bouquet_name}} ({{$count}})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('bouquet_id')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>                                    </div>


                                    <div class="input-group-append ">
                                        <button wire:loading.attr="disabled" class="btn btn-block btn-primary btn-sm"
                                                type="submit"><i wire:loading
                                                                 class="fas fa-sync fa-spin"></i> {{__("Search")}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($prices->count() > 0)
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Bouquet")}}</th>
                                        <th>{{__("Price")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prices as  $key => $price)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$price->bouquet ? $price->bouquet->bouquet_name : ''}}</td>
                                            <td>{{$price->value}}</td>
                                            <td>

                                                @if(auth()->user()->can('prices edit'))
                                                    <a class="btn btn-primary btn-xs"
                                                       href="#" data-bs-toggle="modal" data-bs-target="#EditPrice"
                                                       wire:click="EditPrice({{$price->id}})"
                                                       title="{{__("Edit")}}"><i
                                                            class="fa fa-edit"></i> </a>
                                                @endif
                                                @if(auth()->user()->can('prices delete'))
                                                    <a class="btn btn-xs btn-danger" href="#"
                                                       wire:click.prevent="deleteId({{$price->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                       title="{{__("Delete")}}"><i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pt-2">
                                    {{$prices->links()}}
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
@if(auth()->user()->can('prices delete'))
    <!-- Modal deleteModal -->
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
             aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">{{__("Delete Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn"></span>
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
@endif
@if(auth()->user()->can('prices create'))
    <!--  Modal CreatePrice -->
        <div wire:ignore.self class="modal fade " id="CreatePrice" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Price Country') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>

                        @if($create_price)
                            @livewire('admin.prices.prices-create')
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreatePrice -->
@endif
@if(auth()->user()->can('prices edit'))
    <!--  Modal EditPrice -->
        <div wire:ignore.self class="modal fade " id="EditPrice" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Price') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @if($price_id)
                            @livewire('admin.prices.prices-edit',[$price_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditPrice -->

    @endif


</div>


