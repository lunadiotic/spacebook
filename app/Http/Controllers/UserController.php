<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    /**
     * Constructs a new instance of the class and sets the user repository.
     *
     * @param UserRepositoryInterface $userRepository The user repository to set.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Retrieves all users from the user repository and returns them as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing all users.
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return response()->json($users);
    }

    /**
     * Retrieves a user by their ID from the user repository and returns them as a JSON response.
     *
     * @param int $id The ID of the user to find.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the user if found, or a JSON response with a 'message' key set to 'User not found' if the user was not found.
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request The request object containing the data for the new resource.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the newly created resource.
     */
    public function store(Request $request)
    {
        $user = $this->userRepository->create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Updates a user's information in the database.
     *
     * @param Request $request The HTTP request object containing the updated user data.
     * @param int $id The ID of the user to update.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the updated user data, or a JSON response with a 'message' key set to 'User not found' if the user was not found.
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->update($id, $request->all());
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * Deletes a user with the given ID from the database.
     *
     * @param int $id The ID of the user to delete.
     * @return \Illuminate\Http\JsonResponse The JSON response containing a 'message' key set to 'User deleted' if the user was deleted successfully, or a JSON response with a 'message' key set to 'User not found' if the user was not found.
     */
    public function destroy($id)
    {
        $deleted = $this->userRepository->delete($id);
        if ($deleted) {
            return response()->json(['message' => 'User deleted']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}
