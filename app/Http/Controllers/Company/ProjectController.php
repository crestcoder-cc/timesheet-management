<?php

namespace App\Http\Controllers\Company;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\ProjectStoreRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        return view('company.project.index');
    }
    public function getDatatable(Request $request)
    {
        $project = Project::where('company_id',Auth::guard('company')->user()->id)->get();
        return Datatables::of($project)
            ->addColumn('action', function ($project) {
                $actions['edit'] = route('company.project.edit', [$project->id]);
                $actions['delete'] = $project->id;
                $array = [
                    'id' => $project->id,
                    'actions' => $actions
                ];
                return AdminDataTableButtonHelper::datatableButton($array);
            })
            ->addColumn('status', function ($employee) {
                return AdminDataTableBadgeHelper::statusBadge($employee);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function create()
    {
        return view('company.project.create');
    }
    public function store(ProjectStoreRequest $request)
    {
        if ((int)$request['edit_value'] === 0) {
            $project = new Project();
            $project->name = $request->name;
            $project->company_id = Auth::guard('company')->user()->id;
            $project->save();
            return response()->json([
                'message' => 'Project added successfully',
            ]);
        } else {
            $editId = $request['edit_value'];
            $project = Project::find($editId);
            $project->name = $request->name;
            $project->company_id = Auth::guard('company')->user()->id;
            $project->save();

            return response()->json([
                'message' => 'Project updated successfully',
            ]);
        }
    }
    public function edit($id)
    {
        $project = Project::find($id);
        return view('company.project.edit', compact('project'));
    }
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully',
        ]);
    }
    public function changeStatus($id, $status)
    {
        $project = Project::find($id);
        $project->status = $status;
        $project->save();

        return response()->json([
            'message' => 'Project status updated successfully',
        ]);
    }
}
