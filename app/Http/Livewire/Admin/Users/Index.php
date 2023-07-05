<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $user_id;
    public $role,$searchTerm;
    protected $users;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $query = User::query();
        
        if ($this->role) {
            $role_as = ($this->role == 'admin') ? 1 : 0;
            $query->where('role_as', $role_as);
        }

        if ($this->searchTerm) {
            $query->where('email', 'like', '%'.$this->searchTerm.'%');
        }
        
        // $users = User::orderBy('id', 'DESC')->paginate(5);
        // return view('livewire.admin.users.index', compact('users'));
        $this->users = $query->paginate(5);
        return view('livewire.admin.users.index')
        ->with('users', $this->users);
    }
    public function filter()
    {
        $this->validate([
            'role' => 'required',
        ]);
    }
    public function deleteUser($user_id)
    {
        $this->user_id = $user_id;
    }

    public function destroyUser()
    {
        $user = User::find($this->user_id);
        $user->delete();
        session()->flash('message', 'Xoá người dùng thành công');
    }
}
