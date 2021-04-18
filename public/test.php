<?php
$mysqli = new mysqli("dedi4454.your-server.de", "hzkmbi_2", "bSRSkVJa9LdHgb96", "hzkmbi_db2");
if ($mysqli->connect_error) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$mysqli->set_charset("utf8mb4");
ini_set('memory_limit', '-1');
set_time_limit(0);
echo '<pre>';

//$incrementId = 13830;
//$visitsPerDayDomainRecordsSql = $mysqli->query("SELECT * FROM daily_visits where day='2021-04-14'");
//$visitsPerDayDomainRecordsSql = $mysqli->query("SELECT * FROM domains WHERE domain LIKE '%xn--%'");
//$all_visits_domains = $visitsPerDayDomainRecordsSql->fetch_all(MYSQLI_ASSOC);
//print_r($all_visits_domains);
die;
//foreach ($all_visits_domains as $all_visits_domain) {
//    $mysqli->query("delete from visits_per_days where id='" . $all_visits_domain['id'] . "'");
//    $array_keys = array_keys($all_visits_domain);
//    $all_visits_domain['id'] = $incrementId;
//    $all_visits_domain['domain_id'] = $incrementId;
//    $array_values = array_values($all_visits_domain);
//    $table_cols = "`" . implode('`,`', $array_keys) . "`";
//    $table_vals = "'" . implode("','", $array_values) . "'";
//    $mysqli->query("insert into visits_per_days ($table_cols)values($table_vals)");
//    $incrementId++;
//}
die;
//$domains_string = 'Array
//(
//    [id] => 13831
//    [domain] => photosnewzealand.com
//    [created_at] => 2021-03-22 03:01:14
//    [updated_at] => 2021-03-23 03:18:07
//    [adomino_com_id] => 18308
//    [title] =>
//    [info] => {"en": null}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13833
//    [domain] => l.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18309
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13834
//    [domain] => 7.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18310
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13835
//    [domain] => ey.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18311
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13836
//    [domain] => dw.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18312
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13837
//    [domain] => jb.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18313
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13838
//    [domain] => jw.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18314
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13839
//    [domain] => oz.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18315
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13840
//    [domain] => nz.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18316
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13841
//    [domain] => motorhomes.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18317
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13842
//    [domain] => grabsteinpflege.com
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18318
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13843
//    [domain] => motorbike.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18319
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13844
//    [domain] => motorbike.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18320
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13845
//    [domain] => sport.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18321
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13846
//    [domain] => climb.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18322
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13847
//    [domain] => sail.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18323
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13848
//    [domain] => house.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18324
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13849
//    [domain] => realty.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18325
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13850
//    [domain] => vacation.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18326
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13851
//    [domain] => quad.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18327
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13852
//    [domain] => wandfolien.com
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18328
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13853
//    [domain] => crickets.co.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18329
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13854
//    [domain] => crickets.nz
//    [created_at] =>
//    [updated_at] => 2021-03-23 22:48:35
//    [adomino_com_id] => 18330
//    [title] =>
//    [info] => {"en": null}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13859
//    [domain] => share.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18331
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13860
//    [domain] => timber.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18332
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13861
//    [domain] => sea.nz
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18333
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13862
//    [domain] => fitnessreisen.com
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18334
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13863
//    [domain] => saugroboter.ch
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18335
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13864
//    [domain] => kindervelos.com
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18336
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13865
//    [domain] => ausstatter.com
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18337
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13866
//    [domain] => firmenservice.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18338
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13867
//    [domain] => badehauben.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18339
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13868
//    [domain] => drohnenbilder.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18340
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13869
//    [domain] => magnetfolien.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18341
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13870
//    [domain] => gartenboxen.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18342
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13871
//    [domain] => freizeitjacken.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18343
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13872
//    [domain] => armbinden.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18344
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13873
//    [domain] => medienmarketing.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18345
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13874
//    [domain] => remuera.net
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18346
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13875
//    [domain] => remuera.org
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18347
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13876
//    [domain] => remuera.de
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18348
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13877
//    [domain] => remuera.ch
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18349
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13878
//    [domain] => remuera.at
//    [created_at] =>
//    [updated_at] =>
//    [adomino_com_id] => 18350
//    [title] =>
//    [info] => {"de": ""}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)
//Array
//(
//    [id] => 13879
//    [domain] => shorts.at
//    [created_at] =>
//    [updated_at] => 2021-04-02 14:46:28
//    [adomino_com_id] => 18351
//    [title] =>
//    [info] => {"de": null}
//    [landingpage_mode] => request_offer
//    [deleted_at] =>
//    [brandable] => 0
//)';
//
//$domains = array(
//    Array
//    (
//        'id' => '13831',
//        'domain' => 'photosnewzealand.com',
//        'created_at' => '2021-03-22 03:01:14',
//        'updated_at' => '2021-03-23 03:18:07',
//        'adomino_com_id' => '18308',
//        'title' => '',
//        'info' => '{"en": null}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13833',
//        'domain' => 'l.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18309',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13834',
//        'domain' => '7.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18310',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13835',
//        'domain' => 'ey.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18311',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13836',
//        'domain' => 'dw.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18312',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13837',
//        'domain' => 'jb.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18313',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13838',
//        'domain' => 'jw.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18314',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13839',
//        'domain' => 'oz.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18315',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13840',
//        'domain' => 'nz.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18316',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13841',
//        'domain' => 'motorhomes.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18317',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13842',
//        'domain' => 'grabsteinpflege.com',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18318',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13843',
//        'domain' => 'motorbike.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18319',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13844',
//        'domain' => 'motorbike.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18320',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13845',
//        'domain' => 'sport.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18321',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13846',
//        'domain' => 'climb.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18322',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13847',
//        'domain' => 'sail.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18323',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13848',
//        'domain' => 'house.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18324',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13849',
//        'domain' => 'realty.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18325',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13850',
//        'domain' => 'vacation.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18326',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13851',
//        'domain' => 'quad.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18327',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13852',
//        'domain' => 'wandfolien.com',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18328',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13853',
//        'domain' => 'crickets.co.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18329',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13854',
//        'domain' => 'crickets.nz',
//        'created_at' => '',
//        'updated_at' => '2021-03-23 22:48:35',
//        'adomino_com_id' => '18330',
//        'title' => '',
//        'info' => '{"en": null}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13859',
//        'domain' => 'share.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18331',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13860',
//        'domain' => 'timber.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18332',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13861',
//        'domain' => 'sea.nz',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18333',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13862',
//        'domain' => 'fitnessreisen.com',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18334',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13863',
//        'domain' => 'saugroboter.ch',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18335',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13864',
//        'domain' => 'kindervelos.com',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18336',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13865',
//        'domain' => 'ausstatter.com',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18337',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13866',
//        'domain' => 'firmenservice.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18338',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13867',
//        'domain' => 'badehauben.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18339',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13868',
//        'domain' => 'drohnenbilder.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18340',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13869',
//        'domain' => 'magnetfolien.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18341',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13870',
//        'domain' => 'gartenboxen.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18342',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13871',
//        'domain' => 'freizeitjacken.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18343',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13872',
//        'domain' => 'armbinden.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18344',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13873',
//        'domain' => 'medienmarketing.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18345',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13874',
//        'domain' => 'remuera.net',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18346',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13875',
//        'domain' => 'remuera.org',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18347',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13876',
//        'domain' => 'remuera.de',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18348',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13877',
//        'domain' => 'remuera.ch',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18349',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13878',
//        'domain' => 'remuera.at',
//        'created_at' => '',
//        'updated_at' => '',
//        'adomino_com_id' => '18350',
//        'title' => '',
//        'info' => '{"de": ""}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    ),
//    Array
//    (
//        'id' => '13879',
//        'domain' => 'shorts.at',
//        'created_at' => '',
//        'updated_at' => '2021-04-02 14:46:28',
//        'adomino_com_id' => '18351',
//        'title' => '',
//        'info' => '{"de": null}',
//        'landingpage_mode' => 'request_offer',
//        'deleted_at' => '',
//        'brandable' => '0',
//    )
//);
//foreach ($domains as $domain) {
//    print_r($domain);
//    $mysqli->query("update domains set `domain`='" . $domain['domain'] . "',`created_at`='" . $domain['created_at'] . "',`updated_at`='" . $domain['updated_at'] . "',`adomino_com_id`='" . $domain['adomino_com_id'] . "',`title`='" . $domain['title'] . "',`info`='" . $domain['info'] . "',`landingpage_mode`='" . $domain['landingpage_mode'] . "',`deleted_at`='" . $domain['deleted_at'] . "',`brandable`='" . $domain['brandable'] . "' where id='$incrementId'");
//    $incrementId++;
//}
//die;
//print_r(print_r_reverse($domains_string));

//function print_r_reverse($input)
//{
//    $output = str_replace(['[', ']'], ["'", "'"], $input);
//    $output = preg_replace('/=> (?!Array)(.*)$/m', "=> '$1',", $output);
//    $output = preg_replace('/^\s+\)$/m', "),\n", $output);
//    $output = rtrim($output, "\n,");
//    echo $output;
////    return eval("return $output;");
//}
//foreach ($a as $b) {
//    print_r($b);
//    die;
//}
//die;
//$domainRecordsSql = $mysqli->query("SELECT * FROM domains where id BETWEEN $incrementId and 13879");
//$domainRecords = $domainRecordsSql->fetch_all(MYSQLI_ASSOC);
//foreach ($domainRecords as $domainRecord) {
//    try {
////        $mysqli->query("update daily_visits set domain_id='$incrementId' where domain_id='" . $domainRecord['id'] . "'");
////        $mysqli->query("update inquiries set domain_id='$incrementId' where domain_id='" . $domainRecord['id'] . "'");
////        $mysqli->query("update visits set domain_id='$incrementId' where domain_id='" . $domainRecord['id'] . "'");
////        $mysqli->query("update visits_per_days set domain_id='$incrementId' where domain_id='" . $domainRecord['id'] . "'");
////        $mysqli->query("delete from domains where id='" . $domainRecord['id'] . "'");
////        $mysqli->query("insert into domains (`id`,`domain`,`created_at`,`updated_at`,`adomino_com_id`,`title`,`info`,`landingpage_mode`,`deleted_at`,`brandable`)values('$incrementId','" . $domainRecord['domain'] . "','" . $domainRecord['created_at'] . "','" . $domainRecord['updated_at'] . "','" . $domainRecord['adomino_com_id'] . "','" . $domainRecord['title'] . "','" . $domainRecord['info'] . "','" . $domainRecord['landingpage_mode'] . "','" . $domainRecord['deleted_at'] . "','" . $domainRecord['brandable'] . "')");
//        $mysqli->query("update domains set id='$incrementId' where id='" . $domainRecord['id'] . "'");
//        print_r($domainRecord);
//        $incrementId++;
//    } catch (Exception $exception) {
//        echo $exception->getMessage();
//        die;
//    }
//}
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
