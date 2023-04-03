<?php

namespace TestWebDev\app\controllers;

;

use TestWebDev\app\models\Position;
use TestWebDev\app\models\User;
use TestWebDev\src\Controller;
use TestWebDev\src\Response;
use TestWebDev\src\Validator;

class UsersController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $users = (new User())->withPositions();
        return response()->json(['data' => $users]);
    }

    /**
     * @param array $request
     * @return Response
     */
    public function create(array $request): Response
    {
        $validatedData = new Validator($request);
        $validatedData->requiredField('user_name');
        $validatedData->validateString('user_name', 3, 15);
        $validatedData->requiredField('user_last_name');
        $validatedData->validateString('user_last_name', 3, 15);
        $validatedData->requiredField('user_position');
        if (!empty($validatedData->getErrors())) {
            return response()->json(['errors' => $validatedData->getErrors()], 422);
        }
        $position = (new Position())->find($request['user_position']);
        if (is_null($position)) {
            return response()->json(['errors' => ['user_position' => 'Such position not found']], 422);
        }
        $user = (new User())->create([
            'name' => $request['user_name'],
            'last_name' => $request['user_last_name'],
            'position_id' => $request['user_position']
            ]);
        if (!is_null($user)) {
            return response()->json(['data' => 'User ' . $request['user_name'] . ' created successfully'], 200);
        }
        return response()->json(['errors' => 'Something went wrong'], 422);
    }

    /**
     * @param array $request
     * @return Response
     */
    public function update(array $request): Response
    {
        $validatedData = new Validator($request);
        $validatedData->requiredField('user_name');
        $validatedData->validateString('user_name', 3, 15);
        $validatedData->requiredField('user_last_name');
        $validatedData->validateString('user_last_name', 3, 15);
        $validatedData->requiredField('user_position');
        if (!empty($validatedData->getErrors())) {
            return response()->json(['errors' => $validatedData->getErrors()], 422);
        }
        $position = (new Position())->find($request['user_position']);
        if (is_null($position)) {
            return response()->json(['errors' => ['user_position' => 'Such position not found']], 422);
        }
        $editUser = (new User())->find($request['user_id']);
        if (is_null($editUser)) {
            return response()->json(['errors' => 'User not found'], 423);
        }
        $edited = (new User())->update([
            'id' => $editUser['id'],
            'name' => $request['user_name'],
            'last_name' => $request['user_last_name'],
            'position_id' => $request['user_position']
        ]);

        if ($edited !== 0) {
            return response()->json(['data' => 'User ' . $request['user_name'] . ' updated successfully'], 200);
        }
        return response()->json(['errors' => 'Something went wrong'], 422);

    }

    /**
     * @param array $request
     * @return Response
     */
    public function delete(array $request): Response
    {
        $deletingUser = (new User())->find($request['user_id']);
        if (empty($deletingUser)) {
            return response()->json(['errors' => 'User not found'], 404);
        }
        $deletedUser = (new User())->delete($request['user_id']);
        if ($deletedUser === 0) {
            return response()->json(['errors' => 'Something went wrong'], 422);
        }
        return response()->json(['data' => 'User ' . $deletingUser['name'] . ' deleted']);
    }
}