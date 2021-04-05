<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $service;

    /** @var  ValidatorInterface $validator */
    protected $validator;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($this->service->all($request->query->get('limit', 15)));
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return response()->json($this->service->find($id));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store(Request $request)
    {
        if ($this->validator) {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        $response = $this->service->create($request->all());
        $this->createLog($response['data']['id'],'Criação');
        return response()->json($response);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws ValidatorException
     */
    public function update(Request $request, $id)
    {
        if ($this->validator) {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }
        $this->createLog($id,'Atualizar');
        return response()->json($this->service->update($request->all(), $id));
    }

    /**
     * Restore the specified resource from storage.
     * @param $id
     * @return array
     */
    public function restore($id)
    {
        $this->createLog($id,'Restaurou');
        return $this->service->restore($id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->createLog($id,'Colocou na lixeira');
        return response()->json($this->service->delete($id), 200);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findWhere(array $data)
    {
        return $this->service->findWhere($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function template()
    {
        return view('welcome');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAddressByCep(Request $request)
    {
        $cep = $request->get('cep');
        $cep = preg_replace("/[.\/-]/", '', $cep);
        return $this->service->getAddressByCep($cep);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function findCompanyByCnpj(Request $request)
    {
        $cnpj = $request->get('cnpj');
        $cnpj = preg_replace("/[.\/-]/", '', $cnpj);
        return $this->service->findCompanyByCnpj($cnpj);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUserLogged()
    {
        return $this->service->getUserLogged();
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUserLoggedWith()
    {
        return $this->service->getUserLoggedWith();
    }

  }
