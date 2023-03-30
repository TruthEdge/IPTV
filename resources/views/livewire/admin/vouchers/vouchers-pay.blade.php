<form class="mt-2 w-100" method="post" wire:submit.prevent="pay">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Add Money By Voucher Code")}}</label>
                        <input wire:model.defer="voucher.code" placeholder="{{__("Code")}}"
                               class="form-control @error('voucher.code') is-invalid @enderror" type="text">
                        @error('voucher.code')
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
        <button wire:loading.attr="disabled" class="btn btn-primary w-75 rounded-pill submit"
                type="submit">{{__("Pay")}}</button>
    </div>
</form>
