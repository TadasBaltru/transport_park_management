<?php

namespace App\QueryTraits;

trait SearchQueryFormation
{
    public function SearchStringFormationFromRequest(array $searchParam, array $searchValueKeys, array $queryFieldNames): string{
        $searchQuery = " WHERE ";
        $nullQuery = TRUE;

        for($i = 0; $i < count($searchValueKeys); $i++){
            if(isset($searchParam[$searchValueKeys[$i]])) {
                !is_numeric($searchParam[$searchValueKeys[$i]]) ? $value = "'".$searchParam[$searchValueKeys[$i]]."'" : $value = $searchParam[$searchValueKeys[$i]];
                $searchQuery = $searchQuery . " $queryFieldNames[$i] = $value and ";
                $nullQuery = FALSE;
            }
        }
        $searchQuery = rtrim($searchQuery, " and ");


        return $nullQuery ? '' : $searchQuery;
    }

}