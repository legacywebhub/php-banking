<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Users List  &nbsp;&nbsp;&nbsp;<a href="add-user" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add User</a></h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search name">
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
                        <th>User ID</th>
                        <th>Profile</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Account Number</th>
                        <th>Balance</th>
                        <th>Overdraft</th>
                        <th>Staff</th>
                        <th>Superuser</th>
                        <th>Blocked</th>
                        <th>Date Joined</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['users']['result'])): ?>
                        <tr>
                            <td>
                            No Users Yet
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['users']['result'] as $user): ?>
                            <?php $user_kyc = query_fetch("SELECT * FROM kycs WHERE user_id = ".$user['id']." LIMIT 1")[0]; ?>
                            <tr class="mt-2" style="margin-top: 10px !important;">
                                <td><?=$user['id']; ?></td>
                                <td>
                                    <?php if ($user_kyc['status']=="approved"): ?>
                                        <a href="<?=MEDIA_ROOT; ?>/images/users/<?=$user_kyc['passport']; ?>" target="_blank"><img  class="user-img-radious-style" width="50px" src="<?=MEDIA_ROOT; ?>/images/users/<?=$user_kyc['passport']; ?>"></a>
                                    <?php else: ?>
                                        <img class="user-img-radious-style" width="50px" src="<?=STATIC_ROOT; ?>/dashboard/img/default_user.png">
                                    <?php endif ?>
                                </td>
                                <td><?=$user['firstname']." ".$user['lastname']; ?></td>
                                <td><?=$user['email']; ?></td>
                                <td><?=$user['account_number']; ?></td>
                                <td><?=$user['currency'].$user['balance']; ?></td>
                                <td><?=$user['currency'].$user['overdraft']; ?></td>
                                <td class="align-middle">
                                    <?php if($user['is_staff'] == 1): ?>
                                        <div class="badge badge-success">Yes</div>
                                    <?php else: ?>
                                        <div class="badge badge-danger">No</div>
                                    <?php endif ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($user['is_superuser'] == 1): ?>
                                        <div class="badge badge-success">Yes</div>
                                    <?php else: ?>
                                        <div class="badge badge-danger">No</div>
                                    <?php endif ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($user['is_blocked'] == 1): ?>
                                        <div class="badge badge-danger">Yes</div>
                                    <?php else: ?>
                                        <div class="badge badge-success">No</div>
                                    <?php endif ?>
                                </td>
                                <td><?=date("d-m-Y", strtotime($user['date_joined'])); ?></td>
                                <td>
                                <?php if($context['admin']['is_superuser'] == 1): ?>
                                    <a href="edit-user?id=<?=$user['id']; ?>" class="btn btn-primary btn-action" title="Edit">Edit</a>
                                    <?php if($user['is_blocked']==0): ?>
                                        <a href="block-user?id=<?=$user['id']; ?>" class="btn btn-secondary btn-action" title="Block">Block</a>
                                    <?php else: ?>
                                        <a href="unblock-user?id=<?=$user['id']; ?>" class="btn btn-secondary btn-action" title="Unblock">Unblock</a>
                                    <?php endif ?>
                                    <a href="delete-user?id=<?=$user['id']; ?>" class="btn btn-danger btn-action" title="Delete">Delete</a>
                                <?php else: ?>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-action" title="Edit">Edit</a>
                                    <?php if($user['is_blocked']==0): ?>
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-action" title="Block">Block</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-action" title="Unblock">Unblock</a>
                                    <?php endif ?>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-action " title="Delete">Delete</a>
                                <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pagination-container my-3">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['users']['page'] ?></b> 0f <b><?=$context['users']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['users']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['users']['previous_page'] ?>" aria-label="Previous">
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

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['users']['page'] ?></a></li>


                        <?php if ($context['users']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['users']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['users']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>