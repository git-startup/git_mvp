<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use App\Settings;
use App\Comment;
use App\Message;
use Auth;

class ArticlesController extends Controller
{
     public function index(){

        if(isset($_GET['query'])){
            $query = $_GET['query'];
            $articles = Articles::where('heading','LIKE',"%$query%")
                                  ->orWhere('slug','LIKE','%$query%')
                                  ->where('is_published',1)
                                  ->get();
            $messagesCount = Message::where('to','=',Auth::user()->id)
                ->orwhere('from','=',Auth::user()->id)->count();                    
        }else{
        	$articles = Articles::where('is_published',1)->get();
        	$messagesCount = Message::where('to','=',Auth::user()->id)
                ->orwhere('from','=',Auth::user()->id)->count();
        }
    	return view('articles.list')
    			->with('articles',$articles)
    			->with('messagesCount',$messagesCount);
    }

    public function getArticle($slug){

    	$article = Articles::where('is_published',1)
    				->where('slug',$slug)
    				->first();
        //$posts = Post::with('user')->get();
    	$messagesCount = Message::where('to','=',Auth::user()->id)
                ->orwhere('from','=',Auth::user()->id)->count();

        if($article){
            $related_articles = Articles::where('is_published',1)
                            ->where('category_id',$article->category_id)
                            ->where('id','!=',$article->id)
                            ->get();

            return view('articles.single')
                    ->with('article',$article)
                    ->with('messagesCount',$messagesCount)
                    ->with('related_articles',$related_articles);
        }else{

            return redirect()->back()->with('info','no article with this name');
        }

    }
} 
