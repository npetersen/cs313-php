<?php 
    setlocale(LC_MONETARY,"en_US.UTF-8");
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Account Number</th>
            <th>Name</th>
            <th>Loan Type</th>
            <th>Loan Amount</th>
            <th>&nbsp;</th></tr>
    </thead>
    <tbody>
        <?php foreach ($loans as $loan) { ?>
            <tr>
                <td><?php echo $loan[account_number] ?></td>
                <td><?php echo $loan['first_name'] ?> <?php echo $loan['last_name'] ?></td>
                <td><?php echo $loan['loan_type'] ?></td>
                <td><?php echo money_format('%.2n', $loan['amount']) ?></td>
                <td><a class="btn btn-primary" href="index.php?action=reviewLoan&loanId=<?php echo $loan['id'] ?>" role='button'>Review This Loan</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>