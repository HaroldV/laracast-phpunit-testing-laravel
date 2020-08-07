<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($users)
    {
        $this->guardAgaintsTooManyMembers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($users);
    }

    public function remove($users = null)
    {
        if($users instanceof User){
            return $users->leaveTeam();
        }

        return $this->removeMany($users);
    }

    /**
     *  this update team_id only array
     */
    public function removeMany($users)
    {
        $this->members()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id' => null]);
    }

    public function restart()
    {
        return $this->members()->update(['team_id' => null]);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    protected function maximumSize()
    {
        return $this->size;
    }

    protected function guardAgaintsTooManyMembers($users)
    {
        $numUsersToAdd = ($users instanceof User) ? 1 : $users->count();

        $newTeamCount = $this->count() + $numUsersToAdd;

        if($newTeamCount > $this->maximumSize()) {
            throw new \Exception;
        }
    }
}
