<?php 
namespace App\Services;

use Illuminate\Support\Facades\DB;

class TechnicianService

{
    public function getTechnicians($usertype = null, $search = null)
    {
        $query = DB::connection('mysqlDtr')
            ->table('users')
            ->join(DB::connection('mysqlDts')->getDatabaseName() . '.users as dts_users', 'users.userid', '=', 'dts_users.username')
            ->join(DB::connection('mysqlDts')->getDatabaseName() . '.division as dts_division', 'dts_division.id', '=', 'dts_users.division')
            ->join(DB::connection('mysqlDts')->getDatabaseName() . '.section as dts_section', 'dts_section.id', '=', 'dts_users.section')
            ->join(DB::connection('mysqlDts')->getDatabaseName() . '.designation as dts_designation', 'dts_designation.id', '=', 'dts_users.designation')
            ->select(
                'users.username',
                'users.password',
                DB::raw("concat(users.fname,' ',users.lname) as name"),
                'users.fname',
                'users.lname',
                'users.mname',
                'users.userid',
                'users.id',
                'dts_division.description as division',
                'dts_section.description as section',
                'dts_designation.description as designation'
            )
            ->where('dts_section.id', 80);

        if($search){
            $query->where(function ($q) use ($search){
                $q->whereRaw("concat(users.fname, ' ', users.lname) like ?", ['%' . $search . '%'])
                    ->orwhere('users.fname','like', '%' . $search . '%')
                    ->orWhere('users.lname', 'like', '%' . $search . '%')
                    ->orWhere('designation', 'like', '%' . $search . '%')
                    ->orWhere('users.userid', 'like', '%' . $search . '%');
            });
        }

        if ($usertype) {
            $query->where('users.usertype', $usertype);
        }

        return $query->paginate(10);
    }
}
