<?php
declare(strict_types=1);

const FILE_NAME = "example.csv";
const FILE_PATH = "../transaction_files/" . FILE_NAME;

$incomeTotal = 0;
$expanseTotal = 0;
$total = 0;


function getTransactionData():array{
    $counter = 0;
    $transactions = [];
    if (($handle = fopen(FILE_PATH, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $transactions[$counter] = $data;
            $counter++;
        }

        fclose($handle);
    }
    return $transactions;
}

function fillUpTransactions(array $transactions): string
{
    $html = "";
    foreach($transactions as $row){
        $html .= "<tr>";
        foreach ($row as $value){

            if(str_contains($value, "$")){
                if(str_starts_with($value, "-")){
                    $html .= "<td style='color: red'>$value</td>";
                }else{
                    $html .= "<td style='color: green'>$value</td>";
                }
            }else{
                $html .= "<td>$value</td>";
            }
        }
        $html .= "</tr>";
    }
    return $html;
}
function countingTotalValues(array $transactions, int &$income, int &$expanse, &$total){
    $incomeValues = [];
    $expanseValues = [];


    foreach ($transactions as $key => $row){
        $number = (float)str_replace("$", "", $row[3]);
       if($number > 0){
           $incomeValues[$key] = $number;
       }else{
           $expanseValues[$key] = $number;
       }
    }

    $income = array_sum($incomeValues);
    $expanse = array_sum($expanseValues);
    $total = $income + $expanse;
}


function pretty(array $array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";

}