<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Retrieve all users from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Find a user by their ID.
     *
     * @param int $id The ID of the user to find.
     * @return User|null The found user or null if not found.
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Create a new user in the database.
     *
     * @param array $data The data to create the user with.
     * @return \App\Models\User The newly created user.
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * Updates a user's data in the database.
     *
     * @param int $id The ID of the user to update.
     * @param array $data The new data for the user.
     * @return User|null The updated user object, or null if the user was not found.
     */
    public function update($id, array $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    /**
     * Deletes a user with the given ID from the database.
     *
     * @param int $id The ID of the user to delete.
     * @return bool True if the user was deleted successfully, false otherwise.
     */
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
