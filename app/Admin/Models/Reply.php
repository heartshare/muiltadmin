<?php

namespace App\admin\Models;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use App\admin\Models\Account;
use Encore\Admin\Facades\Admin;

class Reply extends Model
{
    use UsesTenantConnection;
    public $timestamps = true;

    public static function boot()
    {
        parent::boot();
        static::saving(function($model){
            $uid = Admin::user()->id;
            $account = Account::where('user_id',$uid)->first();
            $accountId = $account->id;
            $model->account_id = $accountId;
        });
    }

    /**
     * 关联素材
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function material(){
        return $this->hasOne(Material::class,'id','material_id');
    }
}
