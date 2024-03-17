<style>
.balance-container {
    margin: 40px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.balance-box {
    margin: 0px 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>

<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>USDT Transfer</h4>
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
        <div class="form-group">
            <label>Select Account *</label>
            <select class="form-control" name="account" required>
              <option value="balance">Balance</option>
              <option value="overdraft">Overdraft</option>
            </select>
        </div>
        <div class="form-group">
          <label>Wallet Adress *</label>
          <input type="text" maxlength="60" name="wallet" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Select Network *</label>
            <select class="form-control" name="network" required>
              <option value=""></option>
              <option value="ERC20">ERC20</option>
              <option value="TRC20">TRC20</option>
              <option value="BEP20">BEP20</option>
              <option value="TRC20">TRC20</option>
              <option value="EOS">EOS</option>
            </select>
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input type="number" maxlength="12" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Transaction Pin</label>
            <input type="text" maxlength="4" name="pin" placeholder="****" class="form-control" required>
        </div>
      <div class="card-footer text-left">
        <button class="btn btn-primary mr-1" type="submit">Send</button>
      </div>
    </div>
  </div>
</div>

<script>

</script>