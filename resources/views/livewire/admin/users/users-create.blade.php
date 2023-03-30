<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">


            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card d-table p-1 m-auto">
                            @if($imageTemp)
                                <img width="150" class="img-fluid rounded"
                                     src="{{ $imageTemp->temporaryUrl() }}"
                                     data-holder-rendered="true">

                            @else
                                <img width="200" class="rounded-circle img-thumbnail img-fluid"
                                     src="{{ empty(['image']) ? url(empty(['image'])) : url('dashboard/images/1.png')}}"
                                     data-holder-rendered="true">
                            @endif
                        </div>

                        <div class="d-table p-1 m-auto uniform-uploader">
                            <input type="file" wire:model.defer="imageTemp"
                                   class="form-input-styled form-control @error('imageTemp ') is-invalid @enderror"
                                   data-fouc=""
                            >
                            @error('imageTemp')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <input value="" wire:model.defer="user.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('user.name') is-invalid @enderror" type="text">
                        @error('user.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Mobile")}}</label>
                        <input wire:model.defer="user.mobile" placeholder="{{__("Add Mobile")}}"

                               class="form-control @error('user.mobile') is-invalid @enderror" type="number">
                        @error('user.mobile')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Email")}}</label>
                        <input wire:model.defer="user.email" placeholder="{{__("Add Email")}}شسي" class="form-control @error('user.email') is-invalid @enderror" type="email">
                        @error('user.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Password")}} </label>
                        <input value="" wire:model.defer="user.password" placeholder="{{__("Add Password")}}"

                               class="form-control @error('user.password') is-invalid @enderror" type="password">
                        @error('user.password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
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


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("birth_date")}}</label>
                        <input value="" wire:model.defer="user.birth_date"
                               class="form-control @error('user.birth_date') is-invalid @enderror" type="date">

                        @error('user.birth_date')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Role")}}</label>
                        <select wire:model.deffer="user.role_id"
                                class="form-control @error('user.role_id') is-invalid @enderror">
                            <option value="0">{{__("Select Role")}} ...</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('user.role_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Status")}}</label>
                        <select wire:model.defer="user.status"
                                class="form-control @error('user.status') is-invalid @enderror">
                            <option value="0">{{__("Select Status")}} ...</option>
                            @foreach(\App\Models\User::statusList(false) as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('user.status')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>
    <div>
        <button wire:loading.attr="disabled" class="btn btn-primary"
                type="submit">{{__("Store")}}</button>
    </div>
</form>

