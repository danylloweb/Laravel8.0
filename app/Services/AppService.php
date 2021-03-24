<?php

namespace App\Services;

use App\AppHelper;
use GuzzleHttp\Client;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AppService
 * @package App\Services
 */
class AppService
{
    /**
     * @var
     */
    protected $repository;

    /**
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 20)
    {
        return $this->repository->paginate($limit);
    }

    /**
     * @param array $data
     * @param bool $skipPresenter
     * @return mixed
     */
    public function create(array $data, $skipPresenter = false)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $skipPresenter ? $this->repository->skipPresenter()->create($data) : $this->repository->create($data);
    }

    /**
     * @param $id
     * @param bool $skip_presenter
     * @return mixed
     */
    public function find($id, $skip_presenter = false)
    {
        if ($skip_presenter) {
            return $this->repository->skipPresenter()->find($id);
        }
        return $this->repository->find($id);
    }

    /**
     * @param array $data
     * @param $id
     * @param bool $skipPresenter
     * @return array|mixed
     */
    public function update(array $data, $id, $skipPresenter = false)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $skipPresenter ? $this->repository->skipPresenter()->update($data, $id) : $this->repository->update($data, $id);
    }

    /**
     * @param array $data
     * @param bool $first
     * @param bool $presenter
     * @return mixed
     */
    public function findWhere(array $data, $first = false, $presenter = false)
    {
        if ($first) {
            return $this->repository->skipPresenter()->findWhere($data)->first();
        }
        if ($presenter) {
            return $this->repository->findWhere($data);
        }
        return $this->repository->skipPresenter()->findWhere($data);

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findLast(array $data)
    {
        return $this->repository->skipPresenter()->findWhere($data)->last();
    }

    /**
     * Remove the specified resource from storage using softDelete.
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return ['success' => (boolean)$this->repository->delete($id)];
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
  /*  public function getUserLogged()
    {
        return Auth::user();
    }*/


    /**
     * @param $value
     * @return string
     */
    public function removeSpaces($value)
    {
        return AppHelper::removeSpaces($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function removeSpecialCharacters($value)
    {
        return AppHelper::removeSpecialCharacters($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function removeAccentuation($value)
    {
        return AppHelper::removeAccentuation($value);
    }

    /**
     * @param $date
     * @return false|string
     */
    public function formatDateDB($date)
    {
        return AppHelper::formatDateDB($date);
    }

    /**
     * @param $value
     * @return int|null
     */
    public function getAgeByDateBirth($value)
    {
        return AppHelper::getAgeByDateBirth($value);
    }

    /**
     * @param $cep
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAddressByCep($cep)
    {
        try {
            $client   = new Client();
            $url      = 'https://viacep.com.br/ws/';
            $cep      = preg_replace("/[.\/-]/", '', $cep);
            $res      = $client->request('GET', $url . $cep . '/json/');
            $response = (object)json_decode($res->getBody(), true);

            if (isset($response->erro) && $response->erro) {
                throw new \Exception("CEP não encontrado!");
            }

            return [
                'zip_code'    => $cep,
                'street'      => $response->logradouro,
                'district'    => $response->bairro,
                'city'        => $response->localidade,
                'city_'       => $this->removeAccentuation($response->localidade),
                'uf'          => $response->uf,
                'street_view' => 'maps.google.co.in/maps?q=' . $cep
            ];
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 422);
        }

    }

    /**
     * Busca de informações de um Cnpj informado, api da receita
     *
     * @param $cnpj
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function findCompanyByCnpj($cnpj)
    {
        try {
            $client   = new Client();
            $url      = 'https://www.receitaws.com.br/v1/cnpj/';
            $cnpj     = preg_replace("/[.\/-]/", '', $cnpj);
            $endpoint = $url . $cnpj;
            $res      = $client->request('GET', $endpoint);
            $data     = json_decode($res->getBody(), true);
            $data     = (object) $data;
            return [
                'cnpj'            => $cnpj,
                'created'         => $data->abertura,
                'status'          => $data->situacao,
                'status_date'     => $data->data_situacao,
                'name'            => $data->nome,
                'email'           => $data->email,
                'phone'           => $data->telefone,
                'associates'      => $data->qsa,
                'activities'      => $data->atividades_secundarias,
                'activity'        => $data->atividade_principal,
                'share_capital'   => $data->capital_social,
                'address'     => [
                    'zip_code'    => $data->cep,
                    'number'      => $data->numero,
                    'street'      => $data->logradouro,
                    'district'    => $data->bairro,
                    'city'        => $data->municipio,
                    'uf'          => $data->uf,
                    'complement'  => $data->complemento
                ],
            ];

        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 422);
        }
    }


    /**
     * @param $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMail($data):void
    {
        $endpoint = "http://127.0.0.1:9000/sendMail";
        $options  = [
          'headers' => ['Content-Type' => 'application/json'],
          'body'    => json_encode($data)
        ];
        $this->getHttpClient()->request('POST', $endpoint, $options);

    }
    /**
     * @return Client
     */
    private function getHttpClient()
    {
        return new Client();
    }
}
