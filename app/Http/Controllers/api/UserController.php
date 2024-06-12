<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
      /**
     * RETORNA UMA LISTA PAGINADA DE USUÁRIOS.
     *
     * ESTE MÉTODO RECUPERA UMA LISTA PAGINADA DE SUÁRIOS DO BANCO DE DADOS E RETORNA COMO UMA RESPOSTA JSON
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
          // RECUPERA OS USUÁRIOS DO BANCO DE DADOS, ORDENADOS PELO ID EM ORDEM DECRESCENTE , PAGINADOS.
        $users = User::orderBy('id', 'DESC')->paginate(3);

          // RETORNA OS USUÁRIOS RECUPERADOS COMO UMA RESPOSATA JSON
        return response()->json([
            'status' => true,
            'users'  => $users
        ], 200);
    }

      /**
     * EXIBE OS DETALHES DE UM USUÁRIO SELECIONADO PELO ID.
     * ESTE MÉTODO RETORNA OS DETALHES DE UM USUÁRIO ESPECIFICO EM FORMATO JSON.
     * @param \App\Models\User $user o objeto do usuario a ser exibido
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
          // RETORNA OS DETALHES DO USUÁRIO PELO ID EM FORMATO JSON
        return response()->json([
            'status' => true,
            'user'   => $user
        ], 200);
    }
      /**
     * CRIA NOVO USUÁRIO COM OS DADOS FORNECIDOS NA REQUISIÇÃO.
     * @param \App\Http\Requests\UserRequest $request o objeto de requisição contendo os dados do usuário a ser criado.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
          // INICIAR A TRANSAÇÃO
        DB::beginTransaction();

        try {

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password
            ]);

              // OPERAÇÃO CONCLUÍDA COM EXITO
            DB::commit();

              // MENSAGEM DE SUCESSO!
            return response()->json([
                'status'  => true,
                'user'    => $user,
                'message' => "Usuário cadastrado com sucesso!"
            ], 201);

        } catch (Exception $e) {
              // OPERAÇÃO NÃO CONCLUÍDA
            DB::rollBack();

              // RETORNA UMA MENSAGEM DE ERRO STATUS 400
            return response()->json([
                'status'  => false,
                'message' => "Usuário não cadastrado!"
            ], 400);
        }
    }
      /**
     * ATUALIZAR OS DADOS DE UM USUÁRIO EXISTENTE COM BASE NOS DADOS FORNECEIDOS NA REQUISIÇÃO.
     * @param \App\Models\User
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
          //INICIAR A TRANSAÇÃO
        DB::beginTransaction();

        try {
              //EDITAR O USUÁRIO BANCO DADOS
            $user->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password
            ]);

              // EDIÇÃO CONCLUÍDA COM SUCESSO
            DB::commit();

              // RETORNA OS DADOS DO USUÁRIO EDITADO COM SUCESSO
            return response()->json([
                'status'  => true,
                'user'    => $user,
                'message' => "Usuário editado com sucesso!"
            ], 200);

        } catch (Exception $e) {
              //OPERAÇÃO NÃO CONCLUÍDA
            DB::rollBack();

              // RETORNA UMA MENSAGEM DE ERRO STATUS 400
            return response()->json([
                'status'  => false,
                'message' => "Usuário não editado!"
            ], 400);
        }
    }

      /**
     * EXCLUIR USUÁRIO DO BANCO DE DADOS
     * @param \App\Models\User $user usuario que será excluido
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
              //APAGAR O REGISTRO NO BANCO DE DADOS
            $user->delete();

              // RETORNA UMA MENSAGEM DE USUÁRIO DELETADO COM SUCESSO
            return response()->json([
                'status'  => true,
                'user'    => $user,
                'message' => "Usuário deletado com sucesso!"
            ], 200);

        } catch (Exception $e) {
              // RETORNA MENSSAGEM DE ERRO COM STATUS 400
            return response()->json([
                'status'  => false,
                'message' => "Usuário não apagado!"
            ], 400);
        }
    }

}
