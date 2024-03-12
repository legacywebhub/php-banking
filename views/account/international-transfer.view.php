{% extends 'dashboard/base.html' %}
{% load static %}

{% block style %}
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
{% endblock %}

{% block content %}
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
            <form method="post">
                {% csrf_token %}
                <div class="form-group">
                    <label>Select Account</label>
                    <select class="form-control" name="account">
                      <option value="balance">Balance</option>
                      <option value="balance">Overdraft</option>
                    </select>
                  </div>
                <div class="form-group">
                  <label>Bank Name</label>
                  <input type="text" name="bank-name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Swift Code *</label>
                    <input type="text" name="swift-code" class="form-control">
                </div>
                <div class="form-group">
                    <label>IBAN Code *</label>
                    <input type="text" name="iban-code" class="form-control">
                </div>
                <div class="form-group">
                    <label>Account Number *</label>
                    <input type="text" maxlength="10" name="account-number" placeholder="51***910" class="form-control">
                    <div id="validate-div">&nbsp;&nbsp;Validating..</div>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" maxlength="12" name="amount" class="form-control">
                </div>
                <div class="form-group">
                    <label>Remark</label>
                    <textarea class="form-control" maxlength="255" name="remark" placeholder="(Optional)"></textarea>
                  </div>
                <div class="form-group">
                    <label>Transaction Pin</label>
                    <input type="text" maxlength="4" name="pin" placeholder="****" class="form-control">
                </div>
            </form>
          <div class="card-footer text-left">
            <button class="btn btn-primary mr-1" type="submit">Send</button>
          </div>
        </div>
    </div>
  </div>
{% endblock %}

{% block script %}
<script>

</script>
{% endblock %}