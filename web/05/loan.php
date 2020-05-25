<h2>Loan ID: <?php echo $loan[0]['id'] ?></h2>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Loan Details</h4>
                <ul class="list-group">
                    <li class="list-group-item">Status: <?php echo $loan[0]['status'] ?></li>
                    <li class="list-group-item">Type: <?php echo $loan[0]['loan_type'] ?></li>
                    <li class="list-group-item">Amount: $<?php echo $loan[0]['amount'] ?></li>
                    <li class="list-group-item">Term: <?php echo $loan[0]['term'] ?> months</li>
                    <li class="list-group-item">Rate: <?php echo $loan[0]['rate'] ?>%</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Applicant Details</h4>
                <ul class="list-group">
                    <li class="list-group-item">Account Number: <?php echo $loan[0]['account_number'] ?></li>
                    <li class="list-group-item">Name: <?php echo $loan[0]['first_name'] ?> <?php echo $loan[0]['last_name'] ?></li>
                    <li class="list-group-item">SSN: <?php echo $loan[0]['ssn'] ?></li>
                    <li class="list-group-item">Gross Monthly Income: $<?php echo $loan[0]['gross_monthly_income'] ?></li>
                    <li class="list-group-item">Email: <?php echo $loan[0]['email'] ?></li>
                    <li class="list-group-item">Phone: <?php echo $loan[0]['phone'] ?></li>
                    <li class="list-group-item">Address:<br><?php echo $loan[0]['street_address'] ?><br><?php echo $loan[0]['city'] ?>, <?php echo $loan[0]['state'] ?> <?php echo $loan[0]['zip'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="col">
        <div class="card">
            <div class="card-body">
            </div>
        </div>
    </div> -->
</div>
<div class="row mt-4">
    <div class="col text-center">
        <button type="button" class="btn btn-primary btn-lg">Approve Loan</button>
        <button type="button" class="btn btn-secondary btn-lg">Deny Loan</button>
        <button type="button" class="btn btn-secondary btn-lg">Back to Pending Loans List</button>
    </div>
</div>