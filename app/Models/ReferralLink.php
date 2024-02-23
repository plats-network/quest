<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ReferralLink extends Model
{
    //use HasFactory;

    protected $fillable = ['user_id', 'referral_program_id'];

    protected static function boot2()
    {
        static::creating(function (ReferralLink $model) {
            $model->generateCode();
        });
    }

    private function generateCode()
    {
        $this->code = (string)Uuid::uuid1();
    }

    public static function getReferral($user, $program)
    {
//        return static::firstOrCreate([
//            'user_id' => $user->id,
//            'referral_program_id' => $program->id
//        ]);
        $ModelReferralLink =  static::where('user_id', $user->id)
            ->where('referral_program_id', $program->id)
            ->first();
        if($ModelReferralLink){
            return $ModelReferralLink;

        }else{
            $ModelReferralLink = new ReferralLink();
            //Set code uuid
            $ModelReferralLink->code = (string)Uuid::uuid1();
            $ModelReferralLink->user_id = $user->id;
            $ModelReferralLink->referral_program_id = $program->id;
            $ModelReferralLink->save();
            return $ModelReferralLink;
        }
    }
    //Create One Referral Link

    public static function createOneReferralLink($user, $program)
    {
        $ModelReferralLink =  static::where('user_id', $user->id)
            ->where('referral_program_id', $program->id)
            ->first();

        if($ModelReferralLink){
            return $ModelReferralLink;

        }else{
            return static::create([
                'user_id' => $user->id,
                'referral_program_id' => $program->id
            ]);
        }
    }

    public function getLinkAttribute()
    {
        return url($this->program->uri) . '?ref=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        // TODO: Check if second argument is required
        return $this->belongsTo(ReferralProgram::class, 'referral_program_id');
    }

    public function relationships()
    {
        return $this->hasMany(ReferralRelationship::class);
    }
}
