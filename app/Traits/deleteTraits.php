<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait deleteTraits
{
    public function DeleteTraits($model, $id)
    {
        try {
            $model->find($id)->delete();
            return Response()->json([
                'status' => 200,
                'message' => 'true'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' Line: ' . $exception->getLine());
            return Response()->json([
                'status' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
