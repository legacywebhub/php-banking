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
                            <?=format_datetime_timezone($context['loan']['date'], $context['admin']['timezone']); ?><br><br>
                            
                            <?php if ($context['loan']['approved_date']): ?>
                                <strong>Approved Date:</strong><br>
                                <?=format_datetime_timezone($context['loan']['approved_date'], $context['user']['timezone']); ?><br><br>
                                <strong>End Date:</strong><br>
                                <?=format_datetime_timezone($context['loan']['end_date'], $context['user']['timezone']); ?><br><br>
                                <strong>Last Payment Date:</strong><br>
                                <?php if (!is_null($context['loan']['last_payment_date'])): ?>
                                    <?=format_datetime_timezone($context['loan']['last_payment_date'], $context['user']['timezone']); ?><br>
                                <?php else: ?>
                                    --/--/----
                                <?php endif ?>
                            <?php endif ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <address>
                        <strong>Loan Remark:</strong><br><br>
                        <p><?=$context['loan']['remark']; ?></p>
                    </address>
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
                <div class="section-title">Loan Documents</div>
                <div class="images">
                    <?php if($context['loan']['personal_identification']): ?>
                        <div class="mb-2">
                            <a target="_blank" href="<?=MEDIA_ROOT; ?>/documents/<?=$context['loan']['personal_identification']; ?>"><?=$context['loan']['personal_identification']; ?></a>
                            <br><small class="text-info">Personal Identification</small>
                        </div>
                    <?php endif ?>
                    <?php if($context['loan']['business_documentation']): ?>
                        <div class="mb-2">
                            <a target="_blank" href="<?=MEDIA_ROOT; ?>/documents/<?=$context['loan']['business_documentation']; ?>"><?=$context['loan']['business_documentation']; ?></a>
                            <br><small class="text-info">Business Documentation</small>
                        </div>
                    <?php endif ?>
                    <?php if($context['loan']['proof_of_income']): ?>
                        <div class="mb-2">
                            <a target="_blank" href="<?=MEDIA_ROOT; ?>/documents/<?=$context['loan']['proof_of_income']; ?>"><?=$context['loan']['proof_of_income']; ?></a>
                            <br><small class="text-info">Proof Of Income</small>
                        </div>
                    <?php endif ?>
                    <?php if($context['loan']['collateral_documentation']): ?>
                        <div class="mb-2">
                            <a target="_blank" href="<?=MEDIA_ROOT; ?>/documents/<?=$context['loan']['collateral_documentation']; ?>"><?=$context['loan']['collateral_documentation']; ?></a>
                            <br><small class="text-info">Collateral Documentation</small>
                        </div>
                    <?php endif ?>
                </div>
                </div>
                <div class="col-lg-4 text-right">
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Subtotal</div>
                    <div class="invoice-detail-value"><?=$context['user']['currency'].$context['loan']['amount']; ?></div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Total To Be Paid</div>
                    <div class="invoice-detail-value invoice-detail-value-lg"><?=$context['user']['currency'].$context['loan']['total_returns']; ?></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <hr>
        <div class="text-md-right">
            <a class="btn btn-warning btn-icon icon-left text-light print-button"><i class="fas fa-print"></i> Print</a>
            <?php if($context['loan']['status']=='pending'): ?>
                <a href="approve-loan?loan_id=<?=$context['loan']['loan_id']; ?>" class="btn btn-success btn-icon icon-left text-light"><i class="fas fa-check"></i> Approve</a>
                <a href="decline-loan?loan_id=<?=$context['loan']['loan_id']; ?>" class="btn btn-danger btn-icon icon-left text-light"><i class="fas fa-times"></i> Decline</a>
            <?php endif ?>
        </div>
    </div>
</div>



<script src="<?=STATIC_ROOT; ?>/dashboard/js/html2canvas.min.js"></script>

<script>
document.querySelector('.print-button').addEventListener('click', function() {
    html2canvas(document.querySelector(".invoice")).then(canvas => {
        // Create an image of the canvas
        var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        
        // Create a link to download the image
        var link = document.createElement('a');
        link.download = 'loan.png';
        link.href = image;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});
</script>