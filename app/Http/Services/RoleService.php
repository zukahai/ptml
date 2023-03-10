<?php

namespace App\Http\Services;


use App\Models\Role;
use App\Models\RoleAccount;
use Cookie;

class RoleService{
    public function __construct(Role $role){
        $this->role = $role;
    }

    public function getAll(){
        return $this->role->orderBy('id','asc')->paginate();
    }

    public function paginate($limit, $keywords){
        $role = $this->role;
        $role = $role->orderBy('created_at','desc');
        if (!empty($keywords)) {
            $role->where('name', 'like', '%'. $keywords.'%');
            
        }
        return $role->paginate($limit)->withQueryString();
    }

    public function update($id, $data){
        $this->role->where('id',$id)->update($data);
        return $this->role->find($id);
    }

    public function find($id){
        return $this->role->find($id);
    }

    public function add($role_name){
        $role = new Role();
        $role->name = $role_name;
        $role->save();
    }
    public function delete($id){
        $this->role->find($id)->delete();
       
    }
}

?>