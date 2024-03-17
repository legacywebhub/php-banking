<style>
.board {
  width: 100%;
  height: 60vh;
  border-radius: 30px;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: left top;
  position: relative;
}
.board img {
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  width: 100%;
  height: 70%;
  position: absolute;
  top: 0;
  right: 0;
}
.greetings {
  color: #6d83f6;
  position: absolute;
  top: 20px;
  left: 25px;
}
.balance {
  position: absolute;
  bottom: 30px;
  left: 25px;
}
.action-buttons {
  position: absolute;
  bottom: 50px;
  right: 25px;
}
.batch, .status {
  font-size: 5px !important;
}
</style>


<div class="card author-box card-primary">
  <div class="board">
    <img src="<?=STATIC_ROOT; ?>/dashboard/img/banner/dashboard-banner.png" alt="">
    <div class="greetings">
      <h5>Welcome Back !</h5>
      <p><?=$context['user']['fullname']; ?></p>
    </div>
    <div class="balance">
      <h6>Account Balance</h6>
      <h5><?=$context['user']['currency'].$context['user']['balance']; ?></h5>
    </div>
    <div class="action-buttons">
      <a href="transactions" class="btn btn-sm btn-icon icon-left btn-primary"><i class="fas fa-bars"></i> Transactions</a>
      <a href="fund-account" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-donate"></i> Fund Account</a>
    </div>
  </div>
</div>



<div class="row ">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="mt-4 font-15">Account Balance</h5>
                  <h4 class="mt-2"><?=$context['user']['currency'].$context['user']['balance']; ?></h4>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="<?=STATIC_ROOT; ?>/dashboard/img/banner/icon-wallet.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="mt-4 font-15">Overdraft</h5>
                  <h4 class="mt-2"><?=$context['user']['currency'].$context['user']['overdraft']; ?></h4>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="<?=STATIC_ROOT; ?>/dashboard/img/banner/icon-bank.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="mt-4 font-15">Account Number</h5>
                  <h4 class="mt-2"><?=$context['user']['account_number']; ?></h4>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="<?=STATIC_ROOT; ?>/dashboard/img/banner/1.png" width="80">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="mt-4 font-15">Account Type</h5>
                  <h4 class="mt-2"><?=$context['user']['account_type']; ?></h4>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="<?=STATIC_ROOT; ?>/dashboard/img/banner/4.png" width="80">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Recent Bank Transactions</h4>
        </div>
        <div class="card-body p-0">
          <?php if($context['recent_transactions']): ?>
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th class="text-center">
                  <div class="custom-checkbox custom-checkbox-table custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                      class="custom-control-input" id="checkbox-all">
                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                  </div>
                </th>
                <th>Date/Time</th>
                <th>Amount</th>
                <th>Transaction Type</th>
                <th>Client</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php foreach($context['recent_transactions'] as $transaction): ?>
              <tr>
                <td class="p-0 text-center">
                  <div class="custom-checkbox custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                      id="checkbox-1">
                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                  </div>
                </td>
                <td><?=format_datetime_timezone($transaction['date'], $context['user']['timezone']); ?></td>
                <td><?=$context['user']['currency'].$transaction['amount']; ?></td>
                <td>
                  <?php if($transaction['from_user']==$context['user']['id']): ?>
                  Debit
                  <?php else: ?>
                  Credit
                  <?php endif ?>
                </td>
                <td>
                  <?php if($transaction['from_user']==$context['user']['id']): ?>
                    <?=fetch_user($transaction['to_user'])['fullname']; ?>
                  <?php elseif($transaction['to_user']==$context['user']['id']): ?>
                    <?=fetch_user($transaction['from_user'])['fullname']; ?>
                  <?php endif ?>
                </td>
                <td class="status">
                  <?php if($transaction['status']=='successful'): ?>
                  <div class="badge badge-success">SUCCESSFUL</div>
                  <?php elseif($transaction['status']=='pending'): ?>
                  <div class="badge badge-warning">PENDING</div>
                  <?php else: ?>
                  <div class="badge badge-danger"><?=ucwords($transaction['status']); ?></div>
                  <?php endif ?>
                </td>
                <td><a href="transaction?transaction_id=<?=$transaction['transaction_id'];?>" class="btn btn-outline-primary">View</a></td>
              </tr>
              <?php endforeach ?>
            </table>
          </div>
          <?php else: ?>
          <div class="card-body mt-3 mb-3">
            No Transaction Yet!
          </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  

  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-header">
          <h4>Recent Payments</h4>
        </div>
        <div class="card-body">
          <?php if($context['recent_payments']): ?>
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Date/Time</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($context['recent_payments'] as $payment): ?>
                <tr>
                  <td><?=$payment['date']; ?></td>
                  <td><?=$context['user']['currency'].$payment['amount']; ?></td>
                  <td><?=ucwords($payment['method']); ?></td>
                  <td><?=ucwords($payment['status']); ?></td>
                  <td><a href="payment?payment_id=<?=$payment['id']; ?>" class="btn btn-outline-primary">View</a></td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
          <div class="mt-3 mb-3">
            No Payments Yet!
          </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>