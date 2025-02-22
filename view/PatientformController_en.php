<?php
######
if (!$_POST) exit('Unauthorized access');
require_once 'vendor/autoload.php';
use Stichoza\GoogleTranslate\GoogleTranslate;
require_once("sql.php");
#多言語化
if (!empty($_POST['lang'])) $lang = $_POST['lang'];
else $lang = 'en';
$path = 'mail_lang/'.$lang.'.json';
$file = fopen($path, "r");
$json = fread($file, filesize($path));
$tls = json_decode($json, true);
#タイムスタンプ
$time = new DateTime();
$datetime = $time->format('Y-m-d H:i');
$fmt_t = new IntlDateFormatter($lang, IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
$fmt_tj = new IntlDateFormatter('ja_JP', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
$date_fmt = $fmt_t-> format($time);
$date_fmt_j = $fmt_tj -> format($time);
if(isset($_POST["fname"])){
    $fname = $_POST["fname"];
}
else{
    $fname = "";
}
if(isset($_POST["mname"])){
    $mname = $_POST["mname"];
}
else{
    $mname = "";
}
if(isset($_POST["lname"])){
    $lname = $_POST["lname"];
}
else{
    $lname = "";
}
#######
if(isset($_POST["sex"])){
    $sex = $_POST["sex"];
}
else{
    $sex = "";
}
if(isset($_POST["year"])){
    $year = $_POST["year"];
}
else{
    $year = "";
}
if(isset($_POST["month"])){
    $month = $_POST["month"];
}
else{
    $month = "";
}
if(isset($_POST["day"])){
    $day = $_POST["day"];
}
else{
    $day = "";
}
#######
if(isset($_POST["nationality"])){
    $nationality = $_POST["nationality"];
}
else{
    $nationality = "";
}
if(isset($_POST["language"])){
    $language = $_POST["language"];
}
else{
    $language = "";
}
if(isset($_POST["countryname"])){
    $countryname = $_POST["countryname"];
}
else{
    $countryname = "";
}
if(isset($_POST["state"])){
    $state = $_POST["state"];
}
else{
    $state = "";
}
if(isset($_POST["city"])){
    $city = $_POST["city"];
}
else{
    $city = "";
}
#######
if(isset($_POST["postalcode"])){
    $postalcode = $_POST["postalcode"];
}
else{
    $postalcode = "";
}
if(isset($_POST["address1"])){
    $address1 = $_POST["address1"];
}
else{
    $address1 = "";
}
if(isset($_POST["address2"])){
    $address2 = $_POST["address2"];
}
else{
    $address2 = "";
}
if(isset($_POST["tel"])){
    $tel = $_POST["tel"];
}
else{
    $tel = "";
}
if(isset($_POST["email"])){
    $email = $_POST["email"];
}
else{
    $email = "";
}
if(isset($_POST["contact_means"])){
    $contact_means = $_POST["contact_means"];
}
else{
    $contact_means = "";
}
if(isset($_POST["contacthours"])){
    $contacthours = $_POST["contacthours"];
}
else{
    $contacthours = "";
}
if(isset($_POST["meansothers"])){
    $meansothers = $_POST["meansothers"];
}
else{
    $meansothers = "";
}
if(isset($_POST["purpose"])){
    $purpose = $_POST["purpose"];
}
else{
    $purpose = "";
}
if(isset($_POST["purposeothers"])){
    $purposeothers = $_POST["purposeothers"];
}
else{
    $purposeothers = "";
}
if(isset($_POST["incident"])){
    $incident = $_POST["incident"];
}
else{
    $incident = "";
}
if(isset($_POST["where"])){
    $where = $_POST["where"];
}
else{
    $where = "";
}
if(isset($_POST["how"])){
    $how = $_POST["how"];
}
else{
    $how = "";
}
if(isset($_POST["when"])){
    $when = $_POST["when"];
}
else{
    $when = "";
}
if(isset($_POST["medicine"])){
    $medicine = $_POST["medicine"];
}
else{
    $medicine = "";
}
if(isset($_POST["allergy"])){
    $allergy = $_POST["allergy"];
}
else{
    $allergy = "";
}
if(isset($_POST["op_exp"])){
    $op_exp = $_POST["op_exp"];
}
else{
    $op_exp = "";
}
if(isset($_POST["op_symp"])){
    $op_symp = $_POST["op_symp"];
}
else{
    $op_symp = "";
}
if(isset($_POST["op_when"])){
    $op_when = $_POST["op_when"];
}
else{
    $op_when = "";
}
if(isset($_POST["op_hosp"])){
    $op_hosp = $_POST["op_hosp"];
}
else{
    $op_hosp = "";
}
if(isset($_POST["history"])){
    $history = $_POST["history"];
}
else{
    $history = [];
}
if(isset($_POST["historyothers"])){
    $historyothers = $_POST["historyothers"];
}
else{
    $historyothers = "";
}
if(isset($_POST["hist_who"])){
    $hist_who = $_POST["hist_who"];
}
else{
    $hist_who = "";
}
if(isset($_POST["hist_when"])){
    $hist_when = $_POST["hist_when"];
}
else{
    $hist_when = "";
}
if(isset($_POST["hist_hosp"])){
    $hist_hosp = $_POST["hist_hosp"];
}
else{
    $hist_hosp = "";
}
if(isset($_POST["commuting"])){
    $commuting = $_POST["commuting"];
}
else{
    $commuting = "";
}
if(isset($_POST["alcohol"])){
    $alcohol = $_POST["alcohol"];
}
else{
    $alcohol = "";
}
if(isset($_POST["tobacco"])){
    $tobacco = $_POST["tobacco"];
}
else{
    $tobacco = "";
}
if(isset($_POST["appetite"])){
    $appetite = $_POST["appetite"];
}
else{
    $appetite = "";
}
if(isset($_POST["bowel"])){
    $bowel = $_POST["bowel"];
}
else{
    $bowel = [];
}
if(isset($_POST["sleep"])){
    $sleep = $_POST["sleep"];
}else{
    $sleep      = "";
}
if(isset($_POST["sleep_counter"])){
    $sleep_counter = $_POST["sleep_counter"];
}else{
    $sleep_counter = "";
}
if(isset($_POST["survey"])){
    $survey = $_POST["survey"];
}
else{
    $survey = [];
}
if(isset($_POST["survey3_who"])){
    $survey3_who = $_POST["survey3_who"];
}
else{
    $survey3_who = "";
}
if(isset($_POST["search"])){
    $search = $_POST["search"];
}
else{
    $search = "";
}
if(isset($_POST["keyword"])){
    $keyword = $_POST["keyword"];
}
else{
    $keyword = "";
}
if(isset($_POST["treatment"])){
    $treatment = $_POST["treatment"];
}
else{
    $treatment = [];
}
if(isset($_POST["comment"])){
    $comment = str_replace("\r\n", "\n", $_POST["comment"]);
}
else{
    $comment = "";
}

$tr = new GoogleTranslate();
$tr->setSource('en'); 
$tr->setTarget($lang);

$tr_j = new GoogleTranslate();
$tr_j->setsource($lang);
$tr_j->setTarget('ja');

$bday = new DateTime($year.'-'.$month.'-'.$day);
$fmt = new IntlDateFormatter($lang, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$fmt_j = new IntlDateFormatter('ja_JP', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$bday_str = $fmt -> format($bday);
$bday_str_ja = $fmt_j -> format($bday);


#1つの変数に纏めて格納する（テキスト版）

$answers_text = $tls['title']."\n"
.'['.$tls['datetime'].']'."\n".$date_fmt."\n\n"
.'['.$tls['fname'].']'."\n".$fname."\n\n"
.'['.$tls['mname'].']'."\n".$mname."\n\n"
.'['.$tls['lname'].']'."\n".$lname."\n\n"
.'['.$tls['sex'].']'."\n".$sex."\n\n"
.'['.$tls['bday_str'].']'."\n".$bday_str." \n\n"
.'['.$tls['nationality'].']'."\n".$nationality."\n\n"
.'['.$tls['language'].']'."\n".$language."\n\n"
.'['.$tls['countryname'].']'."\n".$countryname."\n\n"
.'['.$tls['state'].']'."\n".$state."\n\n"
.'['.$tls['city'].']'."\n".$city."\n\n"
.'['.$tls['postalcode'].']'."\n".$postalcode."\n\n"
.'['.$tls['address1'].']'."\n".$address1."\n\n"
.'['.$tls['address2'].']'."\n".$address2."\n\n"
.'['.$tls['tel'].']'."\n".$tel."\n\n"
.'['.$tls['email'].']'."\n".$email."\n\n"
.'['.$tls['contact'].']'."\n";
if($contact_means == "tel"){
    $answers_text .= $tls['contact_means']."(".$contacthours.")";
} else if ($contact_means == "others") {
    $answers_text .= $meansothers;
} else {
    $answers_text .= $contact_means;
}
$answers_text .= "\n\n"
.$tls['symptom']."\n";
if($purpose == "others"){
    $answers_text.= '['.$tls['purposeothers'].']'."\n".$purposeothers."\n\n";
    $answers_text.= '['.$tls['incident'].']'."\n".$incident."\n\n";
    $answers_text.= '['.$tls['description'].']'."\n".$tls['d_where']."\n".$where."\n\n"
    .$tls['how']."\n".$how."\n\n".$tls['when']."\n".$when."\n\n";
}
else{
    $answers_text.= '['.$tls['purposeothers'].']'."\n".$purpose."\n\n";
    $answers_text.= '['.$tls['incident'].']'."\n".$incident."\n\n";
    $answers_text.= '['.$tls['description'].']'."\n".$tls['d_where']."\n".$where."\n\n"
    .$tls['how']."\n".$how."\n\n".$tls['when']."\n".$when."\n\n";
}

$answers_text .= $tls['current_med']."\n"
.'['.$tls['medicine'].']'."\n".$medicine."\n\n"
.'['.$tls['allergy'].']'."\n".$allergy."\n\n";
if($op_exp == "yes"){
    $answers_text.=$tls["yes"]."\n"."\n\n";
    $answers_text.= '['.$tls['op_symp'].']'."\n".$op_symp."\n\n";
    $answers_text.= '['.$tls['when'].']'."\n".$op_when."\n\n";
    $answers_text.= '['.$tls['hosp'].']'."\n".$op_hosp."\n\n";
}
else{
    $answers_text.=$tls["no"]."\n"."\n\n";
} 
$answers_text.= '['.$tls['med_prob'].']'."\n"
.'['.$tls['his_title'].']'."\n";
$history_all = "";
if($history){
    foreach($history as $index => $val) {
        if ($val == "others") {
          $history_all .= $historyothers;
        } else {
          $history_all .= $val;
        }
        if ($index != array_key_last($history)) {
          $history_all.=", ";
          //最後の値の時はコンマをつけない
        }
      }
    $answers_text .= $history_all."\n\n";
    $answers_text .= '['.$tls['who'].']'."\n".$hist_who."\n\n";
    $answers_text .= '['.$tls['when'].']'."\n".$hist_when."\n\n";
    $answers_text .= '['.$tls['hosp'].']'."\n".$hist_hosp."\n\n";
    $answers_text.=$tls['commuting']."\n".$commuting."\n";
}
$answers_text .= "\n".$tls['life']."\n"
.'['.$tls['alcohol'].']'."\n".$alcohol."\n\n"
.'['.$tls['tobacco'].']'."\n".$tobacco."\n\n"
.'['.$tls['appetite'].']'."\n".$appetite."\n\n";
$bowel_imploded = rtrim(implode(", ",$bowel), ", ");
$answers_text .='['.$tls['bowel'].']'."\n".$bowel_imploded."\n\n"
.'['.$tls['sleep'].']'."\n".$sleep."\n\n"
.'['.$tls['sleep_counter'].']'."\n".$sleep_counter." time(s)\n\n"
.'['.$tls['survey'].']'."\n";
$survey_all = '';
$survey_count = count($survey);
foreach($survey as $index => $val) {
  if ($val == "Referred by someone") {
    $survey_all .=$tls['referred'];
    $survey_all .= '：'.$survey3_who;
  }
  else if($val == "Search Engine"){
    $survey_all .=$tls['search'];
    $survey_all .= '：'.$search."(".$tls['keyword'].$keyword.")";
  }
  else{
    $survey_all .= $val;
  }
    $survey_all.=", ";
}
$survey_all_lf = rtrim(str_replace("\r\n", "\n", $survey_all), ", ");
$treatment_imploded = str_replace("\r\n", "\n", rtrim(implode(", ",$treatment), ", "));
$answers_text .='['.$tls['survey_title'].']'."\n".$survey_all_lf."\n\n"
.'['.$tls['treatment'].']'."\n".$treatment_imploded."\n\n"
.'['.$tls['comment'].']'."\n"
.'['.$tls['comment2'].']'."\n".$comment."\n\n";

#SQL
$sql = connectdb();
if (!$sql) exit("DB接続失敗");
$table_col = "datetime,fname,mname,lname,sex,birth,nationality,language,country,state,city,postalcode,address1,address2,tel,email,contact_means,purpose,incident,symp_where,symp_how,symp_when,medicine,allergy,op_exp,op_symp,op_when,op_hosp,history,hist_who,hist_when,hist_hosp,commuting,alcohol,tobacco,appetite,bowel,sleep,sleep_counter,survey,search,keyword,treatment,comment";
$stmt = $sql -> prepare ("INSERT INTO patient_en_original (".$table_col.") VALUES (".substr(str_repeat("?, ", 44), 0, -2).")");
$values = [$datetime,$fname,$mname,$lname, $sex,$bday_str,$nationality,$language,$countryname,$state,$city, $postalcode,$address1,$address2,$tel,$email,$tr->translate($contact_means)."(".$contacthours.")",$purpose,$incident,$where,$how,$when,$medicine,$allergy,$tr->translate($op_exp),$op_symp,$op_when,$op_hosp,$history_all,$hist_who,$hist_when,$hist_hosp,$commuting,$alcohol,$tobacco,$appetite,$bowel_imploded,$sleep,$sleep_counter,$survey_all_lf,$search,$keyword,$treatment_imploded,$comment];
$register = $stmt -> execute($values);
if (!$register) exit('データベース登録エラー');
$sql = null;

#1つの変数に纏めて格納する（テキスト日本語版）

$answers_ja_text = $tr_j->translate("Patient details")."\n"
."[日付]"."\n".$date_fmt_j."\n\n"
."[名]"."\n".$fname."\n\n"
."[ミドルネーム]"."\n".$mname."\n\n"
."[姓]\n".$lname."\n\n";
$t_sex = $tr_j->translate($sex);
$answers_ja_text.="[性別]"."\n".$t_sex."\n\n"
."[生年月日]"."\n".$bday_str_ja." \n\n";
$t_nationality = $tr_j->translate($nationality);
$answers_ja_text.= "[国籍]"."\n".$t_nationality."\n\n";
$t_language =$tr_j->translate($language);
$answers_ja_text.= "[言語]"."\n".$t_language."\n\n";
$t_country = $tr_j->translate($countryname);
$answers_ja_text.="[国]"."\n".$t_country."\n\n"
."[州/県]"."\n".$state."\n\n"
."[市]"."\n".$city."\n\n"
."[郵便番号]"."\n".$postalcode."\n\n"
."[住所1]\n".$address1."\n\n"
."[住所2]\n".$address2."\n\n"
."[電話番号]"."\n".$tel."\n\n"
."[E-メール]"."\n".$email."\n\n"
."[連絡方法]"."\n";
$t_contact_means = $tr_j->translate($contact_means);
if($contact_means == "tel"){
    $answers_ja_text .= $t_contact_means."(".$contacthours."時)";
} else if ($contact_means == "others") {
    $t_meansothers = $tr_j->translate($meansothers);
    $answers_ja_text .= $t_meansothers;
} else {
    $answers_ja_text .= $t_contact_means;
}
$answers_ja_text .= "\n\n"
."来院目的・症状\n";
$t_incident = $tr_j->translate($incident);
$t_where = $tr_j->translate($where);
$t_how = $tr_j->translate($how);
$t_when = $tr_j->translate($when);

if($purpose == "others"){
    $t_purposeothers = $tr_j->translate($purposeothers);
    $answers_ja_text.= "[来院目的]"."\n".$t_purposeothers."\n\n";
    $answers_ja_text.= "[負傷・発病のきっかけ]"."\n".$t_incident."\n\n";
    $answers_ja_text.= "[症状詳細]"."\n"."[どこが（疾患部位）]"."\n".$t_where."\n\n"
    ."[どんなふうに]"."\n".$t_how."\n\n"."[いつごろから]"."\n".$t_when."\n\n";
}
else{
    $t_purpose = $tr_j->translate($purpose);
    $answers_ja_text.= "[来院目的]"."\n".$t_purpose."\n\n";
    $answers_ja_text.= "[負傷・発病のきっかけ]"."\n".$t_incident."\n\n";
    $answers_ja_text.= "[症状詳細]"."\n"."[どこが（疾患部位）]"."\n".$t_where."\n"
    ."[どんなふうに]"."\n".$t_how."\n"."[いつごろから]".$t_when."\n\n";
}
$t_medicine = $tr_j->translate($medicine);
$t_allergy = $tr_j->translate($allergy);
$t_op_exp = $tr_j->translate($op_exp);
$answers_ja_text .= "服用中の薬・手術歴"."\n"
."[薬の名前]"."\n".$t_medicine."\n\n"
."[アレルギー]"."\n".$t_allergy."\n\n"
."[疾患名]"."\n".$t_op_exp."\n\n";
if($op_exp == "yes"){
    $t_op_symp = $tr_j->translate($op_symp);
    $t_op_when = $tr_j->translate($op_when);
    $t_op_hosp = $tr_j->translate($op_hosp);
    $answers_ja_text.= "[疾患名]"."\n".$t_op_symp."\n\n";
    $answers_ja_text.= "[いつ頃]"."\n".$t_op_when."\n\n";
    $answers_ja_text.= "[病院名]"."\n".$t_op_hosp."\n\n";
}
$answers_ja_text.= "患った病気"."\n"
."[発症履歴]"."\n";
$t_history_all = $tr_j->translate($history_all);
$t_hist_who = $tr_j->translate($hist_who);
$t_hist_when = $tr_j->translate($hist_when);
$t_hist_hosp = $tr_j->translate($hist_hosp);
$t_commuting = $tr_j->translate($commuting);
$t_alcohol = $tr_j->translate($alcohol);
$t_tobacco = $tr_j->translate($tobacco);
$t_appetite = $tr_j->translate($appetite);
$t_bowel = $tr_j->translate(rtrim(implode(", ",$bowel), ", "));
$t_sleep = $tr_j->translate($sleep);
$t_sleep_counter = $tr_j->translate($sleep_counter);
$t_survey_all_lf = $tr_j->translate($survey_all_lf);
$t_treatment_imploded = $tr_j->translate($treatment_imploded);
$t_comment = $tr_j->translate($comment);

$answers_ja_text .= $t_history_all."\n\n";
$answers_ja_text .= "[どなたが]"."\n".$t_hist_who."\n\n";
$answers_ja_text .=  "[いつ頃]"."\n".$t_hist_when."\n\n";
$answers_ja_text .=  "[病院名]"."\n".$t_hist_hosp."\n\n";
$answers_ja_text.= "[通院しているかどうか]"."\n".$t_commuting."\n";
$answers_ja_text .= "\n"."生活習慣"."\n"
."[飲酒するか]"."\n".$t_alcohol."\n\n"
."[喫煙するか]"."\n".$t_tobacco."\n\n"
."[食欲はあるか]"."\n".$t_appetite."\n\n"
."[便通]"."\n".$t_bowel."\n\n"
."[よく眠れるか]"."\n".$t_sleep."\n\n"
."[夜中に起きる頻度]"."\n".$t_sleep_counter."回\n\n"
."[アンケート]"."\n";
$t_search = $tr_j->translate($search);
$t_keyword = $tr_j->translate($keyword);
$answers_ja_text .="[どのように当院を知ったか]"."\n".$t_survey_all_lf."\n\n"
."[治療]"."\n".$t_treatment_imploded."\n\n"
."備考"."\n"
."[備考]"."\n".$t_comment."\n\n";


#SQL
$sql = connectdb();
if (!$sql) exit("日本語版DB接続失敗");
$table_col = "datetime,fname,mname,lname,sex,birth,nationality,language,country,state,city,postalcode,address1,address2,tel,email,contact_means,purpose,incident,symp_where,symp_how,symp_when,medicine,allergy,op_exp,op_symp,op_when,op_hosp,history,hist_who,hist_when,hist_hosp,commuting,alcohol,tobacco,appetite,bowel,sleep,sleep_counter,survey,search,keyword,treatment,comment";
$stmt = $sql -> prepare ("INSERT INTO patient_en_translated (".$table_col.") VALUES (".substr(str_repeat("?, ", 44), 0, -2).")");
$values_j = [$datetime,$fname,$mname,$lname, $t_sex, $bday_str_ja,$t_nationality,$t_language,$t_country,$state,$city, $postalcode,$address1,$address2,$tel,$email,$t_contact_means,$t_purpose,$t_incident,$t_where,$t_how,$t_when,$t_medicine,$t_allergy,$t_op_exp,$t_op_symp,$t_op_when,$t_op_hosp,$t_history_all,$t_hist_who,$t_hist_when,$t_hist_hosp,$t_commuting,$t_alcohol,$t_tobacco,$t_appetite,$t_bowel,$t_sleep,$sleep_counter,$t_survey_all_lf,$t_search,$t_keyword,$t_treatment_imploded,$t_comment];
$register = $stmt -> execute($values_j);
if (!$register) exit('データベース登録エラー');
$sql = null;


#1つの変数に纏めて格納する（HTML版）
$answers_html = '<div class="card" style="background-color: var(--bs-secondary-bg-subtle);"><div class="card-body"><h4>'.$tls['title'].'</h4>'
. "<strong>".$tls['datetime']."</strong><p>".$date_fmt."</p>"
. "<strong>".$tls['fname']."</strong><p>".htmlspecialchars($fname)."</p>"
. "<strong>".$tls['mname']."</strong><p >".htmlspecialchars($mname)."</p>"
. "<strong>".$tls['lname']."</strong><p>".htmlspecialchars($lname)."</p>"
."<strong>".$tls['sex']."</strong><p>".htmlspecialchars($sex)."</p>"
."<strong>".$tls['bday_str']."</strong><p>".$bday_str."</p>"
."<strong>".$tls['nationality']."</strong><p>".htmlspecialchars($nationality)."</p>"
."<strong>".$tls['language']."</strong><p>".htmlspecialchars($language)."</p>"
."<strong>".$tls['countryname']."</strong><p>".htmlspecialchars($countryname)."</p>"
."<strong>".$tls['state']."</strong><p>".htmlspecialchars($state)."</p>"
."<strong>".$tls['city']."</strong><p>".htmlspecialchars($city)."</p>"
."<strong>".$tls['address1']."</strong><p>".htmlspecialchars($address1)."</p>"
."<strong>".$tls['address2']."</strong><p>".htmlspecialchars($address2)."</p>"
."<strong>".$tls['tel']."</strong><p>".htmlspecialchars($tel)."</p>"
."<strong>".$tls['email']."</strong><p>".htmlspecialchars($email)."</p>"
."<strong>".$tls['contact']."</strong><p>";
if($contact_means == "tel"){
    $answers_html .= $tls['contact_means']."(".htmlspecialchars($contacthours).")";
} else if ($contact_means == "others") {
    $answers_html .= htmlspecialchars($meansothers);
} else {
    $answers_html .= htmlspecialchars($contact_means);
}
$answers_html .= "</p></div></div>"
.'<div class="card" style="background-color: var(--bs-primary-bg-subtle);"><div class="card-body"><h4>'.$tls['symptom'].'</h4>';
if($purpose == "others"){
    $answers_html.= "<strong>".$tls['purposeothers']."</strong><p>".htmlspecialchars($purposeothers)."</p>";
    $answers_html.= "<strong>".$tls['incident']."</strong><p>".htmlspecialchars($incident)."</p>";
    $answers_html.= "<strong>".$tls['description']."</strong><p>";
    $answers_html.= "【".$tls['d_where']."】<br>".htmlspecialchars($where)."<br><br>";
    $answers_html.= "【".$tls['how']."】<br>".htmlspecialchars($how)."<br><br>";
    $answers_html.= "【".$tls['when']."】<br>".htmlspecialchars($when)."</p></div></div>";
}
else{
    $answers_html.= "<strong>".$tls['purposeothers']."</strong><p>".htmlspecialchars($purpose)."</p>";
    $answers_html.= "<strong>".$tls['incident']."</strong><p>".htmlspecialchars($incident)."</p>";
    $answers_html.= "<strong>".$tls['description']."</strong><p>";
    $answers_html.= "【".$tls['d_where']."】<br>".htmlspecialchars($where)."<br><br>";
    $answers_html.= "【".$tls['how']."】<br>".htmlspecialchars($how)."<br><br>";
    $answers_html.= "【".$tls['when']."】<br>".htmlspecialchars($when)."</p></div></div>";
}
$answers_html .= '<div class="card" style="background-color: var(--bs-warning-bg-subtle);"><div class="card-body"><h4>'.$tls['current_med'].'</h4>'
."<strong>".$tls['medicine']."</strong><p>".htmlspecialchars($medicine)."</p>"
."<strong>".$tls['allergy']."</strong><p>".htmlspecialchars($allergy)."</p>";
if($op_exp == "yes"){
    $answers_html.="<strong>".$tls["op_exp"]."</strong><p>".$tls['yes']."</p>";
}
else if($op_exp == "no"){
    $answers_html.="<strong>".$tls["op_exp"]."</strong><p>".$tls['no']."</p>";
}
else{
    $answers_html.="<strong>".htmlspecialchars($op_exp)."</strong><p>".$tls['no']."</p>";
}
if($op_exp == "yes"){
    $answers_html.= "<strong>".$tls['op_symp']."</strong><p>".htmlspecialchars($op_symp)."</p>";
    $answers_html.= "<strong>".$tls['when']."</strong><p>".htmlspecialchars($op_when)."</p>";
    $answers_html.= "<strong>".$tls['hosp']."</strong><p>".htmlspecialchars($op_hosp)."</p>";
}
$answers_html.= '</div></div><div class="card" style="background-color: var(--bs-success-bg-subtle);"><div class="card-body"><h4>'.$tls['med_prob'].'</h4>'
."<strong>".$tls['his_title']."</strong><p>";
if($history){
    $answers_html .= htmlspecialchars($history_all)."</p>";
    $answers_html .= "<strong>".$tls['who']."</strong><p>".htmlspecialchars($hist_who)."</p>";
    $answers_html .=  "<strong>".$tls['when']."</strong><p>".htmlspecialchars($hist_when)."</p>";
    $answers_html .=  "<strong>".$tls['hosp']."</strong><p>".htmlspecialchars($hist_hosp)."</p>";
    $answers_html.="<strong>".$tls['commuting']."</strong><p>".htmlspecialchars($commuting)."</p>";
} else {
    $answers_html .= 'N/A</p>';
}
$answers_html .= '</div></div><div class="card" style="background-color: var(--bs-danger-bg-subtle);"><div class="card-body"><h4>'.$tls['life'].'</h4>'
."<strong>".$tls['alcohol']."</strong><p>".htmlspecialchars($alcohol)."</p>"
. "<strong>".$tls['tobacco']."</strong><p>".htmlspecialchars($tobacco)."</p>"
."<strong>".$tls['appetite']."</strong><p>".htmlspecialchars($appetite)."</p>"
."<strong>".$tls['bowel']."</strong><p>".htmlspecialchars(rtrim(implode(", ",$bowel), ", "))."</p>"
."<strong>".$tls['sleep']."</strong><p>".htmlspecialchars($sleep)."</p>"
."<strong>".$tls['sleep_counter']."</strong><p>".htmlspecialchars($sleep_counter).$tls['sleep_times']."</p></div></div>"
.'<div class="card" style="background-color: var(--bs-info-bg-subtle);"><div class="card-body"><h4>'.$tls['survey'].'</h4>';
$survey_all_br = str_replace("\n", "<br>", htmlspecialchars($survey_all_lf));
$treatment_imploded_br = str_replace("\n", "<br>", htmlspecialchars($treatment_imploded));
$comment_br = str_replace("\n", "<br>", htmlspecialchars($comment));
$answers_html .="<strong>".$tls['survey_title']."</strong><p>".$survey_all_br."</p>"
."<strong>".$tls['treatment']."</strong><p>".$treatment_imploded_br."</p></div></div>"
.'<div class="card" style="background-color: var(--bs-dark-bg-subtle);"><div class="card-body"><h4>'.$tls['comment'].'</h4>'
."<strong>".$tls['comment2']."</strong><p>".$comment_br."</p></div></div>";


#1つの変数に纏めて格納する（HTML版）
$answers_ja_html = '<div class="card" style="background-color: var(--bs-secondary-bg-subtle);"><div class="card-body"><h4>患者詳細</h4>'
."<strong>日付</strong><p>".$date_fmt_j."</p>"
. "<strong>名</strong><p>".htmlspecialchars($fname)."</p>"
. "<strong>ミドルネーム</strong><p>".htmlspecialchars($mname)."</p>"
. "<strong>姓</strong><p>".htmlspecialchars($lname)."</p>"
."<strong>性別</strong><p>".$tr_j->translate(htmlspecialchars($sex))."</p>"
."<strong>生年月日</strong><p>".$bday_str_ja."</p>"
."<strong>国籍</strong><p>".$tr_j->translate(htmlspecialchars($nationality))."</p>"
."<strong>言語</strong><p>".$tr_j->translate(htmlspecialchars($language))."</p>"
."<strong>国</strong><p>".$tr_j->translate(htmlspecialchars($countryname))."</p>"
."<strong>州/県</strong><p>".htmlspecialchars($state)."</p>"
."<strong>市</strong><p>".htmlspecialchars($city)."</p>"
."<strong>住所1</strong><p>".htmlspecialchars($address1)."</p>"
."<strong>住所2</strong><p>".htmlspecialchars($address2)."</p>"
."<strong>電話番号</strong><p>".htmlspecialchars($tel)."</p>"
."<strong>Eメール</strong><p>".htmlspecialchars($email)."</p>"
."<strong>連絡方法</strong><p>";
if($contact_means == "tel"){
    $answers_ja_html .= $tr_j->translate(htmlspecialchars($contact_means))."(".htmlspecialchars($contacthours)."時)";
} else if ($contact_means == "others") {
    $answers_ja_html .= $tr_j->translate(htmlspecialchars($meansothers));
} else {
    $answers_ja_html .= $tr_j->translate(htmlspecialchars($contact_means));
}
$answers_ja_html .= "</p></div></div>"
.'<div class="card" style="background-color: var(--bs-primary-bg-subtle);"><div class="card-body"><h4>'.$tr->translate("来院目的・症状").'</h4>';
//$symptom_html_pre = str_replace("\n\n\n", "\n\n", htmlspecialchars($symptom));
//$symptom_html = str_replace("\n", "<br>", htmlspecialchars($symptom_html_pre));
if($purpose == "others"){
    $answers_ja_html.= "<strong>来院目的</strong><p>".$tr_j->translate(htmlspecialchars($purposeothers))."</p>";
    $answers_ja_html.= "<strong>負傷・発病のきっかけ</strong><p>".$tr_j->translate(htmlspecialchars($incident))."</p>";
    $answers_ja_html.= "<strong>症状詳細</strong><p>";
    $answers_ja_html.= "【どこが（疾患部位）】<br>".$tr_j->translate(htmlspecialchars($where))."<br><br>";
    $answers_ja_html.= "【どんなふうに】<br>".$tr_j->translate(htmlspecialchars($how))."<br><br>";
    $answers_ja_html.= "【いつごろから】<br>".$tr_j->translate(htmlspecialchars($when))."</p></div></div>";
}
else{
    $answers_ja_html.= "<strong>来院目的</strong><p>".$tr_j->translate(htmlspecialchars($purpose))."</p>";
    $answers_ja_html.= "<strong>負傷・発病のきっかけ</strong><p>".$tr_j->translate(htmlspecialchars($incident))."</p>";
    $answers_ja_html.= "<strong>症状詳細</strong><p>";
    $answers_ja_html.= "【どこが（疾患部位）】<br>".$tr_j->translate(htmlspecialchars($where))."<br><br>";
    $answers_ja_html.= "【どんなふうに】<br>".$tr_j->translate(htmlspecialchars($how))."<br><br>";
    $answers_ja_html.= "【いつごろから】<br>".$tr_j->translate(htmlspecialchars($when))."</p></div></div>";
}
$answers_ja_html .= '<div class="card" style="background-color: var(--bs-warning-bg-subtle);"><div class="card-body"><h4>服用中の薬・アレルギー・手術歴</h4>'
."<strong>服用中の薬</strong><p>".$tr_j->translate(htmlspecialchars($medicine))."</p>"
."<strong>アレルギー</strong><p>".$tr_j->translate(htmlspecialchars($allergy))."</p>"
."<strong>手術歴</strong><p>".$tr_j->translate(htmlspecialchars($op_exp))."</p>";
if($op_exp == "yes"){
    $answers_ja_html.= "<strong>疾患名</strong><p>".$tr_j->translate(htmlspecialchars($op_symp))."</p>";
    $answers_ja_html.= "<strong>いつ頃</strong><p>".$tr_j->translate(htmlspecialchars($op_when))."</p>";
    $answers_ja_html.= "<strong>病院名</strong><p>".$tr_j->translate(htmlspecialchars($op_hosp))."</p>";
}
$answers_ja_html.= '</div></div><div class="card" style="background-color: var(--bs-success-bg-subtle);"><div class="card-body"><h4>患った病気</h4>'
."<strong>発症履歴</strong><p>";
if($history){
    $answers_ja_html .= $tr_j->translate(htmlspecialchars($history_all))."</p>";
    $answers_ja_html .= "<strong>どなたが</strong><p>".$tr_j->translate(htmlspecialchars($hist_who))."</p>";
    $answers_ja_html .=  "<strong>いつ頃</strong><p>".$tr_j->translate(htmlspecialchars($hist_when))."</p>";
    $answers_ja_html .=  "<strong>病院名</strong><p>".$tr_j->translate(htmlspecialchars($hist_hosp))."</p>";
    $answers_ja_html.="<strong>通院しているかどうか</strong><p>".$tr_j->translate(htmlspecialchars($commuting))."</p>";
} else {
    $answers_ja_html .= 'なし</p>';
}
$answers_ja_html .= '</div></div><div class="card" style="background-color: var(--bs-danger-bg-subtle);"><div class="card-body"><h4>生活習慣</h4>'
."<strong>飲酒するか</strong><p>".$tr_j->translate(htmlspecialchars($alcohol))."</p>"
. "<strong>喫煙するか</strong><p>".$tr_j->translate(htmlspecialchars($tobacco))."</p>"
."<strong>食欲はあるか</strong><p>".$tr_j->translate(htmlspecialchars($appetite))."</p>"
."<strong>便通</strong><p>".$tr_j->translate(htmlspecialchars(rtrim(implode(", ", $bowel), ", ")))."</p>"
."<strong>よく眠れるか</strong><p>".$tr_j->translate(htmlspecialchars($sleep))."</p>"
."<strong>夜中に起きる頻度</strong><p>".$tr_j->translate(htmlspecialchars($sleep_counter))."回</p></div></div>"
.'<div class="card" style="background-color: var(--bs-info-bg-subtle);"><div class="card-body"><h4>アンケート</h4>';
if ($survey_all_lf) $survey_all_br_ja = str_replace("\n", "<br>", $tr_j->translate(htmlspecialchars($survey_all_lf)));
else $survey_all_br_ja = "";
if ($treatment_imploded) $treatment_imploded_br_ja = str_replace("\n", "<br>", $tr_j->translate(htmlspecialchars($treatment_imploded)));
else $treatment_imploded_br_ja = '';
if ($comment) $comment_br_ja = str_replace("\n", "<br>", $tr_j->translate(htmlspecialchars($comment)));
else $comment_br_ja = '';
$answers_ja_html .="<strong>どのように当院を知ったか</strong><p>".$survey_all_br_ja."</p>"
."<strong>治療</strong><p>".$treatment_imploded_br_ja."</p></div></div>"
.'<div class="card" style="background-color: var(--bs-dark-bg-subtle);"><div class="card-body"><h4>備考</h4>'
."<strong>備考</strong><p>".$comment_br_ja."</p></div></div>";

$message_success = $tr->translate('Thank you for filling the form out. Please wait until we call you.');

require_once "mail_en.php";
mailer($fname.' '.$lname, $answers_text, $answers_ja_text, $answers_html, $answers_ja_html, $message_success);
?>