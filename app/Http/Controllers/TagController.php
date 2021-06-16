<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{

    public function DeleteMultiTags(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->get('delete_type');
            $del_ids = $request->get('deleteids_arr');
            if ($type == 'multiple') {
                foreach ($del_ids as $id) {
                    Tag::find($id)->delete();
                }
                exit;
            }
        } else {
            echo '2';
        }
    }

    public function getTags()
    {
        $tags = Tag::all();
        return DataTables::of($tags)
            ->addColumn('checkbox', function (Tag $tag) {
                return '<div class="form-check">
                            <input class="delete_check" type="checkbox"
                                value="' . $tag->id . '">
                        </div>';
            })
            ->addColumn('action', function (Tag $tag) {
                return '<a id="editbtn" href="' . route("admin.tag.edit", $tag->id) . '" class="btn btn-sm btn-success bg-success" title="Edit">
                            <i class="fas fa-edit"></i>
                                Edit
                        </a>';
            })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }

    public function index()
    {
        $tags = Tag::all();
        // dd($tags);
        return view('admin.tag.index', [
            'tags' => $tags,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit', [
            'page' => $request->input('page'),
            'tag' => $tag,
        ]);
    }

    public function update(Request $request, $id)
    {
        Tag::find($id)->update([
            'name' => $request->input('name'),
        ]);
        return back()->with('success', 'Updated Successfully');
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        Tag::create($request->only('name'));
        return back()->with('success', 'Successfully Created');
    }

    public function deleteAllTag()
    {
        return 'delete all';
    }

    public function deleteMultipleTag()
    {
        return 'multi delete';
    }
}
