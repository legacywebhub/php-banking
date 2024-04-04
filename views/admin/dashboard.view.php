<style>
    .total {
        font-size: 30px;
    }
</style>
<div class="row ">
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-green">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-user"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Users</h4>
            <span class="total"><?=$context['total_users']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2">Verified Users</span>
            <span class="text-nowrap">(<?=$context['verified_users']; ?>)</span>
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-cyan">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-money-bill"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Payments</h4>
            <span class="total"><?=$context['total_payments']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2">Pending Payments</span>
            <span class="text-nowrap">(<?=$context['pending_payments']; ?>)</span>
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-orange">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-hand-holding-usd"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Loans</h4>
            <span class="total"><?=$context['total_loans']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2">Pending Loans</span>
            <span class="text-nowrap">(<?=$context['pending_loans']; ?>)</span>
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-purple">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-dollar-sign"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Transactions</h4>
            <span class="total"><?=$context['total_transactions']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2">Pending Transactions</span>
            <span class="text-nowrap">(<?=$context['pending_transactions']; ?>)</span>
            </p>
        </div>
        </div>
    </div>
    </div>
</div>