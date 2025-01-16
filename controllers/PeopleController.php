<?php
require_once __DIR__ . '/../models/Film.php';
require_once __DIR__ . '/../models/People.php';

class PeopleController
{
    private $db;
    private $logger;

    public function __construct()
    {
        $this->db = new Database();
        $this->logger = new Logger($this->db);
    }

    public function index(){
        $this->logger->log("Get", "Listagem de pessoas requisitada.");

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $data = $this->getPeople($search);

        include __DIR__ . '/../views/people/index.php';
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

    private function getPeople($search = '')
    {
        $persona = [];

        $api_url = PSP_API_URL . 'api/people/';

        $data = $this->fetchApiData($api_url);
        if ($data) {
            foreach ($data['results'] as $idx=>$peopleData) {
                $person = new People();
                $person->name = $peopleData['name'];
                $person->pos = $idx+1;
                $person->release_date = $peopleData['mass'];
                $person->birth_year = $peopleData['birth_year'];
                $person->gender = $peopleData['gender'];
                $person->species = $peopleData['species'];
                $person->url = $peopleData['url'];

                // Filtrar por pesquisa
                if (empty($search) || stripos($person->name, $search) !== false) {
                    $persona[] = $person;
                }
            }

        }

        // Ordenar os filmes por data de lançamento
        // usort($persona, function ($a, $b) {
        //     return ($a->birth_year - $b->birth_year);
        // });
        return $persona;
    }

    public function details($id)
    {
        $this->logger->log("Get", "Detalhes da pessoa {$id} requisitado.");

        $url = PSP_API_URL . 'api/people/'. $id;
        
        $data = $this->fetchApiData($url);
        
        if (!$data) {
            echo "Erro ao buscar os detalhes da pessoa.";
            return;
        }
        
        $people = new People();
        $people->name = $data['name'];
        $people->height = $data['height'];
        $people->mass = $data['mass'];
        $people->gender = $data['gender'];
        $people->homeworld = $data['homeworld'];
        $people->species = $data['species'];


        include __DIR__ . '/../views/people/details.php';
    }
}