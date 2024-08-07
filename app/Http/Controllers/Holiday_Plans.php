<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Holiday_Plans extends Controller
{
    private int $user_id;

    public function __construct()
    {
        $this->user_id = intval(Auth::user()['id']);
    }

    public function list(Request $request)
    {
        $validate = $this->validate($request, [
            'search' => 'string', 'order_by' => 'in:desc,asc',
            'paginate' => 'boolean', 'page' => 'integer', 'per_page' => 'integer'
        ]);

        $list_plans = Plans::select('id', 'title', 'date', 'create_time')->where('user_id', '=', $this->user_id)->orderBy('id', $validate['order_by'] ?? 'ASC');

        if (isset($validate['search'])) {
            $list_plans->where('title', 'LIKE', $validate['search']);
        }

        if (isset($validate['paginate']) && $validate['paginate'] == true) {
            $list_plans = $list_plans->paginate($validate['per_page'] ?? 10, page: $validate['page'] ?? 1);
        } else {
            $list_plans = ['plans' => $list_plans->get(), 'count' => $list_plans->count()];
        }

        return response()->json($list_plans);
    }

    public function get_plan(mixed $id)
    {
        $plan = Plans::where([['id', '=', $id], ['user_id', '=', $this->user_id]])->first();

        if ($plan != null) {
            return response()->json($plan, 200);
        } else {
            return response()->json(['erro' => 'plan', 'message' => 'plan not found'], 404);
        }
    }

    public function get_plan_document(mixed $id)
    {
        $plan = Plans::where([['id', '=', $id], ['user_id', '=', $this->user_id]])->first();

        if ($plan != null) {
            $pdf = Pdf::loadView('pdf.plan', $plan->toArray());
            return $pdf->stream("plan_{$plan['date']}.pdf");
        } else {
            return response()->json(['erro' => 'plan', 'message' => 'plan not found'], 404);
        }
    }

    public function create(Request $request)
    {
        $values = $this->validate($request, [
            'title' => 'string|required', 'description' => 'string|required', 'location' => 'string|required',
            'date' => 'date_format:Y-m-d|required', 'participants' => 'array', 'participants.*' => 'string'
        ]);

        $values['user_id'] = $this->user_id;

        $id = Plans::create($values);

        return response()->json(['message' => 'plan created', 'plan' => Plans::where('id', '=', $id)->first()], 201);
    }

    public function update(Request $request, mixed $id)
    {
        $values = $this->validate($request, [
            'title' => 'string', 'description' => 'string', 'location' => 'string',
            'date' => 'date_format:Y-m-d', 'participants' => 'array', 'participants.*' => 'string'
        ]);

        if (count($values) < 1) {
            return response()->json(['message' => 'plan not change'], 204);
        } else if (count($values) >= 1) {
            $plan = Plans::where([['id', '=', $id], ['user_id', '=', $this->user_id]])->first();
            if ($plan != null) {
                $plan->update($values);
                return response()->json(['message' => 'plan changed', 'plan' => Plans::where('id', '=',  $plan['id'])->first()], 200);
            } else {
                return response()->json(['erro' => 'plan', 'message' => 'plan not found'], 404);
            }
        }
    }

    public function delete(mixed $id)
    {
        $product = Plans::where([['id', '=', $id], ['user_id', '=', $this->user_id]])->first();

        if ($product != null) {
            $product->delete();
            return response()->json(['message' => 'product deleted'], 200);
        } else {
            return response()->json(['erro' => 'product', 'message' => 'product not found'], 404);
        }
    }
}
