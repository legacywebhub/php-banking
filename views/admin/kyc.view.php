<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-title">
                    <h2>kyc Detail</h2>
                    <div class="invoice-number">ID #<?=$context['kyc']['id']; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>User info:</strong><br><br>
                            User ID: <b><?=$context['user']['id']; ?></b><br>
                            Name: <b><?=$context['user']['fullname']; ?></b><br>
                            Email: <b><?=$context['user']['email']; ?></b><br>
                            Phone: <b><?=$context['user']['phone']; ?></b><br>
                            Address: <b><?=$context['user']['address']; ?></b><br>
                            Country: <b><?=$context['user']['country']; ?></b><br>
                            Timezone: <b><?=$context['user']['timezone']; ?></b><br>
                        </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <address>
                            <strong>KYC info:</strong><br><br>
                            KYC ID: <b><?=$context['kyc']['id']; ?></b><br>
                            ID Type: <b><?=$context['kyc']['id_type'] ?? 'None'; ?></b><br>
                            ID Number: <b><?=$context['kyc']['id_number'] ?? 'None'; ?></b><br>
                            Status:
                            <?php if ($context['kyc']['status']=='pending'): ?>
                                <div class="badge badge-warning"><?=ucfirst($context['kyc']['status']); ?></div>
                            <?php elseif($context['kyc']['status']=='approved'): ?>
                                <div class="badge badge-success"><?=ucfirst($context['kyc']['status']); ?></div>
                            <?php elseif($context['kyc']['status']=='declined'): ?>
                                <div class="badge badge-danger"><?=ucfirst($context['kyc']['status']); ?></div>
                            <?php else: ?>
                                <div class="badge badge-secondary">Null</div>
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
                            <strong>Approved Date:</strong><br>
                            <?php if ($context['kyc']['approved_date']): ?>
                                <?=format_datetime_timezone($context['kyc']['approved_date'], $context['user']['timezone']); ?><br><br>
                            <?php else: ?>
                                --/--/----
                            <?php endif ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
            <div class="section-title">kyc Summary</div>
                <!-- <p class="section-lead">All items here cannot be deleted.</p> -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                    <tr>
                        <th data-width="40">kyc ID</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Passport</th>
                        <th class="text-right">ID Type</th>
                        <th class="text-right">ID Number</th>
                        <th class="text-right">ID Upload</th>
                    </tr>
                    <tr>
                        <td><?=$context['kyc']['id']; ?></td>
                        <td class="text-center"><?=$context['user']['fullname']; ?></td>
                        <td class="text-center">
                            <?php if (!is_null($context['kyc']['passport'])): ?>
                                <a href="<?=MEDIA_ROOT; ?>/documents/<?=$context['kyc']['passport']; ?>" target="_blank"><img width="50px" src="<?=MEDIA_ROOT; ?>/documents/<?=$context['kyc']['passport']; ?>"></a>
                            <?php else: ?>
                                <img width="50px" src="<?=STATIC_ROOT; ?>/dashboard/img/image_placeholder.png">
                            <?php endif ?>
                        </td>
                        <td class="text-right"><?=$context['kyc']['id_type'] ?? '-'; ?></td>
                        <td class="text-right"><?=$context['kyc']['id_number'] ?? '-'; ?></td>
                        <td class="text-right">
                            <?php if (!is_null($context['kyc']['id_upload'])): ?>
                                <a href="<?=MEDIA_ROOT; ?>/documents/<?=$context['kyc']['id_upload']; ?>" target="_blank"><img width="50px" src="<?=MEDIA_ROOT; ?>/documents/<?=$context['kyc']['id_upload']; ?>"></a>
                            <?php else: ?>
                                <img width="50px" src="<?=STATIC_ROOT; ?>/dashboard/img/image_placeholder.png">
                            <?php endif ?>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <hr>
        <div class="text-md-right">
            <a class="btn btn-warning btn-icon icon-left text-light print-button"><i class="fas fa-print"></i> Print</a>
            <?php if($context['kyc']['status']=='pending'): ?>
                <a href="approve-kyc?kyc_id=<?=$context['kyc']['id']; ?>" class="btn btn-success btn-icon icon-left text-light"><i class="fas fa-check"></i> Approve</a>
                <a href="decline-kyc?kyc_id=<?=$context['kyc']['id']; ?>" class="btn btn-danger btn-icon icon-left text-light"><i class="fas fa-times"></i> Decline</a>
            <?php endif ?>
        </div>
    </div>
</div>