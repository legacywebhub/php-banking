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
      <p><?=$context['firstname']; ?></p>
    </div>
    <div class="balance">
      <h6>Account Balance</h6>
      <h5>{{request.user.currency}}{{request.user.balance}}</h5>
    </div>
    <div class="action-buttons">
      <a href="{% url 'banking:transactions" class="btn btn-sm btn-icon icon-left btn-primary"><i class="fas fa-bars"></i> Transactions</a>
      <a href="{% url 'banking:fund_account" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-donate"></i> Fund Account</a>
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
                  <h4 class="mt-2">{{request.user.currency}}{{request.user.balance}}</h4>
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
                  <h4 class="mt-2">{{request.user.currency}}{{request.user.overdraft}}</h4>
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
                  <h4 class="mt-2">{{request.user.account_number}}</h4>
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
                  <h4 class="mt-2">{{request.user.account_type}}</h4>
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
          {% if recent_transactions %}
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
              {% for transaction in recent_transactions %}
              <tr>
                <td class="p-0 text-center">
                  <div class="custom-checkbox custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                      id="checkbox-1">
                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                  </div>
                </td>
                <td>{{transaction.timestamp|timezone:request.user.timezone}}</td>
                <td>{{transaction.amount}}</td>
                <td>
                  {% if transaction.from_user == request.user %}
                  Debit
                  {% elif transaction.to_user == request.user %}
                  Credit
                  {% endif %}
                </td>
                <td>
                  {% if transaction.from_user != request.user %}
                  {{transaction.from_user|upper}}
                  {% elif transaction.to_user != request.user %}
                  {{transaction.to_user|upper}}
                  {% endif %}
                </td>
                <td class="status">
                  {% if transaction.status == 'successful
                  <div class="badge badge-success">{{transaction.get_status_display|upper}}</div>
                  {% elif transaction.status == 'pending
                  <div class="badge badge-warning">{{transaction.get_status_display|upper}}</div>
                  {% else %}
                  <div class="badge badge-danger">{{transaction.get_status_display|upper}}</div>
                  {% endif %}
                </td>
                <td><a href="{% url 'banking:transaction' transaction.id %}" class="btn btn-outline-primary">View</a></td>
              </tr>
              {% endfor %}
            </table>
          </div>
          {% else %}
          <div class="card-body mt-3 mb-3">
            No Transaction Found!
          </div>
          {% endif %}
        </div>
      </div>
    </div>
  </div>
  

  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-header">
          <h4>Recent Crypto Transactions</h4>
        </div>
        <div class="card-body">
          {% if crypto_transactions %}
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
                {% for transaction in crypto_transactions %}
                <tr>
                  <td>{{transaction.timestamp}}</td>
                  <td>{{transaction.amount}}</td>
                  <td>{{transaction.get_method_display|upper}}</td>
                  <td>{{transaction.status|upper}}</td>
                  <td><a href="{% url 'banking:transaction' transaction.id %}" class="btn btn-outline-primary">View</a></td>
                </tr>
                {% endfor %}
              </tbody>
            </table>
          </div>
          {% else %}
          <div class="mt-3 mb-3">
            No Transaction Found!
          </div>
          {% endif %}
        </div>
      </div>
    </div>
  </div>
{% endblock %}