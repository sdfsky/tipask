<div class="modal fade in" id="payment-qrcode-modal-{{ $source_id }}" tabindex="-1" role="" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="exampleModalLabel">
                    <img class="avatar-64" src="{{ get_user_avatar($paymentUser->id) }}" alt="{{ $paymentUser->name }}"></a>
                </h4>
            </div>

            <div class="modal-body text-center">
                <p class="text-md">{{ $message }}</p>
                <img class="payment-qrcode" src="{{ route('website.image.show',['image_name'=>$paymentUser->qrcode]) }}" alt="" style="height:300px"><hr>
            </div>

        </div>
    </div>
</div>