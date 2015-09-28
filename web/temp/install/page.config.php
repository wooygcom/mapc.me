<h1 class="header">환경설정</h1>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return frm_submit(this);" role="form" class="form-horizontal">

  <div class="form-group">
    <label for="site_code_abcd" class="control-label col-sm-2"><?= _('사이트 고유값'); ?></label>
    <div class="col-sm-10">
      <input type="text" id="site_code_abcd" name="site_code" placeholder="<?= _('사이트 고유값을 8글자의 영문으로 입력하세요.'); ?>" class="form-control" />
    </div>
  </div>

  <div class="form-group">
    <span class="col-sm-10 col-md-offset-2">아래 정보는 DB를 사용할 때만 입력하세요.</span>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="db_host_abcd">DB 서버</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="db_host_abcd" name="db_host" placeholder="DB서버의 주소">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="db_name_abcd">DB 이름</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="db_name_abcd" name="db_name" placeholder="데이터베이스 이름">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="db_user_abcd">DB 사용자</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="db_user_abcd" name="db_user" placeholder="DB 사용자">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="db_passwd_abcd">DB 암호</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="db_passwd_abcd" name="db_passwd" placeholder="DB 암호">
    </div>
  </div>

  <button type="submit" class="btn btn-primary btn-block">확인</button>

  <?php
  // #TODO 고급환경설정 펼치기화면. 필요한 환경설정값을 전부 입력하는 화면
  ?>

</form>


<?php
$site_code = $_POST['site_code'];

if($site_code) {

    echo '잠시만 기다려주세요.';
 
    $root_path = __DIR__ . '/../../';
    $path_check['config'] = $root_path . 'app/site/' . $site_code . '/config/';
    $path_check['temp']   = $root_path . 'temp/';

    $path_available = true;
    $path_permission = '707';

    if (empty($page) && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {

        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cgi') {

            mkdir($path_check['config'], 0705, true);
            foreach($path_check as $var) {

                // 필요한 디렉토리에 파일 생성 가능한지 검사.
                if (!(is_readable($var) && is_executable($var)))
                {
                    $path_name[]     = $var;
                    $path_permission = '705';
                    $page            = 'error';
                    $path_available  = false;
                }

            }

        } else {

            mkdir($path_check['config'], 0707, true);
            foreach($path_check as $var) {

                // 필요한 디렉토리에 파일 생성 가능한지 검사.
                if (!(is_readable($var) && is_writeable($var) && is_executable($var)))
                {
                    // 필요한 디렉토리에 파일 생성 가능한지 검사.
                    $path_name[]     = $var;
                    $path_permission = '707';
                    $page            = 'error';
                    $path_available  = false;
                }

            }
        }
    }

    if($path_available) {

        $original_path = $root_path . 'app/site/default/';
        $target_path   = $root_path . 'app/site/' . $site_code . '/';
        mkdir($target_path, $path_permission, true);

        $options = array('folderPermission' => $path_permission, 'filePermission' => $path_permission);

        if(smartCopy($original_path, $target_path, $options)) {

            $page = 'welcome';

        } else {

            $error = _('해당경로에 화일을 생성할 수 없습니다.');
            $page = 'error';

        }

        // 설치 마무리 되었을 때... 화일생성.
        if($page == 'welcome') {

// --------------------------------------------------
// ENV 화일 수정
// --------------------------------------------------
$str = '<?php
    if(!defined("__MAPC__")) { exit(); }

    /**
     *
     * Very necessary config, almost config file located in app/site/config/ directory.
     *
     */

    { // BLOCK:basic_config:20150807:기본값지정

        // default, sample, cms and you can make your own SITE_CODE (/app/site/YOUR_OWN)
      define("SITE_CODE", "' . $site_code . '");

        // make false before publish
      define("DEBUG_MODE", false);

    } // BLOCK

// end of file
';

file_put_contents($root_path . 'env.php', $str);

// --------------------------------------------------

            if(!empty($_POST['db_host'])) {

// --------------------------------------------------
// DB 화일 수정
// --------------------------------------------------
$str = '<?php
    if(!defined("__MAPC__")) { exit(); }

    /**
     * DB 환경설정
     */

    $CONFIG_DB = array();
    $CONFIG_DB["type"]   = "mysql";
    $CONFIG_DB["host"]   = "' . $_POST['db_host'] . '";
    $CONFIG_DB["name"]   = "' . $_POST['db_name'] . '";
    $CONFIG_DB["user"]   = "' . $_POST['db_user'] . '";
    $CONFIG_DB["pass"]   = "' . $_POST['db_passwd'] . '";
    $CONFIG_DB["prefix"] = "mc_";
    $CONFIG_DB["encode"] = "utf8";

// end of file
';

file_put_contents($target_path . 'config/db.php', $str);

// --------------------------------------------------
            }

// --------------------------------------------------
// 테이블 생성
// --------------------------------------------------
    $file = implode('', file('./install.sql'));
    eval("\$file = \"$file\";");

    $file = preg_replace('/^--.*$/m', '', $file);
//    $file = preg_replace('/`mc_([^`]+`)/', '`'.$table_prefix.'$1', $file);
    $f = explode(';', $file);
    for ($i=0; $i<count($f); $i++) {
        if (trim($f[$i]) == '') continue;
        mysql_query($f[$i]) or die(mysql_error());
    }

// --------------------------------------------------

        }

    }

}

if(! empty($page) && $page != 'config') { header('location:?page=' . $page); }

/** 
 * Copy file or folder from source to destination, it can do 
 * recursive copy as well and is very smart 
 * It recursively creates the dest file or directory path if there weren't exists 
 * Situtaions : 
 * - Src:/home/test/file.txt ,Dst:/home/test/b ,Result:/home/test/b -> If source was file copy file.txt name with b as name to destination 
 * - Src:/home/test/file.txt ,Dst:/home/test/b/ ,Result:/home/test/b/file.txt -> If source was file Creates b directory if does not exsits and copy file.txt into it 
 * - Src:/home/test ,Dst:/home/ ,Result:/home/test/** -> If source was directory copy test directory and all of its content into dest      
 * - Src:/home/test/ ,Dst:/home/ ,Result:/home/**-> if source was direcotry copy its content to dest 
 * - Src:/home/test ,Dst:/home/test2 ,Result:/home/test2/** -> if source was directoy copy it and its content to dest with test2 as name 
 * - Src:/home/test/ ,Dst:/home/test2 ,Result:->/home/test2/** if source was directoy copy it and its content to dest with test2 as name 
 * @todo 
 *     - Should have rollback technique so it can undo the copy when it wasn't successful 
 *  - Auto destination technique should be possible to turn off 
 *  - Supporting callback function 
 *  - May prevent some issues on shared enviroments : http://us3.php.net/umask 
 * @param $source //file or folder 
 * @param $dest ///file or folder 
 * @param $options //folderPermission,filePermission 
 * @return boolean 
 *
 * from : php.net
 */ 
function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755)) 
{ 
    $result=false; 
    
    if (is_file($source)) { 
        if ($dest[strlen($dest)-1]=='/') { 
            if (!file_exists($dest)) { 
                cmfcDirectory::makeAll($dest,$options['folderPermission'],true); 
            } 
            $__dest=$dest."/".basename($source); 
        } else { 
            $__dest=$dest; 
        } 
        $result=copy($source, $__dest); 
        chmod($__dest,$options['filePermission']); 
        
    } elseif(is_dir($source)) { 
        if ($dest[strlen($dest)-1]=='/') { 
            if ($source[strlen($source)-1]=='/') { 
                //Copy only contents 
            } else { 
                //Change parent itself and its contents 
                $dest=$dest.basename($source); 
                @mkdir($dest); 
                chmod($dest,$options['filePermission']); 
            } 
        } else { 
            if ($source[strlen($source)-1]=='/') { 
                //Copy parent directory with new name and all its content 
                @mkdir($dest,$options['folderPermission']); 
                chmod($dest,$options['filePermission']); 
            } else { 
                //Copy parent directory with new name and all its content 
                @mkdir($dest,$options['folderPermission']); 
                chmod($dest,$options['filePermission']); 
            } 
        } 

        $dirHandle=opendir($source); 
        while($file=readdir($dirHandle)) 
        { 
            if($file!="." && $file!="..") 
            { 
                 if(!is_dir($source."/".$file)) { 
                    $__dest=$dest."/".$file; 
                } else { 
                    $__dest=$dest."/".$file; 
                } 
                //echo "$source/$file ||| $__dest<br />"; 
                $result=smartCopy($source."/".$file, $__dest, $options); 
            } 
        } 
        closedir($dirHandle); 
        
    } else { 
        $result=false; 
    } 
    return $result; 
}

// end of file
