<?php
require_once __DIR__ . '/../models/Film.php';

class FilmController
{
    private $db;
    private $logger;

    public function __construct()
    {
        $this->db = new Database();
        $this->logger = new Logger($this->db);
    }

    public function index(){
        $this->logger->log("Get", "Listagem de filmes requisitada.");

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $films = $this->getFilms($search);

        include __DIR__ . '/../views/films/index.php';
    }

    private function fetchApiData($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
  
        if (curl_errno($ch)) {
            $this->logger->log("API Error", "Erro ao acessar a API: " . curl_error($ch));
            curl_close($ch);
            return false;
        }
        curl_close($ch);
  
        $data = json_decode($response, true);
        if (is_null($data)) {
            $this->logger->log("API Error", "Erro ao decodificar a resposta da API: " . $response);
            return false;
        }
        return $data;
    }

    public function list($search = '')
    {
        $films = $this->getFilms($search);
        header('Content-Type: application/json');
        echo json_encode($films);
    }

    private function getFilms($search = '')
    {
        $films = [];

        $api_url = API_URL . 'films/';

        $data = $this->fetchApiData($api_url);
        if ($data) {
            foreach ($data['results'] as $idx=>$filmData) {
                $film = new Film();
                $film->pos = $idx+1;
                $film->title = $filmData['title'];
                $film->release_date = $filmData['release_date'];
                $film->url = $filmData['url'];

                // Filtrar por pesquisa
                if (empty($search) || stripos($film->title, $search) !== false) {
                    $films[] = $film;
                }
            }

        }

        // Ordenar os filmes por data de lançamento
        usort($films, function ($a, $b) {
            return strtotime($a->release_date) - strtotime($b->release_date);
        });
        return $films;
    }

    public function details($id)
    {
        $this->logger->log("Get", "Detalhes do filme {$id} requisitado.");

        $url = API_URL . 'films/'. $id;
        
        $data = $this->fetchApiData($url);
        
        if (!$data) {
            echo "Erro ao buscar os detalhes do filme.";
            return;
        }
        
        $film = new Film();
        $film->title = $data['title'];
        $film->episode_id = $data['episode_id'];
        $film->opening_crawl = $data['opening_crawl'];
        $film->release_date = $data['release_date'];
        $film->director = $data['director'];
        $film->producers = $data['producer'];

        $film->characters = [];
        foreach($data['characters'] as $characterUrl){
            $characterData = $this->fetchApiData($characterUrl);
            if ($characterData) {
                $film->characters[] = $characterData['name'];
            }
        }
         // Calcular a idade do filme
         $releaseDate = new DateTime($film->release_date);
         $currentDate = new DateTime();
         $diff = $currentDate->diff($releaseDate);
         $film->age = [
             'years' => $diff->y,
             'months' => $diff->m,
             'days' => $diff->d,
         ];

        include __DIR__ . '/../views/films/details.php';
    }

    public function apiDetails($id)
    {
        $this->logger->log("Get", "Detalhes do filme {$id} requisitado.");

        $url = API_URL . 'films/'. $id;
        
        $data = $this->fetchApiData($url);
        
        if (!$data) {
            echo "Erro ao buscar os detalhes do filme.";
            return;
        }
        
        $film = new Film();
        $film->title = $data['title'];
        $film->episode_id = $data['episode_id'];
        $film->opening_crawl = $data['opening_crawl'];
        $film->release_date = $data['release_date'];
        $film->director = $data['director'];
        $film->producers = $data['producer'];

        $film->characters = [];
        foreach($data['characters'] as $characterUrl){
            $characterData = $this->fetchApiData($characterUrl);
            if ($characterData) {
                $film->characters[] = $characterData['name'];
            }
        }
         // Calcular a idade do filme
         $releaseDate = new DateTime($film->release_date);
         $currentDate = new DateTime();
         $diff = $currentDate->diff($releaseDate);
         $film->age = [
             'years' => $diff->y,
             'months' => $diff->m,
             'days' => $diff->d,
         ];

         header('Content-Type: application/json');
         echo json_encode($film);
    }
}