<?php
if (isset($_POST['extract'])) {
  $contigName = SQLite3::escapeString($_POST['contigName']);
  $startPos = SQLite3::escapeString($_POST['startPos']);
  $stopPos = SQLite3::escapeString($_POST['stopPos']);
  $db = SQLite3::escapeString($_POST['db']);

//  if ( $db == "anagrbonn"){ $dbfile = "./fastas/AagrBONN_genome.fasta"; }
//  else if ( $db == "anagroxf") {$dbfile = "./fastas/Anthoceros_agrestis_Oxford_genome.fasta"; }
//  else if ( $db == "anfus") {$dbfile = "./fastas/Anthoceros_fusiformis_genome.fasta"; }
//  else if ( $db == "anpun") {$dbfile = "./fastas/Anthoceros_punctatus_genome.fasta"; }
//  else if ( $db == "ledus") {$dbfile = "./fastas/Leiosporoceros_dussii_genome.fasta"; }
//  else if ( $db == "mefla") {$dbfile = "./fastas/Megaceros_flagellaris_genome.fasta"; }
//  else if ( $db == "noorb") {$dbfile = "./fastas/Notothylas_orbicularis_genome.fasta"; }
//  else if ( $db == "papea") {$dbfile = "./fastas/Paraphymatoceros_pearsonii_genome.fasta"; }
//  else if ( $db == "phcar") {$dbfile = "./fastas/Phaeoceros_carolinianus_genome.fasta"; }
//  else if ( $db == "phsp")  {$dbfile = "./fastas/Phaeoceros_sp_genome.fasta"; }
//  else if ( $db == "phchi") {$dbfile = "./fastas/Phaeomegaceros_chiloensis_genome.fasta"; }
//  else if ( $db == "phphy") {$dbfile = "./fastas/Phymatoceros_phymatodes_genome.fasta"; }
  $dbfile = "./.assets/Pteridium_aquilinum_genome.fasta";
  $seq = shell_exec("./getFastaBases_web.py {$dbfile} {$contigName} {$startPos} {$stopPos} 2>&1");
echo "<pre>";
echo '<br><div class="seq">';
echo ">{$contigName}:{$startPos}-{$stopPos}";
echo "<br>{$seq}</div>";
echo "</pre>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Extract Sequence</title>
<style type="text/css">
   content{
        width: 50%;
        margin: 20px auto;
        border: 1px solid #cbcbcb;
   }
   .seq{
    max-width: 80ch;
    word-break: break-word;
    white-space: pre-wrap;
   }
   form{
        width: 50%;
        margin: 20px auto;
   }
   form div{
        margin-top: 5px;
   }
   img_div{
        width: 80%;
        padding: 5px;
        margin: 15px auto;
        border: 1px solid #cbcbcb;
   }
   img_div:after{
        content: "";
        display: block;
        clear: both;
   }
   img{
    display: block;
    width:100%;
    max-width:600px;
    max-height:600px;
    width: auto;
    height: auto;
   }
   input,
   select,
   textarea {
    max-width: 1000px;
   }
   table,
   table td {
    border: 1px solid #cccccc;
   }
   td {
    text-align: center;
    vertical-align: middle;
   }
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<div id="content" align="center">
 <a href="pteridiumbase.php">Search</a> | <a href="blast.php">BLAST</a> | <a href="downloads.html">Download Files</a>
</div>
<div id="content" align="center">
<h3>Extract sequence from <i>Pteridium aquilinum</i> genome</h3>
<body>
  <div>
  <!--<form method="post" action="extract.php" enctype="multipart/form-data">
   <label for="db-select">Choose species:</label>
   <select name="db" id="db-select">
     <option value="anagrbonn">Anthoceros agrestis Bonn</option>
     <option value="anagroxf">Anthoceros agrestis Oxford</option>
     <option value="anfus">Anthoceros fusiformis</option>
     <option value="anpun">Anthoceros punctatus</option>
     <option value="ledus">Leiosporoceros dussii</option>
     <option value="mefla">Megaceros flagellaris</option>
     <option value="noorb">Notothylas orbicularis</option>
     <option value="papea">Paraphymatoceros pearsonii</option>
     <option value="phcar">Phaeoceros carolinianus</option>
     <option value="phsp">Phaeoceros sp.</option>
     <option value="phchi">Phaeomegaceros chiloensis</option>
     <option value="phphy">Phymatoceros phymatodes</option>
   </select>-->
   <p>Contig Name
   <input type="text" name="contigName" placeholder = ""></p>
   <p>Start Position
   <input type="text" name="startPos" placeholder = ""></p>
   <p>Stop Position
   <input type="text" name="stopPos" placeholder = ""></p>
   <div align="center">
     <button type="submit" name="extract">SUBMIT</button>
   </div>
 </form>
 </div>
 <div id="content" align="center">
  <a href="pteridiumbase.php">Search</a> | <a href="blast.php">BLAST</a> | <a href="downloads.html">Download Files</a>
 </div>
</body>
</html>
