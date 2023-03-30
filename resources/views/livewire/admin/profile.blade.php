<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('Profile')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}"> {{__('Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Profile')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
        <div class="container-fluid">

            @include('layouts.admins.alert')


            <div class="row">
                <div class="col-md-6">
                    <div class="card card-secondary ">
                        <div class="card-header">
                            <h3 class="card-title">{{__('Profile')}}</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form class="mt-2" method="post" wire:submit.prevent="update">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Name")}}</label>
                                            <input value="" wire:model.lazy="user.name" placeholder="{{__("Add Name")}}"
                                                   name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   type="text">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Email")}}</label>
                                            <input value="" wire:model.lazy="user.email" placeholder="{{__("Add Email")}}"
                                                   name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   type="text">
                                            @error('email')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("gender")}}</label>
                                            <select wire:model.defer="user.gender"
                                                    class="form-control @error('user.gender') is-invalid @enderror">
                                                <option value="0">{{__("Select Gender")}} ...</option>
                                                @foreach(\App\Models\User::gender(false) as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('user.gender')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Mobile")}}</label>
                                            <input wire:model.lazy="user.mobile" placeholder="{{__("Add Mobile")}}"

                                                   class="form-control @error('mobile') is-invalid @enderror" type="text">
                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("id_number")}}</label>
                                            <input wire:model.defer="user.id_number" placeholder="{{__("Add id_number")}}"
                                                   class="form-control @error('user.id_number') is-invalid @enderror" type="text">
                                            @error('user.id_number')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("weight")}}</label>
                                            <input wire:model.defer="user.weight" placeholder="{{__("Add weight")}}"
                                                   class="form-control @error('user.weight') is-invalid @enderror" type="text">
                                            @error('user.weight')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror

                                        </div>
                                    </div>





                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("nationality")}}</label>
                                            <input wire:model.defer="user.nationality" placeholder="{{__("Add nationality")}}"
                                                   class="form-control @error('user.nationality') is-invalid @enderror" type="text">
                                            @error('user.nationality')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("birth_date")}}</label>
                                            <input value="" wire:model.defer="user.birth_date" class="form-control @error('user.birth_date') is-invalid @enderror" type="date">

                                            @error('user.birth_date')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>

                                <div class="row">

{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="card d-table p-1 m-auto">--}}
{{--                                                @if($logoTemp)--}}
{{--                                                    <img width="150" class="img-fluid rounded"--}}
{{--                                                         src="{{ $logoTemp->temporaryUrl() }}"--}}
{{--                                                         data-holder-rendered="true">--}}

{{--                                                @else--}}
{{--                                                    <img width="200" class="img-fluid rounded"--}}
{{--                                                         src="{{ $logo ? url($logo) : url('dashboard/images/image1.png')}}"--}}
{{--                                                         data-holder-rendered="true">--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                            <div class="d-table p-1 m-auto uniform-uploader">--}}
{{--                                                <input type="file" wire:model.lazy="logoTemp"--}}
{{--                                                       class="form-input-styled form-control @error('logoTemp ') is-invalid @enderror"--}}
{{--                                                       data-fouc=""--}}
{{--                                                >--}}
{{--                                                <span class="filename" >{{__("File Image ")}}</span>--}}
{{--                                                @error('logoTemp')--}}
{{--                                                <span class="invalid-feedback"--}}
{{--                                                      role="alert"><strong>{{ $message }}</strong></span>--}}
{{--                                                @enderror--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block">{{__("Update")}}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>


</div>


