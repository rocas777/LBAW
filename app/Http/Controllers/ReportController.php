<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Review;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //Reports review
    public function report_review(Request $request, $id)
    {

        if (!ctype_digit($id)) {
            abort(404);
        }
        $this->authorize('report', [Review::class, Review::find($id)]);

        $request->user()->reported()->create([
            'review_id' => $id
        ]);
    }

    //Discards review
    public function discard(Request $request, $id)
    {
        if (!ctype_digit($id)) {
            abort(404);
        }
        $this->authorize('discardReport', [Report::class, $request->user()]);

        $reports = Report::where('review_id', $id);

        $reports->delete();
    }
}
