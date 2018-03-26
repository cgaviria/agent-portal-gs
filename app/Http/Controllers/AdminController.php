<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectFile;
use App\ProjectFileTag;
use App\Repositories\ProjectFiles\ProjectFileRepository;
use App\Repositories\ProjectFileTags\ProjectFileTagsRepository;
use App\Repositories\Projects\Criteria\Search;
use App\Repositories\Projects\ProjectRepository as ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    /**
     * Shows the main index page.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
		return view('admin.index');
    }

    /**
     * Shows the login page.
     *
     * @return Response
     */
    public function getLogin(Request $request)
    {
        return view('login.index');
    }
}