<?php

namespace App\Policies;

use App\Song;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any songs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function view(User $user, Song $song)
    {
        //
    }

    /**
     * Determine whether the user can create songs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can update the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function update(User $user, Song $song)
    {
        return $user->id === $song->user_id;
    }

    /**
     * Determine whether the user can delete the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function delete(User $user, Song $song)
    {
        return $user->id === $song->user_id;
    }

    /**
     * Determine whether the user can restore the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function restore(User $user, Song $song)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the song.
     *
     * @param  \App\User  $user
     * @param  \App\Song  $song
     * @return mixed
     */
    public function forceDelete(User $user, Song $song)
    {
        //
    }
}
