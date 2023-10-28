<?php

namespace App\Traits;

use Illuminate\Database\QueryException;

trait HandlesQueryException
{
    public function handleQueryException(QueryException $e)
    {
        $errorCode = $e->errorInfo[1];

        switch ($errorCode) {
          case 1062:
            return response()->json(['message' => 'Duplicate entry detected: This username already exists!'], 400);
          case 1451:
              return response()->json(['message' => 'Cannot remove or update a parent row. A foreign key constraint fails.'], 400);
          case 1452:
              return response()->json(['message' => 'Cannot add or update a child row. A foreign key constraint fails.'], 400);
          case 1048:
              return response()->json(['message' => 'A required column is missing or contains a NULL value.'], 400);
          case 1216:
              return response()->json(['message' => 'Cannot add or update a child row. The parent row doesnt exist.'], 400);
          case 1217:
              return response()->json(['message' => 'Cannot delete or update a parent row. Theres a dependent child row.'], 400);     
          default:
              return response()->json(['message' => 'Database error encountered. Please try again later.'], 500);
        }
    }
}
