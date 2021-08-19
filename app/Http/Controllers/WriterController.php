<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResources\UserResource;
use App\Models\Role;
use App\Models\User;

class WriterController extends Controller
{
    /**
     * Display a listing of all writers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select(['name', 'surname', 'position', 'description', 'avatar_url'])
            ->where('role_id', Role::IS_WRITER)
            ->withCount('articles')
            ->orderBy('articles_count')
            ->paginate(50);
    }

    /**
     * Display the specified writer with their articles.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::with('articles')
            ->withCount('articles')
            ->findOrFail($id));
    }
}
