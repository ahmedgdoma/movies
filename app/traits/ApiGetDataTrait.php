<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 2/28/20
 * Time: 2:35 AM
 */

namespace App\traits;



use App\Configration;
use App\Genre;
use App\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

trait ApiGetDataTrait
{
    private $api_link = 'https://api.themoviedb.org/3/';
    private $iterator, $max_iteration;



    public function api_get_genres(){
        $genres = $this->GetData('genre/movie/list');
        foreach ($genres['genres'] as $genre)
            Genre::updateOrCreate($genre);

    }
    public function api_get_recent(){
        $this->iterator = 0;
        $this->max_iteration = Configration::getConfigValue('number_of_recent');
        $this->get_movie_by_type(2);
    }

    public function api_get_top_rated(){
        $this->iterator = 0;
        $this->max_iteration = Configration::getConfigValue('number_of_top_rated');
        $this->get_movie_by_type(1);
    }

    private function get_movie_by_type($type, $page = 1){
        $end_point = ($type == 1)? 'movie/top_rated': 'movie/upcoming';
        $response = $this->GetData($end_point, ['page' => $page]);
        $this->save_movie($response['results'], $type);
        if($response['total_pages'] > $page && $this->iterator < $this->max_iteration){
            $this->get_movie_by_type($type, ++$page);
        }
        Configration::where('config_name', 'last_queue_run')->update([
            'config_value'=>Carbon::now()->timestamp
        ]);
    }


    /**
     * save set of movies and it's relations
     * @param $movies array of movies per page
     * @param $type 1 => top_rated, or 2 => upcoming
     * @void return
     */
    private function save_movie($movies, $type){

        foreach ($movies as $movie){
            $item = Movie::firstOrCreate(
                ['id' => $movie['id']],
                [
                    'id' => $movie['id'],
                    'title' => $movie['title'],
                    'rate' => $movie['vote_count'],
                    'popularity' => $movie['popularity'],
                    'overview'  => $movie['overview'],
                ]);

            $item->genres()->sync($movie['genre_ids']);

            if(!$item->contain_type_id($type))
                $item->types()->attach($type);
            if(++$this->iterator >= $this->max_iteration)
                break;
        }
    }


    /**
     * function to hit https://www.themoviedb.org APIs
     * @param $end_point
     * @param null $params
     * @return array of response
     */
    private function GetData($end_point, $params = null){
        /**
         * if $params not array make it array and add api key to array
         * else add api key to array directly
         **/
        if(!is_array($params))
            $params = [];

        $params['api_key'] = env('MOVIES_API_KEY');
        $query = http_build_query($params);
        $uri = $this->api_link . $end_point . "?". $query;

        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $uri);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        return $jsonArrayResponse = json_decode($response, true);

    }

}
