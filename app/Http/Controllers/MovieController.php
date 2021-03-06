<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReviewController;

class MovieController extends Controller
{
	private Movie $movie;
	const ERROR_404_PAGE = 'errors.404';
	//Returns a page with the information of a movie
	public function show($id)
	{
		if (!ctype_digit($id)) {
			return view(self::ERROR_404_PAGE);
		}

		$movie = Movie::find($id);

		if ($movie == null) {
			return view(self::ERROR_404_PAGE);
		}

		$reviews = $movie->reviews()->orderBy("date", "DESC")->paginate(10);

		$user_review = null;

		if (auth()->user() != null) {
			$user_review = $movie->reviews()->where('user_id', auth()->user()->id)->first();
		}

		return view('pages.movie', [
			'movie' => $movie,
			'reviews' => $reviews,
			'user_review' => $user_review
		]);
	}

	public function getPage($id, $page)
	{
		if (!ctype_digit($id) || !ctype_digit($page)) {
			return view(self::ERROR_404_PAGE);
		}
		$r = Movie::find($id);
		if ($r == null) {
			return view(self::ERROR_404_PAGE);
		}
		$this->movie = $r;
		$this->movie->genres = $this->getGenres($id);
		$this->movie->reviews = ReviewController::movieReviews($this->movie, $page);
		return view('pagination.movie', ['movie' => $this->movie]);
	}

	//Returns a page with a form to add a movie
	public function add_page()
	{

		$this->authorize('create', Movie::class);

		$genres = Genre::all();

		return view(
			'pages.add_movie',
			[
				'movie' => null,
				'genres' => $genres,
			]
		);
	}

	//Returns a page with a form to edit a movie
	public function edit_page($id)
	{

		if (!ctype_digit($id)) {
			abort(404);
		}

		$this->authorize('update', Movie::class);

		$movie = Movie::find($id);
		$genres = Genre::all();
		if ($movie == null) {
			abort(404);
		}
		return view(
			'pages.add_movie',
			[
				'movie' => $movie,
				'genres' => $genres,
			]
		);
	}

	//Edits a movie
	public function edit(Request $request, $id)
	{
		if (!ctype_digit($id)) {
			abort(404);
		}
		$this->authorize('update', Movie::class);

		$this->validate($request, [
			'movieName' => 'required',
			'year' => 'required|numeric|min:1900',
			'movieDescription' => 'string'
		]);

		$movie = Movie::find($id);

		if ($movie != null) {
			$movie->title = $request->movieName;
			$movie->year = $request->year;
			$movie->description = $request->movieDescription;

			if ($request->moviePoster != null) {
				$this->validate($request, [
					'movieName' => 'required',
					'year' => 'required|numeric|min:1900',
					'movieDescription' => 'string',
					'moviePoster' => 'image'
				]);

				$imageName = time() . '_' . auth()->user()->username . '.' . $request->moviePoster->extension();
				$request->moviePoster->move(public_path('img'), $imageName);

				$movie->photo = 'img/' . $imageName;
			}

			$tagNames = $request->get('tags');
			$tagIds = [];

			foreach ($tagNames as $tagName) {

				$tag = Genre::firstOrCreate(['genre' => $tagName]);

				if ($tag) {
					$tagIds[] = $tag->id;
				}
			}

			$movie->genres()->sync($tagIds);

			$movie->save();
		}

		return redirect('movie/' . $id);
	}

	/**
	 * Creates a new movie.
	 *
	 * @return Movie The movie created.
	 */
	public function create(Request $request)
	{

		$this->authorize('create', Movie::class);

		$this->validate($request, [
			'movieName' => 'required',
			'year' => 'required|numeric',
			'movieDescription' => 'string',
			'moviePoster' => 'required|image'
		]);

		$imageName = time() . '_' . auth()->user()->username . '.' . $request->moviePoster->extension();

		$request->moviePoster->move(public_path('img'), $imageName);

		$movie = Movie::create([
			'title' => $request->movieName,
			'year' => $request->year,
			'description' => $request->movieDescription,
			'photo' => 'img/' . $imageName,
		]);



		if ($movie) {
			$tagNames = $request->get('tags');
			$tagIds = [];
			foreach ($tagNames as $tagName) {

				$tag = Genre::firstOrCreate(['genre' => $tagName]);
				if ($tag) {
					$tagIds[] = $tag->id;
				}
			}
			$movie->genres()->sync($tagIds);
		}


		return redirect()->route('landing_page');
	}

	//Deletes a movie
	public function delete(Request $request, $id)
	{
		if (!ctype_digit($id)) {
			abort(404);
		}

		$this->authorize('delete', Movie::class);

		$movie = Movie::find($id);

		$movie->delete();

		return $movie;
	}

	private function getGenres(int $id)
	{
		return DB::select('SELECT genre.genre FROM genre INNER JOIN movie_genre ON genre.id = movie_genre.genre_id INNER JOIN movie ON movie_genre.movie_id = movie.id WHERE (movie.id = :id) ', ['id' => $this->movie->id]);
	}
}
