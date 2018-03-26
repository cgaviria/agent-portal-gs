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

class FrontController extends Controller
{
    /**
     * Shows the main index page.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
		return view('front.index');
    }
	
	/**
	 * Shows the new agent signup page.
	 *
	 * @return Response
	 */
	public function getNewAgentSignup(Request $request)
	{
		return view('welcome');
	}
	
	/**
	 * Shows the request training page.
	 *
	 * @return Response
	 */
	public function getRequestTraining(Request $request)
	{
		return view('welcome');
	}
	
	/**
	 * Shows the how we work page.
	 *
	 * @return Response
	 */
	public function getHowWeWork(Request $request)
	{
	    return view('front.howwework');
	}
	
	/**
	 * Shows the marketing/collateral page.
	 *
	 * @return Response
	 */
	public function getMarketingCollateral(Request $request)
	{
		return view('welcome');
	}
	
	/**
	 * Shows the newsletter archive page.
	 *
	 * @return Response
	 */
	public function getNewsletterArchive(Request $request)
	{
		return view('front.newsletter_archive');
	}

	/**
	 * Shows the webinars and events page.
	 *
	 * @return Response
	 */
	public function getWebinarsAndEvents(Request $request)
	{
		return view('front.webinars_and_events');
	}

    /**
     * Shows the booking booster page.
     *
     * @return Response
     */
    public function getBookingBooster(Request $request)
    {
        return view('front.booking_booster');
    }

    /**
     * Shows the xml feed.
     *
     * @return Response
     */
    public function getFeed(Request $request)
    {
        return view('feed');
    }

    /**
     * Shows the groups page.
     *
     * @return Response
     */
    public function getGroups(Request $request)
    {
        return view('front.groups');
    }

    /**
     * Shows the groups page.
     *
     * @return Response
     */
    public function getTravelAgentFAQ(Request $request)
    {
        return view('front.travel_agent_faq');
    }

    /**
     * Shows the customer reviews page.
     *
     * @return Response
     */
    public function getCustomerReviews(Request $request)
    {
        return view('front.customer_reviews');
    }

    /**
     * Shows the groups page.
     *
     * @return Response
     */
    public function getMediaCenter(Request $request)
    {
        return view('front.media_center');
    }

    /**
     * Shows the xml comments feed.
     *
     * @return Response
     */
    public function getCommentsFeed(Request $request)
    {
        return view('comments_feed');
    }
}