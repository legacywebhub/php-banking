<style>
.card-body {
    width: 100%;
    padding: 40px 20px !important;
    font-size: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.card-body P {
    font-size: 16px;
    white-space: pre-wrap;
}
input[type="file"] {
    padding: 5px 10px;
    border: 1px solid rgba(0, 0, 255, 0.6);
}
@media screen and (max-width: 500px) {
    .card-body p, .input-group input[type='file'] {
        font-size: 14px;
        width: 100%;
    }
    .input-group {
        width: 90%;
    }
    .input-group input {
        width: 50%;
    }
    input[type="file"], input[type="text"]  {
        font-size: 14px;
    }
}
</style>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card card-primary">
      <div class="card-body">
       <div>
        <p><b>You are about to make funding of <?=$context['user']['currency'].$context['payment']['amount']; ?> using your selected payment method</b></p>
        <P>For quicker approval, screenshot and upload the proof of payment</P>
        <p>Copy the <b class="text-lowercase"><?=$context['payment']['method']; ?></b> address below and proceed to make payment</p>
        <div class="input-group">
            <input type="text" id="wallet-address" readonly class="form-control file-upload-info bg-primary text-light" value="<?=$context['payment']['payment_address']; ?>">
            <span class="input-group-append">
                <button class="file-upload-browse btn btn-secondary copy-button" type="button"><i class="fas fa-copy"></i></button>
            </span>
        </div>
        <p><small>Network type: <?=$context['payment']['payment_network']; ?></small></p>
        <p>Or scan the QR code below</p>
        <div id="qrcode"></div><br>
        <p>Upload payment proof after payment</p>
        <form class="forms-sample" enctype="multipart/form-data" method="post" autocomplete="off">
        <div class="input-group">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <input type="hidden" name="payment_id" value="<?=$context['payment']['payment_id']; ?>">
            <input type="file" name="payment_proof" accept=".jpeg, .jpg, .png" required>
        </div><small class="text-danger">Accepted file types are jpeg, jpg and png only</small><br><br>
        <?php if (isset($_SESSION['message'])): ?>
        <h5 class="text-<?=$_SESSION['message_tag']; ?>"><?=$_SESSION['message']; ?></h5><br>
        <?php endif ?>
        <button name="complete-payment" class="btn btn-primary btn-lg">Submit</button>
        </form>
       </div>
      </div>
    </div>
  </div>
</div>

<!-- QRCode js Library -->
<script src="<?=STATIC_ROOT; ?>/dashboard/js/qrcode.min.js"></script>

<script>
let walletAddress = document.querySelector('#wallet-address'),
  copyBtn = document.querySelector('.copy-button');

copyBtn.addEventListener('click', ()=>{copyText(walletAddress)});
</script>

<script>
// Create a QR code instance with the text
const qrCode = new QRCode(document.getElementById("qrcode"), {
  text: "<?=$context['payment']['payment_address']; ?>",
  width: 200,
  height: 200,
});
</script>