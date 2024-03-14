<div class="card-details mt-5">
    <div class="col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header">
            <h4>Transaction Details</h4>
            </div>
            <div class="card-body">
            <div class="py-4">
                <p class="clearfix">
                <span class="float-left">
                    Transaction Type
                </span>
                <span class="float-right text-muted">
                    <?php if ($context['transaction']['from_user']==$context['user']['id']): ?>
                    Debit
                    <?php elseif ($context['transaction']['to_user']==$context['user']['id']): ?>
                    Credit
                    <?php endif ?>
                </span>
                </p>
                <p class="clearfix">
                <span class="float-left">
                    Description
                </span>
                <span class="float-right text-muted">
                    <?=ucfirst($context['transaction']['description']); ?>
                </span>
                </p>
                <?php if ($context['transaction']['description']=='transfer'): ?>
                <p class="clearfix">
                <span class="float-left">
                    Issuer
                </span>
                <span class="float-right text-muted">
                    <?=fetch_user($context['transaction']['from_user'])['fullname']; ?>
                </span>
                </p>
                <p class="clearfix">
                <span class="float-left">
                    Recipient
                </span>
                <span class="float-right text-muted">
                    <?=fetch_user($context['transaction']['to_user'])['fullname']; ?>
                </span>
                </p>
                <?php else: ?>
                <p class="clearfix">
                <span class="float-left">
                    Customer
                </span>
                <span class="float-right text-muted">
                    <?php if ($context['transaction']['from_user']==$context['user']['id']): ?>
                        <?=fetch_user($context['transaction']['from_user'])['fullname']; ?>
                    <?php elseif ($context['transaction']['to_user']==$context['user']['id']): ?>
                        <?=fetch_user($context['transaction']['to_user'])['fullname']; ?>
                    <?php endif ?>
                </span>
                </p>
                <?php endif ?>
                <p class="clearfix">
                <span class="float-left">
                    Amount
                </span>
                <span class="float-right text-muted">
                    <?=$context['transaction']['currency'].$context['transaction']['amount']; ?>
                </span>
                </p>
                <?php if ($context['transaction']['remark']): ?>
                <p class="clearfix">
                <span class="float-left">
                    Remark
                </span>
                <span class="float-right text-muted">
                    <?=truncate_words($context['transaction']['remark'], 10); ?>
                </span>
                </p>
                <?php endif ?>
                <p class="clearfix">
                <span class="float-left">
                    Transaction ID
                </span>
                <span class="float-right text-muted">
                    <?=$context['transaction']['transaction_id']; ?>
                </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                        Transaction Date
                    </span>
                    <span class="float-right text-muted">
                        <?=format_datetime_timezone($context['transaction']['date'], $context['user']['timezone']); ?>
                    </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                        Status
                    </span>
                    <span class="float-right text-muted">
                        <?php if($context['transaction']['status']=='successful'): ?>
                        <span class="badge badge-success">SUCCESSFUL</span>
                        <?php elseif($context['transaction']['status']=='pending'): ?>
                        <span class="badge badge-warning">PENDING</span>
                        <?php else: ?>
                        <span class="badge badge-danger"><?=ucwords($context['transaction']['status']); ?></span>
                        <?php endif ?>
                    </span>
                </p>
            </div>

            <div class="text-md-left">
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
            </div>
        </div>
    </div>
</div>