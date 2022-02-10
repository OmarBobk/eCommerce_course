<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['manage_tags', 'show_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }
        $tags = Tag::with('products')
            ->when(\request()->keyword != null, function ($q) {
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($q) {
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.tags.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        return view('backend.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return RedirectResponse
     */
    public function store(TagRequest $request): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $name = $request->name;

        $data = [
            'name'   => $name,
            'status' => $request->status,
            'slug'   => Str::slug($name),
        ];

        Tag::create($data);

        return redirect()->route('admin.tags.index')
            ->with([
                'msg' => 'Created Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Tag $tag)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['display_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        return view('backend.tags.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Tag $tag)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        return view('backend.tags.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(
        TagRequest $request,
        Tag        $tag
    ): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $name = $request->name;
        $data = [
            'name'   => $name,
            'status' => $request->status,
            'slug'   => Str::slug($name),
        ];

        $tag->update($data);

        return redirect()->route('admin.tags.index')
            ->with([
                'msg' => 'Updated Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['delete_tags'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with([
                'msg' => 'Deleted Successfully',
                'alert-type' => 'danger',
            ]);
    }

}
