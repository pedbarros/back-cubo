<?php
namespace App\Http\Support;


class Respond
{
    public function ok($value)
    {
        return response()->json($value, 200);
    }
    public function notFound($message)
    {
        return response()->json($message, 404);
    }
    public function error($value)
    {
        return response()->json($value, 500);
    }

    public function badRequest($value)
    {
        return response()->json($value, 400);
    }

    public function unauthorized($value)
    {
        return response()->json($value, 401);
    }


}
