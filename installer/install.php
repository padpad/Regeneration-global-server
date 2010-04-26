<?php

// Thu 22 Apr 2010 21:43:48 BST
// built with mkinstaller 2010040609 by Manuel Mollar (mm AT nisu.org) http://mkInstaller.nisu.org/
// do not remove this Copyright

$ilic='
Copyright (c) 2006-2009 Manuel Mollar
mm AT nisu.org http://mkInstaller.nisu.org/
This software is released under a MIT License.
http://www.opensource.org/licenses/mit-license.php
';

error_reporting(E_ALL ^ E_NOTICE);
ini_set(track_errors,true);
$lg=detLang($_REQUEST["lang"],"en");
foreach(array("gzdeflate"=>"zlib", ) as $f => $p)
  if (!function_exists($f))
    salir(sprintf(st("Lfne"),$f,$p));
$hhost=$_SERVER["HTTP_HOST"];
if ($exsfn=$_REQUEST["scfn"])
  $sfn=$exsfn;
else if ($hhost)
  $sfn=$_SERVER["SCRIPT_FILENAME"];
else
  $sfn=$argv[0];
$fin=@fopen($sfn,"rb") or
  salir(st("Eali"));
$pidi=strpos(fread($fin,67707),"\n?>")+3;
$pidd=$pidi+8004;
$files=unserialize(tkInBuff(6700));
$dsdb=unserialize(tkInBuff(6812));
$dvars=unserialize(tkInBuff(7492));
$plans=array('en'=>3008,);
$css=5784;
$uniq="mkI4bd0b50460062";
if ($j=$_REQUEST["jmp"]) {
  foreach($files as $fic)
    if ($fic["j"] == $j)
      $simu or eval("?>".trim(tkInBuff($fic["po"])));
  die();
}
if ($info) {
  $dopt=unserialize(tkInBuff(7872));
}
if ($info)
  return;

$simu or $simu=$_REQUEST["simu"];
$tby=$twr=$taa=0; $ma=""; $smo=0.5; $buf=false;


loadPi();
if ($argv[1]) {
  $cml=true;
  $brk="\n";
  $vo=array();
  foreach($dvars as $var => $def) {
    if (isset($def["vl"]))
      $val=$def["vl"];
    else {
      $d=$def["df"];
      if ($def["ml"] and is_array($d))
	if($dlg=$d[$lg])
	  $d=$dlg;
	else
	  $d=current($d);
      if (is_array($d)) {
        if ($se=$def["se"]) {
	  $d=array_keys($d);
	  $se=$d[$se-1];
	}
	else
          $se=key($d);
        eval('$val='."$se;");
      }
      else
        eval('$val='.$d.";");
    }
    $vo[$var]=$val;
  }
  for($i=1; $i<$argc; $i++) {
    list($var,$val)=explode("=",$argv[$i]);
    if ($val)
      $vo[dechex(crc32($var))]=$val;
    else
      $o[$var]=true;
  }
  $ve=$v=$vo;
  if (!$simu)
    foreach($dvars as $var => $def) {
      $val=$v[$var];
      if ($def["ev"]) {
        if (@eval('$val='.$val.";") === false)
          salir(st("ExIn")."\n".$val."\n".$php_errormsg);
        $ve[$var]=$val;
      }
      if (!$ve[$var] && $o["intc"]) {
        echo $def["va"],": ";
	$ve[$var]=substr(fgets(STDIN),0,-1);
      }
    }
  $v=$ve;
  foreach($dvars as $var => $def) {
    if ((($val=$v[$var]) === "") and ($em=$def["em"]))
      $v[$var]=$val=$v[$em];
    if ($def["st"])
      $v[$var]=var_export($val,true);
  }
  $doit=true;
}
else if ($_REQUEST["doit"]) {
  $brk="<br>";
  $cml=(!$_REQUEST["jsav"]);
  if (!$cml) {
    ob_start(); $buf=true;
  }
  $o=&$_REQUEST;
  if ($vo=$_REQUEST["v"])
    foreach($vo as $var => $val) {
      if (get_magic_quotes_gpc())
        $vo[$var]=stripslashes($val);
    }
  $ve=$v=$vo;
  if (!$simu)
    foreach($dvars as $var => $def) {
      $val=$v[$var];
      if ($def["ev"]) {
        if (@eval('$val='.$val.";") === false)
          salir(st("ExIn")."<br>".$val."<br>".$php_errormsg,true);
        $ve[$var]=$val;
      }
    }
  $v=$ve;
  foreach($dvars as $var => $def) {
    if ((($val=$v[$var]) === "") and ($em=$def["em"]))
      $v[$var]=$val=$v[$em];
    if ($def["st"])
      $v[$var]=var_export($val,true);
  }
  $doit=true;
}
else
  $doit=false;

if ($doit) {
  $time=time();
  if (!$cml) {
    header("Pragma: no-cache"); header("Cache-control: no-cache");
    echo str_replace("{CSS}",tkInBuff($css),tkInBuff(6348));
    echo "<script> try { parent.chStep('2'); } catch(e) {} </script>";
    echo "<tr><td id=ftd>\n";
  }
  $simu and loge(st("Sosi"));
  if (!$o["nrun"])
    foreach($files as $fic) {
      if ($fic["x"] == "f") {
	$nf=$fic["n"];
	loge(sprintf(st("Pefs"),$nf));
        loge(sprintf(st("Eefs"),$nf));
	$f=trim(tkInBuff($fic["po"]));
	parsea($f);
        $simu or eval("?>$f");
      }
    }
  foreach($files as $if => $fic)
    if ($fic["j"] or $fic["x"] == "f")
      unset($files[$if]);
  @ob_end_flush(); $buf=false;
  if (!$cml)
    echo "<tr><td id=gtd>\n";
  dataOpen($sfn);
  $prt=true; $run=array();
  foreach($files as $if => $fic) {
    $nf=$fic["n"];
    if ($cnd=$fic["c"]) {
      $vv=dechex(crc32($cnd["v"]));
      $vv=$v[$vv];
      if (function_exists("preg_match"))
        $ndc=!preg_match("/".$cnd["e"]."/",$vv);
      else
        $ndc=true;
    }
    else
      $ndc=false;
    $ndo=($ndc or $simu);
    if ($l=$fic["l"]) {
      if (!$ndo) {
        @unlink($nf);
        symlink($l,$nf);
      }
    }
    else if ($fic["d"])
      $ndo or crd("$nf/.",$fic["a"][0]);
    else {
      if ($fic["p"]) {
	$f=tkBuff();
	if ($fic["x"])
	  $ndc or loge(sprintf(st("Pefs"),$nf));
        else
	  $ndc or loge(sprintf(st("Pyce"),$nf));
	parsea($f);
	if (function_exists("preg_replace"))
	  $f=preg_replace(array("#^([ \t]*//[ \t]+)%$lg%:[ \t]+#m","#^[ \t]*//[ \t]+%..%:[ \t].*\n#m"),array("\\1",""),$f);
        $prt=false; ob_start();
        if (!@eval("return true; function $uniq$if() {?> $f <?php }") and
            !@eval("return true; function $uniq$if() {?> $f }"))
          salir(sprintf(st("Epds"),$nf)."<xmp>$f</xmp>".ob_get_clean(),true);
	ob_end_clean();
	if ($fic["x"])
	  $run[$nf]=$f;
	else if (!$ndo) {
          crd($nf);
	  $h=@fopen($nf,"wb") or salir(sprintf(st("Npcf"),$nf).$brk.$php_errormsg,true);
	  (@fwrite($h,$f) !== false) or salir(sprintf(st("Npef"),$nf).$brk.$php_errormsg,true);
          fclose($h);
	  @chmod($nf,$fic["a"][0]);
	  @touch($nf,$fic["a"][1]);
        }
      }
      else if (!$fic["x"]) {
        $ndo or crd($nf);
        $ndo or $h=@fopen($nf,"wb") or salir(sprintf(st("Npcf"),$nf).$brk.$php_errormsg,true);
        $ta=$fic["ta"];
        $ndc or loge(sprintf(st("Cefs"),$nf));
        while (true) {
          $bf=tkBuff();
          $ndo or (@fwrite($h,$bf) !== false) or salir(sprintf(st("Npef"),$nf).$brk.$php_errormsg,true);
          $ta-=strlen($bf);
	  if (!$ta)
	    break;
        }
        if (!$ndo) {
	  fclose($h);
	  @chmod($nf,$fic["a"][0]);
	  @touch($nf,$fic["a"][1]);
	}
      }
    }
  }
  if (!$o["skdb"]) {
    foreach($dsdb as $idb => $sbd) {
      if ($alt=$sbd["alt"]) {
        $vv=dechex(crc32($alt));
        $vv=$v[$vv];
        if ($vv != $idb) {
          foreach($sbd as $ibd => $n)
            if (is_array($n))
              for($icr=0; $icr < $n["no"]; $icr++)
                tkBuff();
          continue;
        }
      }
      foreach(array("ho","pt","us","pw") as $n)
        if ($nv=$sbd["v$n"]) {
	  $vv=dechex(crc32($nv));
	  $vv=$v[$vv];
          if (!$vv)
            salir(sprintf(st("Lvsu"),$nv,$idb));
          $simu or eval('$vv='.$vv.";"); // usually due to var_export
          $con[$n]=$vv;
        }
        else
          $con[$n]=$sbd[$n];
      if (!$o["dmdb"] and ($ty=$sbd["ty"]) == "mysql")
	if (!$simu) {
	  if (!function_exists("mysql_connect"))
	    loge(sprintf(st("Lfne"),"mysql_connect","mysql"));
	  if ($con["pt"])
	    $con["ho"].=":".$con["pt"];
	  @mysql_connect($con["ho"],$con["us"],$con["pw"]) or
	  salir(sprintf(st("Npcs"),$php_errormsg.@mysql_error()),true);
	}
      foreach($sbd as $ibd => $n)
        if (is_array($n)) {
          if ($nv=$n["vdb"]) {
	    $vv=dechex(crc32($nv));
	    $vv=$v[$vv];
            if (!$vv)
              salir(sprintf(st("Lvsu"),$nv,$ibd));
            $simu or eval('$vv='.$vv.";");
            $nbd=$vv;
          }
          else
            $nbd=$n["db"];
	  if ($o["dmdb"]) {
	    if (file_exists("$nbd.dump"))
	      salir(sprintf(st("Npev"),"$nbd.dump"));
	    $simu or $hm=fopen("$nbd.dump","w");
	    $wtg=st("Escr");
	  }
	  else {
	    $wtg=st("Oper");
            if (!$simu and $ty == "pgsql") {
	      if (!function_exists("pg_connect"))
	        loge(sprintf(st("Lfne"),"pg_connect","PostgreSQL"));
              if (!@pg_connect("host='${con['ho']}' port='${con['pt']}' user='${con['us']}' password='${con['pw']}' dbname='$nbd'")) {
                $h=@pg_connect("host='${con['ho']}' port='${con['pt']}' user='${con['us']}' password='${con['pw']}' dbname=template1") or 
	          salir(sprintf(st("Npcs"),$php_errormsg.@pg_last_error()),true);
	        @pg_query("create database \"$nbd\"") or
	          salir(st("Npcb").$php_errormsg.@pg_last_error(),true);
	        loge(sprintf(st("Clbd"),$nbd));
	        @pg_close($h);
	        @pg_connect("host='${con['ho']}' port='${con['pt']}' user='${con['us']}' password='${con['pw']}' dbname='$nbd'")
	          or salir(sprintf(st("Npsb"),$nbd).$php_errormsg.@pg_last_error(),true);
	      }
	    }
	    else
              if (!$simu and !@mysql_select_db($nbd)) {
                @mysql_query("create database `$nbd`") or
                  salir(st("Npcb").$php_errormsg.@mysql_error(),true);
                loge(sprintf(st("Clbd"),$nbd));
                @mysql_select_db($nbd) or
                  salir(sprintf(st("Npsb"),$nbd).$php_errormsg.@mysql_error(),true);
              }
	  }
          loge(sprintf(st("Slbd"),$nbd));
          for($icr=0; $icr < $n["no"]; $icr++) {
            $cr=tkBuff();
	    loge(sprintf($wtg,substr($cr,0,strpos("$cr(","("))));
	    if (!$simu)
	      if ($o["dmdb"])
	        fwrite($hm,$cr);
	      else if ($ty == "mysql")
                @mysql_query($cr) or salir(sprintf(st("Esae"),@mysql_error()),true);
	      else
	        @pg_query($cr) or salir(sprintf(st("Esae"),@pg_last_error()),true);
          }
        }
    }
  }
  else
    loge(st("Bdnp"));
  $tby=7040; $twr=25;
  loge(st("Inco"));
  if (!$cml)
    echo "<tr><td class=rtd>\n";
  if (!$o["nrun"])
    foreach($run as $nf => $f) {
      loge(sprintf(st("Eefs"),basename($nf)));
      $simu or eval("?>$f");
    }
  loge(sprintf(st("Tito"),time()-$time));
  $simu or savePi();
  if (!$cml)
    echo"</table>\n<script>try { parent.chStep('3'); } catch(e) {} </script></body>\n</html>";
}
else if($hhost) {
  header("Pragma: no-cache"); header("Cache-control: no-cache");
  if ($_REQUEST["wk"]) {
    ob_start(); $buf=true;
    echo str_replace("{CSS}",tkInBuff($css),tkInBuff(6348));
    echo "<script> try { parent.chStep('1'); } catch(e) {} </script>";
    $cml=false; 
    echo "<tr><td id=ftd>\n";
    $simu and loge(st("Sosi"));
    
    if (!@touch($tmf=uniqid("mktest"))) {
      loge(sprintf(st("Anpc"),getcwd()),true);
      loge($php_errormsg);
    }
    @unlink($tmf);
    foreach($files as $if => $fic) {
      if ($fic["x"] == "l")
	$simu or eval("?>".trim(tkInBuff($fic["po"])));
    }
    @ob_end_flush(); $buf=false;
    echo "<tr><td id=gtd>\n".
      "<form method=post id=for>\n".
      "<script>document.write('<input type=hidden name=jsav value=1>');</script>\n";
    echo "<table id=tab>\n";
    foreach($dvars as $id => $def) {
      $mg=&$def["lg"][$lg];
      if (!$mg)
        $mg=&$def["lg"]["en"];
      $ty=strtolower($def["ty"]);
      if ($sp=&$def["sp"][$lg])
        echo "  <tr><td id=sp$id class=sep colspan=2>$sp";
     if ($ty != "hidden")
        echo "  <tr><td id=td$id class=lab>$mg: ";
      $sz=$def["sz"]; $vs=$def["vs"]; $d=$def["df"];
      if ($def["ml"] and is_array($d))
        if($dlg=$d[$lg])
          $d=$dlg;
        else
          $d=current($d);
      if (is_array($d)) {
	if ($def["mp"])
          echo "<td id=ti$id class=tse><select id=in$id size=\"$sz\" multiple name=\"v[$id][]\" class=sel>";
	else
          echo "<td id=ti$id class=tse><select id=in$id size=\"$sz\" name=\"v[$id]\" class=sel>";
        $vse=$def["vl"] or $se=$def["se"]; $c=1;
        foreach($d as $v=>$t) {
	  $ok=false;
	  eval('$val='.$v.';$ok=true;');
	  if (!$ok)
            echo "<xmp>$v</xmp>";
	  if (!$t)
	    $t=$val;
	  $val=htmlspecialchars($val,ENT_COMPAT);
	  $sel=(($vse == $val or $se == $c) ? " selected" : "");
	  $c++;
          echo "<option$sel value=\"$val\">$t";
        }
        echo "</select>\n";
      }
      else {
        if ($ty != "hidden")
          if ($vs)
	    echo "<td id=ti$id class=ttx>";
	  else
            echo "<td id=ti$id class=tin>";
        switch ($ty) {
	  case "text":
	  case "checkbox":
	  case "password":
	  case "hidden": $ty=" type=$ty"; break;
	  case "readonly": $ty=" type=text readonly"; break;
	}
	$ok=false;
	if (isset($def["vl"]))
	  $val=$def["vl"]; 
	else {
	  eval('$val='.$d.';$ok=true;');
	  if (!$ok)
	    echo "<xmp>$d</xmp>";
	}
	$val=htmlspecialchars($val,ENT_COMPAT);
	if ($vs)
	  echo "<textarea id=in$id rows=$vs cols=$sz class=txt name=\"v[$id]\">$val</textarea>\n";
	else {
	  if ($sz)
	    $sz=" size=$sz";
	  echo "<input id=in$id class=inp name=\"v[$id]\" value=\"$val\"$ty$sz>\n";
	}
      }
    }
    echo "  <tr><td id=tidoit colspan=2 class=tsu><input id=indoit class=sub type=submit name=doit value=\"".htmlentities(st("Inst"))."\">\n";
    echo "</table>";
    echo "</form>\n<script>mv(100,7040,25);</script>\n</table>\n</body></html>";
  }
  else {
    if (!$p=$plans[$lg])
      $p=$plans["en"];
    echo str_replace("{CONT}",str_replace(array("{NOFR}","{QSTR}"),
		array(st("Papc"),$_SERVER["QUERY_STRING"]),tkInBuff(6184)),tkInBuff($p));
  }
}
else {
  $cml=true;
  foreach($files as $if => $fic) {
    if ($fic["x"] == "l")
      $simu or eval("?>".trim(tkInBuff($fic["po"])));
  }
  salir(st("Dppa"));
}
die();

function tkInBuff($po) {
  global $fin, $simu, $pidi;
  if (@fseek($fin,$po+$pidi) !== 0)
    salir(st("Eali"));
  if ((strlen($l=@fread($fin,12)) != 12) or
      (trim($l) !== strval(intval($l))))
    salir(st("Eali"));
  if (strlen($b=@fread($fin,$l)) != $l)
    salir(st("Eali"));
  $b=@gzinflate(base64_decode($b));
  if ($b === false)
    salir(st("Eali"));
  if ($simu)
    usleep($simu);
  return $b;
}
function tkBuff() {
  global $fdd, $tby, $twr, $simu;
  if ((strlen($l=fread($fdd,12)) != 12) or
      (trim($l) !== strval(intval($l))))
    salir(st("Eale"));
  if (strlen($b=fread($fdd,$l)) != $l)
    salir(st("Eale"));
  $b=@gzinflate(base64_decode($b));
  if ($b === false)
    salir(st("Eale"));
  $tby+=12+strlen($b);
  $twr++;
  if ($simu)
    usleep($simu);
  return $b;
}
function dataOpen($f) {
  global $fdd, $pidd;
  $fdd=@fopen($f,"rb") or salir(sprintf(st("Npae"),$f));
  fseek($fdd,$pidd);
  return true;
}


function parsea(&$f) {
  global $dvars, $v, $uniq;
  foreach($dvars as $var => $va) {
    $val=$v[$var];
    if (!$va["prt"]) {
      if ($va["ty"] == "password")
        loge($va["va"]."=********");
      else {
        $nlval=explode("\n",$val);
        loge($va["va"]."=".$nlval[0]);
      }
      $dvars[$var]["prt"]=true;
    }
    $f=str_replace("$uniq.$".$va["va"].".$uniq",$val,$f);
  }
}
function &gDfVar($n) {
  global $dvars;
  return $dvars[dechex(crc32($n))];
}
function gValVar($n) {
  global $v;
  return $v[dechex(crc32($n))];
}
function loge($m,$lit=false) {
  global $cml, $tby, $twr, $brk, $ma, $taa, $buf, $smo;
  $ta=floor(100*($tby/7040*$smo+$twr/25*(1-$smo)));
  if (($ma != $m) or ($taa != $ta))
    if ($cml) {
      if (function_exists("preg_replace"))
        $m=preg_replace("/<[^>]*>/","",$m);
      echo "$m ($ta%,$tby,$twr)$brk";
    }
    else {
      $sc="";
      if ($ma != $m) {
        if ($lit)
	  echo "$m<br>";
	else
          echo htmlentities($m)."<br>";
	$sc.="sc();";
      }
      if ($taa != $ta)
        $sc.="mv($ta,$tby,$twr);";
      echo "<script>$sc</script>\n";
    }
  $ma=$m;
  $taa=$ta;
  $buf or flush();
  return true;
}
function salir($m,$lit=false) {
  loge("\n      $m",$lit);
  echo "\n";
  die(intval($m != ""));
}

function mkdr($dir, $mode = 0755) {
  if (is_dir($dir) || (@mkdir($dir) && @chmod($dir,$mode))) return true;
  if (!mkdr(dirname($dir),$mode)) return false;
  return (@mkdir($dir) && @chmod($dir,$mode));
}

function crd($f, $m = 0755) {
  if (!mkdr($d=dirname($f),$m))
    salir(sprintf(st("Npce"),$d));
  return true;
}

function st($id) {
  global $mg,$lg;
  if (is_array($id))
    $p=$id;
  else {
    if (!is_array($mg))
      $mg=unserialize('a:1:{s:4:"Lfne";a:3:{s:2:"es";s:57:"La funci�n %s no est� disponible, revisa el modulo php %s";s:2:"ca";s:55:"La funcio %s no esta disponible, revisa el m�dul php %s";s:2:"en";s:65:"The %s function is not available, please review the php module %s";}}');
    if (!$mg[$id]) {
      $mg=array_merge(unserialize(gzinflate(base64_decode('Tc1BCoAwDATAr5T+QCsI8exDgl2kEFpIexP/biwWvIQN7CRME12VFvI7S/IbU3j3mTyq3yoFS7tqUcfiBFAnpbrIzWbKDZpL71nt4A6WPxCcyQheEjEIBkHuYR1EwTHl86vZAXtkV+/7AQ=='))),$mg);
      $mg=array_merge(unserialize(tkInBuff(0)),$mg); 
    }
    $p=&$mg[$id];
  }
  if (!$lg)
    $lg="en";
  if ($m=&$p[$lg])
    return $m;
  else if ($m=&$p["en"])
    return $m;
  else
    return $p["en"];
}
function detLang($re,$df) {
  global $dvars;
  if ($re)
    return $re;
  $lgs=array('en'=>true,);
  list($acp)=explode(";",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]));
  foreach(explode(",",$acp) as $la)
    if ($lgs[$la])
      return $la;
  if (!$la)
    $la=substr(setlocale(LC_ALL,""),0,2);
  if ($la)
    return $la;
  else
    return $df;
}
function loadPi() {
  global $dvars, $reInst, $iip;
  if (!$c=@file_get_contents("_mkI_last_inst_5155dfc5.php"))
    return false;
  if (substr($c,0,10) != "<?php //!!")
    return false;
  $reInst=true;
  @eval("?>$c<?php ");
  if (!$pdv)
    return false;
  if ($_REQUEST["nsav"])
    return false;
  foreach($dvars as $v => $vv)
    if (is_array($pd=$pdv[$v]))
      $dvars[$v]["vl"]=$pd["vl"];
  return true;
}
function savePi() {
  global $dvars, $vo, $o;
  if ($_REQUEST["nsav"] or $o["nsav"])
    return false;
  $pdv=array();
  foreach($dvars as $vv => $vvv)
    if (!$vvv["ns"])
      $pdv[$vv]["vl"]=$vo[$vv];
  $h=@fopen($fPi="_mkI_last_inst_5155dfc5.php","w");
  @fwrite($h,"<?php //!!\n\$pdv=".var_export($pdv,true).";\n?>");
  @fclose($h);
  @chmod($fPi,0600);
  return true;
}
?>        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         152cw5ydQxxVQhxdPJxVUgozsgviM8sSc0tTlDQ4FKACaQkKGTmlWiYaSr4+Yco+IX6+OiAJEEKcUom5uaX5pVglysoykxOxZDi0lRw9XP39HO19a30DHb0VXBxdXMM9QlRcPZwDAp2DbHNSSzJzDO0BgA=         220bY6xDoIwFAB3vuKNJXFRg4thqPjURigR28GJNtCEJloINEb9eoNOEpdb7oZLCqQCQdBNiqCGpu0GBSQAULZWYJ0nqxB4LoDLNAUqRV4ynhSYIRezMXu1zpR/2o90+mYU3HVfNboniyia+NoMVW87b1unwJuH/9GSs5NEOOLle0NGhkEIyPeMY5w92Zlmk6l4CVvcUZkKSA60OKOIr9pbN1+/AQ==         164cw5ydQxxVQhxdPJxVUgoLU4tik9LTE5Nys/PTlDQ4FJQSIBx4zNTEhQy80o0zDQV/PxDFPxCfXx0QArAmnBIhvp5Boa6Kni7RqIZpIHC1eTSVHD1c/f0c7X1rfQMdvRVcHF1cwz1CVFw9nAMCnYNsc1JLMnMM7QGAA==         168cw5ydQxxVQhxdPJxVUgoLU4tis/ILC7JL8pMLU5Q0OBSgApmpiQoZOaVaJhpKvj5hyj4hfr46IAkSzJzUyEyhgZoUhBzKhMUyhKLkjMSizSMTE0RSrg0FVz93D39XG19Kz2DHX0VXFzdHEN9QhScPRyDgl1DbHMSSzLzDK0B         148cw5ydQxxVQhxdPJxVUgoLU4tis8sSc0tTlDQ4FJQSACx4zNTEhQy80o0zDQV/PxDFPxCfXx0QJIQ1TgkE3PzS/NKMOS4NBVc/dw9/VxtfSs9gx19FVxc3RxDfUIUnD0cg4JdQ2xzEksy8wytAQ==         300fdAxT8MwEAXgvb/itiYSAxSCkFAGNz0gInWRcYZOtdW4wSI9IzuBvw+pBIlSifm+96R3mUAmESRbFgiqC8YHBdEMQNlKgaU2urqMoaNgazIV8I0EXhYFsFJudjnPBK6Ry4s+0IdJH42CT+33b9pH1z/R38SJmKO2zXBfJMkEfOgQvpyvBnN7E8MKH1hZjFjr3g1Nes5Q42pLYRhxDnRodyf1D/KuGS1KposaTXWn6/HooWRuaN6rF5GvmdjCM24h6h8bz2JA/phzTHMit1pO/pku/jqyJyZeUaZde7i7/wY=         136cw5ydQxxVQhxdPJxVUioys9Ljc/NzysuSS1KUNDgUoAKZaYkKGTmlWiYaSr4+Yco+IX6+OiAJKFKsclzaSq4+rl7+rna+lZ6Bjv6Kri4ujmG+oQoOHs4BgW7htjmJJZk5hlaAwA=         236bY6xDoIwFEV3vuKNkLhIwMUwVHwqEYopZWCyBBptosVAY8CvN8hgJK7n3pt7QoaEI3CyiRHEq9GyE2BbAELVApQ29soBmnKgeRwDyXl6jmjIMEHKF2NNl3cp4Fm21bVsbdf3v/VPXsuuatXDqEYLMLI3v7HUsr0M05M3m/YTdmd4+ItPLEoIK+CIBdijvGM5gHQfUQySIcpIMrMPPNjijuQxh/BAWIY8uJVG6eX6DQ==