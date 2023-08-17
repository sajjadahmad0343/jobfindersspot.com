<?php


namespace Modules\Candidate\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\FrontendController;
use Modules\Job\Events\CandidateDeleteApplied;
use Modules\Job\Models\JobCandidate;

class ManageCandidateController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function appliedJobs(Request $request){
        $this->checkPermission('candidate_manage');
        $query = JobCandidate::with(['jobInfo', 'candidateInfo', 'cvInfo'])->where('candidate_id', Auth::id());
        if($s = $request->get('s')){
            $query->whereHas('jobInfo', function ($q) use ($s){
                $q->where("title", 'like', '%'.$s.'%');
            });
        }
        if($status = $request->get('status')){
            $query->where('status', $status);
        }
        if($orderby = $request->get('orderby')){
            switch ($orderby){
                case 'oldest':
                    $query->orderBy('id', 'asc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        }else{
            $query->orderBy('id', 'desc');
        }

        $rows = $query->paginate(20);
        $data = [
            'rows' => $rows,
            'menu_active' => 'applied_jobs',
            'page_title' => __("Applied Jobs")
        ];
        return view('Candidate::frontend.layouts.user.applied-jobs', $data);
    }

    public function deleteJobApplied(Request $request, $id){
        $this->checkPermission('candidate_manage');
        $row = JobCandidate::query()
            ->where('candidate_id', Auth::id())
            ->where('id', $id)
            ->first();
        if (empty($row)) {
            return redirect()->back()->with('error', __('Job not found!'));
        }
        if($row->status != 'pending') {
            return redirect()->back()->with('error', __("Can't delete this item"));
        }
        //Send Email and Notify
        event(new CandidateDeleteApplied($row));

        $row->delete();

        return back()->with('success',  __('Delete successfully!') );
    }

}
