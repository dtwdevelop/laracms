<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Article;
use App\ArticleCategory;
use App\User;
use App\Video;
use App\VideoAlbum;
use App\Photo;
use App\PhotoAlbum;
use Mail;
use Exception;

class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{

        if (isset($_GET['mail'])) {
            try {
                Mail::raw('Text to e-mail', function ($message) {
                    $message->from(config('mail.username'), 'Test');

                    $message->to('mevrael@gmail.com');
                });
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            exit;
        }


        /*$news = Article::count();
        $newscategory = ArticleCategory::count();
        $users = User::count();
        $photo = Photo::count();
        $photoalbum = PhotoAlbum::count();
        $video = Video::count();
        $videoalbum = VideoAlbum::count();*/
		return view('admin.dashboard.index');
	}
}