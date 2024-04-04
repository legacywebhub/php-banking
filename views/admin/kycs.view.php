<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>KYC List </h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search user id">
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
                        <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                        </th>
                        <th>User ID</th>
                        <th>User</th>
                        <th>Passport</th>
                        <th>ID Type</th>
                        <th>ID Number</th>
                        <th>ID Upload</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['kycs']['result'])): ?>
                        <tr>
                            <td>No KYCs Yet</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['kycs']['result'] as $kyc): ?>
                            <tr class="mt-2" style="margin-top: 10px !important;">
                                <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td><?=$kyc['user_id']; ?></td>
                                <td><?=fetch_user($kyc['user_id'])['fullname'] ?? "Invalid User"; ?></td>
                                <td>
                                    <?php if (!is_null($kyc['passport'])): ?>
                                        <a href="<?=MEDIA_ROOT; ?>/documents/<?=$kyc['passport']; ?>" target="_blank"><img width="50px" src="<?=MEDIA_ROOT; ?>/documents/<?=$kyc['passport']; ?>"></a>
                                    <?php else: ?>
                                        <img width="50px" src="<?=STATIC_ROOT; ?>/dashboard/img/image_placeholder.png">
                                    <?php endif ?>
                                </td>
                                <td><?=$kyc['id_type'] ?? "None"; ?></td>
                                <td><?=$kyc['id_number'] ?? "None"; ?></td>
                                <td>
                                    <?php if (!is_null($kyc['id_upload'])): ?>
                                        <a href="<?=MEDIA_ROOT; ?>/documents/<?=$kyc['id_upload']; ?>" target="_blank"><img width="50px" src="<?=MEDIA_ROOT; ?>/documents/<?=$kyc['id_upload']; ?>"></a>
                                    <?php else: ?>
                                        <img width="50px" src="<?=STATIC_ROOT; ?>/dashboard/img/image_placeholder.png">
                                    <?php endif ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($kyc['status'] == "approved"): ?>
                                        <div class="badge badge-success">Approved</div>
                                    <?php elseif($kyc['status'] == "pending"): ?>
                                        <div class="badge badge-warning">Pending</div>
                                    <?php elseif($kyc['status'] == "declined"): ?>
                                        <div class="badge badge-danger">Declined</div>
                                    <?php else: ?>
                                        <div class="badge badge-secondary">Null</div>
                                    <?php endif ?>
                                </td>
                                <td>
                                <span class="action-btns">
                                    <?php if($kyc['status'] == "pending"): ?>
                                        <a href="approve-kyc?id=<?=$kyc['id']; ?>" class="btn btn-success btn-action" title="Approve">Approve</a>
                                        <a href="decline-kyc?id=<?=$kyc['id']; ?>" class="btn btn-danger btn-action" title="Decline">Decline</a>
                                    <?php else: ?>
                                        -
                                    <?php endif ?>
                                </span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pagination-container my-3">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['kycs']['page'] ?></b> 0f <b><?=$context['kycs']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['kycs']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['kycs']['previous_page'] ?>" aria-label="Previous">
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

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['kycs']['page'] ?></a></li>

                        <?php if ($context['kycs']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['kycs']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['kycs']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>