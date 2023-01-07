<?php
declare(strict_types=1);
require_once "../app/App.php";

global $incomeTotal;
global $expanseTotal;
global $total;

countingTotalValues(getTransactionData(), $incomeTotal, $expanseTotal, $total);

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            background: #848484;
            padding: 30px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            font-size: 20px;
        }
        table, td, th{
            border: 1px solid black;
        }
        td{
            text-align: center;
        }
        
        .th-total{
            text-align: right;
            padding-right: 10px;
        }
    </style>
    <title>Transactions</title>
</head>
<body>
    <table>
        <tr>
            <th>Data</th>
            <th>Check</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        <?php
        echo fillUpTransactions(getTransactionData());
        ?>
        <tr>
            <td></td>
            <td></td>
            <th class="th-total">Total Income:</th>
            <td>
                <?php
                echo "$" . $incomeTotal;
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <th class="th-total">Total Expense:</th>
            <td>
                <?php
                echo str_replace("-", "-$", (string)$expanseTotal);
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <th class="th-total">Total:</th>
            <td>
                <?php

                if($total > 0){
                    echo "$" . $total;
                }else{
                    echo str_replace("-", "-$", (string)$total);
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>
