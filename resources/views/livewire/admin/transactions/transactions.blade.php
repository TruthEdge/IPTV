<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Transactions')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item active">{{__('Transactions')}}</li>
                        </ol>
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
                            {{--                            <form class="col-md-12" wire:submit.prevent="search">--}}
                            {{--                                <div class="input-group mb-3 " style="justify-content: center">--}}
                            {{--                                    <div>--}}
                            {{--                                        <div class="col-md-12">--}}
                            {{--                                            <div class="form-group">--}}
                            {{--                                                <select wire:model.deffer="bouquet_id"--}}
                            {{--                                                        class="form-control @error('bouquet_id') is-invalid @enderror">--}}
                            {{--                                                    <option value="0">{{__("Bouquet")}} ...</option>--}}
                            {{--                                                    @foreach($bouquets as $bouquet)--}}
                            {{--                                                        @if(($count = count(json_decode($bouquet->bouquet_channels))) > 0)--}}
                            {{--                                                            <option value="{{$bouquet->id}}">{{$bouquet->bouquet_name}} ({{$count}})</option>--}}
                            {{--                                                        @endif--}}
                            {{--                                                    @endforeach--}}
                            {{--                                                </select>--}}
                            {{--                                                @error('bouquet_id')--}}
                            {{--                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
                            {{--                                                @enderror--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>                                    --}}
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
                            @if($transactions->count() > 0)
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("Bouquet")}}</th>
                                        <th>{{__("Transaction")}}</th>
                                        <th width="300">{{__("Action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as  $key => $transaction)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$transaction->user ? $transaction->user->name : 'empty'}}</td>
                                            <td>{{$transaction->account ? $transaction->account->name : 'empty'}}</td>
                                            <td>{{$transaction->credits}}</td>
                                            <td>{{$transaction->last_credits}}</td>
                                            <td>{{$transaction->new_credits}}</td>
                                            <td>{{$transaction->description}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pt-2">
                                    {{$transactions->links()}}
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
</div>


