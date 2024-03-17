<div class="section-body">
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>International Transfer</h4>
        </div>
        <div class="card-body">
          <div class="balance-container">
              <div class="balance-box">
                  <span><i class="fa fa-circle text-success"></i> Main Balance</span>
                  <span><b>$0</b></span>
              </div>
              <div class="balance-box">
                  <span><i class="fa fa-circle text-secondary"></i> Overdraft</span>
                  <span><b>$0</b></span>
              </div>
          </div>
          <form class="transfer-form" method="post">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="form-group">
              <label>Select Account *</label>
              <select class="form-control" name="account" required>
                <option value="balance">Balance</option>
                <option value="balance">Overdraft</option>
              </select>
            </div>
            <div class="form-group">
              <label>Bank Name *</label>
              <input type="text" name="bank-name" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group">
              <label>Swift Code *</label>
              <input type="text" name="swift-code" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group">
              <label>IBAN Code *</label>
              <input type="text" name="iban-code" class="form-control" maxlength="60" required>
            </div>
            <div class="form-group">
              <label>Account Number *</label>
              <input type="text" name="account-number" class="form-control" placeholder="51***910"  maxlength="15" onkeypress="return onlyNumberKey(event)" required>
              <div id="validate-div">&nbsp;&nbsp;Validating..</div>
            </div>
            <div class="form-group">
              <label>Amount (<?=$context['user']['currency']; ?>) *</label>
              <input type="text" name="amount" class="form-control" maxlength="10" onkeypress="return onlyNumberKey(event)" required>
            </div>
            <div class="form-group">
              <label>Remark</label>
              <textarea class="form-control" maxlength="255" name="remark" placeholder="(Optional)"></textarea>
            </div>
            <div class="form-group">
              <label>Transaction Pin</label>
              <input type="text" name="pin"  maxlength="4" placeholder="****" class="form-control" onkeypress="return onlyNumberKey(event)" required>
            </div>
            <div class="card-footer text-left">
              <button class="btn btn-primary mr-1" type="submit"><span class="btn-text">Send</span></button>
            </div>
          </form>
      </div>
  </div>
</div>

<script>
// Variables
let transferForm = document.querySelector('.transfer-form'),
  transferBtn = transferForm.querySelector('.btn'),
  btnText = transferBtn.querySelector('.btn-text');

// Event Listeners
transferForm.addEventListener('submit', (e)=>{
  e.preventDefault()

  // Loading animation
  btnText.innerHTML = `Please wait..<img width='20' src="<?=STATIC_ROOT; ?>/dashboard/img/spinner-white.svg">`;
  transferBtn.disabled = true;

  setTimeout(()=>{
    btnText.innerHTML = `Send`;
    transferBtn.disabled = false;
    swal("Service not available at the moment", {icon: 'warning'});
  }, 5000)
}) 
</script>