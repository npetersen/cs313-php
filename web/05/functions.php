<?php

    setlocale(LC_MONETARY,"en_US.UTF-8");

    function getLoansList($loans) {
        if (count($loans) > 0) {
            $loanList = '<table class="table table-bordered table-striped">';
            $loanList .= '<thead>';
            $loanList .= '<tr><th>Account Number</th><th>Name</th><th>Loan Type</th><th>Loan Amount</th><th>&nbsp;</th></tr>';
            $loanList .= '</thead>';
            $loanList .= '<tbody>';
            foreach ($loans as $loan) {
                $loanList .= "<tr>";
                $loanList .= "<td>$loan[account_number]</td>";
                $loanList .= "<td>" . $loan['first_name'] . " " . $loan['last_name'] . "</td>";
                $loanList .= "<td>" . $loan['loan_type'] . "</td>";
                $loanList .= "<td>" . money_format('%.2n', $loan['amount']) . "</td>";
                $loanList .= "<td><a class='btn btn-primary' href='index.php?action=decisionLoan&loanId=" . $loan['id'] . "' role='button'>Decision This Loan</a></td>";
                $loanList .= '</tr>';
            }
            $loanList .= '</tbody></table>';
        } else {
            $loanList = '<p>There are no loans mathing your criteria.</p>';
        }

        return $loanList;
    }

    function getLoanData($loan) {
        var_dump($loan);
    }

?>