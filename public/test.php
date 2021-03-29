<?php
$mysqli = new mysqli("dedi4454.your-server.de", "hzkmbi_2", "bSRSkVJa9LdHgb96", "hzkmbi_db2");
if ($mysqli->connect_error) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
ini_set('memory_limit', '-1');
set_time_limit(0);

//$visitsDomainRecordsSql = $mysqli->query("SELECT domain_id FROM visits GROUP BY domain_id");
//$all_visits_domains = $visitsDomainRecordsSql->fetch_all(MYSQLI_ASSOC);
//foreach ($all_visits_domains as $all_visits_domain) {
//    $domain_id = $all_visits_domain['domain_id'];
//    $visitsDateRecordsSql = $mysqli->query("SELECT DATE_FORMAT(created_at, '%Y-%m-%d') AS `date` FROM visits WHERE domain_id='" . $domain_id . "' GROUP BY DATE_FORMAT(created_at, '%Y-%m-%d')");
//    $all_visits_dates = $visitsDateRecordsSql->fetch_all(MYSQLI_ASSOC);
//    foreach ($all_visits_dates as $all_visits_date) {
//        $date = $all_visits_date['date'];
//        $visitsIpRecordsSql = $mysqli->query("SELECT id FROM visits WHERE is_updated='0' AND domain_id='" . $domain_id . "' AND `created_at` LIKE '" . $date . "%' GROUP BY ip");
//        $all_visits_Ip = $visitsIpRecordsSql->fetch_all(MYSQLI_ASSOC);
//        if (!empty($all_visits_Ip)) {
//            $total_visits_count = count($all_visits_Ip);
//            $mysqli->query("insert into daily_visits(`domain_id`,`day`,`visits`)values('" . $domain_id . "','" . $date . "','" . $total_visits_count . "')");
//            $mysqli->query("update visits set is_updated='1' where domain_id='" . $domain_id . "' and created_at like '" . $date . "%'");
//        } else {
//            echo $domain_id . "==" . $date . "<br>";
//        }
//    }
//}
