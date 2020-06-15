<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($user)
    {
        $this->guardAgaintsTooManyMembers();

        $method = $user instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($user);
    }

    public function remove(User $user)
    {
        return $user->leaveTeam();
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

    protected function guardAgaintsTooManyMembers()
    {
        if($this->count() >= $this->size)
            throw new \Exception;
    }
}
