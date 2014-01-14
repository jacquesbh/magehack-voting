<?php

class ProjectController extends \BaseController
{
    public function __construct(Project $project)
    {
        $this->project = $project;
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $project = Project::with('user')
            ->with('votes.user')
            ->get();

        return $project;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $user = Auth::user();

        $input = Input::all();
        $validation = Validator::make($input, Project::$rules);

        if ($validation->passes())
        {
            $input['user_id'] = $user->id;
            $input['hangout_url'] = '';
            $project = $this->project->create($input);

            return $project;
        }

        return Redirect::route('projects.index')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $project = Project::where('id','=',$id)
            ->with('user')
            ->with('votes')
            ->first();

        return $project;

    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}