<?php 
namespace App\Libraries {
use App\Country;
use App\UserLogs;
use Illuminate\Support\Fluent;
class Logs {
    public function store($data) {
       // dd($data);
        $externalContent = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
        $externalIp = $m[1];
        $dd = \Location::get($externalIp);
        $mm = new Fluent($dd);
       
        $result  = array(
            'user_id'       => $data['user_id'],
            'user_name'     => $data['user_name'],
            'page_id'       => $data['page_id'],
            'page_name'     => $data['page_name'],
            'action'        => $data['action'],
            'ip_address'    => $externalIp,
            'latitude'      => $mm['latitude'],
            'longitude'     => $mm['longitude'],
            'country'       => $mm['countryCode'],
            'country_name'  => Country::where('code',$mm['countryCode'])->first()->name,
            'city'          => $mm['cityName'],
            'region'        => $mm['regionName'],
        );
        return UserLogs::create($result);
    }
}

}
?>