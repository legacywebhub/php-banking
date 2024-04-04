<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Payment List </h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" maxlength="24" placeholder="Search payment id" required>
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>Date</th>
                        <th>payment ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Purpose</th>
                        <th>Method</th>
                        <th>Proof</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['payments']['result'])): ?>
                        <tr>
                            <td>No payments Yet</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['payments']['result'] as $payment): ?>
                            <?php $user = fetch_user($payment['user_id']); ?>
                            <tr class="mt-2" style="margin-top: 10px !important;">
                                <td><?=format_datetime($payment['date']); ?></td>
                                <td><?=$payment['payment_id']; ?></td>
                                <td><?=$user['fullname']; ?></td>
                                <td><?=$user['currency'].$payment['amount']; ?></td>
                                <td><?=$payment['purpose']; ?></td>
                                <td><?=$payment['method']; ?></td>
                                <td>
                                    <?php if ($payment['proof']): ?>
                                        <a href="<?=MEDIA_ROOT; ?>/images/payments/<?=$payment['proof']; ?>" target="_blank"><img src="<?=MEDIA_ROOT; ?>/images/payments/<?=$payment['proof']; ?>"  width="50px"></a>
                                    <?php else: ?>
                                        <img src="<?=STATIC_ROOT; ?>/dashboard/img/image_placeholder.png" width="50px">
                                    <?php endif ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($payment['status'] == "pending"): ?>
                                        <div class="badge badge-warning">Pending</div>
                                    <?php elseif($payment['status'] == "approved"): ?>
                                        <div class="badge badge-success">Approved</div>
                                    <?php else: ?>
                                        <div class="badge badge-danger">Declined</div>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if($payment['status'] == "pending"): ?>
                                        <a href="approve-payment?payment_id=<?=$payment['payment_id']; ?>" class="btn btn-primary btn-action" title="Approve">Approve</a>
                                        <a href="decline-payment?payment_id=<?=$payment['payment_id']; ?>" class="btn btn-danger btn-action" title="Decline">Decline</a>
                                    <?php else: ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pagination-container my-3">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['payments']['page'] ?></b> 0f <b><?=$context['payments']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['payments']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['payments']['previous_page'] ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php endif ?>

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['payments']['page'] ?></a></li>


                        <?php if ($context['payments']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['payments']['next_page'] ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
                    </nav>
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['payments']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>