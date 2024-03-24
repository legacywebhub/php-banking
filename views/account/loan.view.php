<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
            <div class="invoice-title">
                <h2>Loan Detail</h2>
                <div class="invoice-number">ID #<?=$context['loan']['loan_id']; ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                <address>
                    <strong>User info:</strong><br><br>
                    Name: <b><?=fetch_user($context['loan']['user_id'])['fullname']; ?></b><br>
                    Email: <b><?=$context['user']['email']; ?></b><br>
                    Phone: <b><?=$context['user']['phone']; ?></b><br>
                    Address: <b><?=$context['user']['address']; ?></b><br>
                    Country: <b><?=$context['user']['country']; ?></b><br>
                    Timezone: <b><?=$context['user']['timezone']; ?></b><br>
                    Monthly income: <b><?=$context['user']['currency'].$context['loan']['user_monthly_income']; ?></b><br>
                </address>
                </div>
                <div class="col-md-6 text-md-right">
                <address>
                    <strong>Loan info:</strong><br><br>
                    Amount: <b><?=$context['user']['currency'].$context['loan']['amount']; ?></b><br>
                    Loan Duration: <?=$context['loan']['duration_in_months']." Months"; ?><br>
                    Calculated Interest: <b><?=$context['user']['currency'].$context['loan']['interest']; ?></b><br>
                    Total Returns: <b><?=$context['user']['currency'].$context['loan']['total_returns']; ?></b><br>
                    <?php if ($context['loan']['status']=='pending'): ?>
                        <div class="badge badge-warning"><?=ucfirst($context['loan']['status']); ?></div>
                    <?php elseif($context['loan']['status']=='active'): ?>
                        <div class="badge badge-success"><?=ucfirst($context['loan']['status']); ?></div>
                    <?php elseif($context['loan']['status']=='declined'): ?>
                        <div class="badge badge-danger"><?=ucfirst($context['loan']['status']); ?></div>
                    <?php elseif($context['loan']['status']=='closed'): ?>
                        <div class="badge badge-secondary"><?=ucfirst($context['loan']['status']); ?></div>
                    <?php endif ?>
                </address>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <address>
                    </address>
                </div>

                <div class="col-md-6 text-md-right">
                <address>
                    <strong>Request Date:</strong><br>
                    <?=format_datetime_timezone($context['loan']['date'], $context['user']['timezone']); ?><br><br>
                    
                    <?php if ($context['loan']['approved_date']): ?>
                        <strong>Approved Date:</strong><br>
                        <?=format_datetime_timezone($context['loan']['approved_date'], $context['user']['timezone']); ?><br><br>
                        <strong>End Date:</strong><br>
                        <?=format_datetime_timezone($context['loan']['end_date'], $context['user']['timezone']); ?><br>
                    <?php endif ?>
                </address>
                </div>
            </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
            <div class="section-title">Loan Summary</div>
            <!-- <p class="section-lead">All items here cannot be deleted.</p> -->
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                <tr>
                    <th data-width="40">Loan ID</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Duration</th>
                    <th class="text-right">Calcuated Interest</th>
                    <th class="text-right">Calcuated Returns</th>
                    <th class="text-right">Monthly Payment</th>
                </tr>
                <tr>
                    <td><?=$context['loan']['loan_id']; ?></td>
                    <td class="text-center"><?=$context['user']['currency'].$context['loan']['amount']; ?></td>
                    <td class="text-center"><?=$context['loan']['duration_in_months']." Months"; ?></td>
                    <td class="text-right"><?=$context['user']['currency'].$context['loan']['interest']; ?></td>
                    <td class="text-right"><?=$context['user']['currency'].$context['loan']['total_returns']; ?></td>
                    <td class="text-right"><?=$context['user']['currency'].$context['loan']['monthly_payment']; ?></td>
                </tr>
                </table>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8">
                <div class="section-title">Payment Method</div>
                <p class="section-lead">The payment method that we provide is to make it easier for you to pay
                    back</p>
                <div class="images">
                    <img src="<?=STATIC_ROOT; ?>/dashboard/img/cards/visa.png" alt="visa">
                    <img src="<?=STATIC_ROOT; ?>/dashboard/img/cards/jcb.png" alt="jcb">
                    <img src="<?=STATIC_ROOT; ?>/dashboard/img/cards/mastercard.png" alt="mastercard">
                    <img src="<?=STATIC_ROOT; ?>/dashboard/img/cards/paypal.png" alt="paypal">
                </div>
                </div>
                <div class="col-lg-4 text-right">
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Subtotal</div>
                    <div class="invoice-detail-value"><?=$context['user']['currency'].$context['loan']['amount']; ?></div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Total</div>
                    <div class="invoice-detail-value invoice-detail-value-lg"><?=$context['user']['currency'].$context['loan']['total_returns']; ?></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <hr>
        <div class="text-md-right">
            <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>
</div>