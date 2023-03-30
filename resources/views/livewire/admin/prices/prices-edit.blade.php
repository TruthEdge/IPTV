<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}


    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{__("Countries")}}</label>
                <select wire:model.deffer="price.bouquet_id"
                        class="form-control @error('price.bouquet_id') is-invalid @enderror">
                    <option value="0">{{__("Select")}} ...</option>
                    @foreach($bouquets as $bouquet)
                        @if(($count = count(json_decode($bouquet->bouquet_channels))) > 0)
                            <option value="{{$bouquet->id}}">{{$bouquet->bouquet_name}} ({{$count}})</option>
                        @endif
                    @endforeach
                </select>
                @error('price.bouquet_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ __('Value') }}</label>
                <input wire:model.defer="price.value" placeholder="0"
                       class="form-control @error('price.value') is-invalid @enderror" type="text">
                @error('price.value')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
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
        <button wire:loading.attr="disabled" class="btn btn-primary submit"
                type="submit">{{__("Update")}}</button>
    </div>
</form>



