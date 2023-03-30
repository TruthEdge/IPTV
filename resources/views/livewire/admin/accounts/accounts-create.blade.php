<form class="mt-2" method="post" wire:submit.prevent="store" autocomplete="off">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Username') }}</label>
                        <input autocomplete="off" wire:model="account.username" placeholder="{{ __('Username') }}"
                               class="form-control @error('account.username') is-invalid @enderror" type="text">
                        @error('account.username')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Password') }}</label>
                        <input autocomplete="off" wire:model="account.password" placeholder="{{ __('Password') }}"
                               class="form-control @error('account.password') is-invalid @enderror" type="password">
                        @error('account.password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit-account-is_trial" class="control-label">{{ __('Is trial') }}</label>
                        <input id="edit-account-is_trial" wire:model="account.is_trial"
                               placeholder="{{ __('Is trial') }}"
                               class="@error('account.is_trial') is-invalid @enderror" type="checkbox">
                        @error('account.is_trial')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        @if($account['is_trial'] === false)
                            <select wire:model="account.duration" class="form-control @error('account.duration') is-invalid @enderror">
                                <option value="1">{{__("Monthly")}}</option>
                                <option value="3">{{__("3 Months")}}</option>
                                <option value="6">{{__("6 Months")}}</option>
                                <option value="12">{{__("12 Months")}}</option>
                                <option value="24">{{__("24 Months")}}</option>
                            </select>
                            @error('account.duration')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Bouquet') }}</label>
                        <select wire:model="account.bouquet" multiple
                                class="form-control @error('account.bouquet') is-invalid @enderror">
                            @foreach(\App\Models\Bouquet::get() as $bouquet)
                                @if(($count = count(json_decode($bouquet->bouquet_channels))) > 0)
                                    <option value="{{$bouquet->id}}">{{$bouquet->bouquet_name}} (Channels:{{$count}})
                                        (Credit:{{\App\Models\Price::where('bouquet_id',$bouquet->id)->value('value')}})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('account.bouquet')
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
        <div class="alert alert-success"> {{$price}}</div>
        <button wire:loading.attr="disabled" class="btn btn-info"
                type="submit">{{__("Store")}}</button>
    </div>
</form>

