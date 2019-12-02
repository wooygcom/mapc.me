<?php
namespace Mapc\Common;

/**
 * @exam
 *     $fileObj = new Files(['uploadDir' => DATA_PATH, 'group' => 'group1']);
 *     $fileObj->file($_FILES['uploadfiles']); // input name="uploadfiles[]"
 *     $fileObj->uploads(); // 하나만 올릴 경우 $fileObj->upload();
 * 썸네일을 만들경우 클래스 호출하기 전에 아래 문장을 더 넣을 것~
 *     include_once(LIBRARY_PATH . 'image_thumbnail.php');
 */
class Files {

    public $uploadDir;
    public $files; // $_FILES['filename'][] : 여러개 파일을 올릴 때 쓰는 변수
    public $file;  // $_FILES['filename'] : 하나의 파일만 올릴 때 쓰는 변수
    public $fileCount;
    public $fileUrls = [];
    public $group; // 파일 업로드 디렉토리 구분용 (예. file.jpg&group=a -> a/file.jpg)

    public function __construct($args = []) {

        $this->group     = $args['group'];
        $temp = ($this->group) ? $this->group . DIRECTORY_SEPARATOR : '';
        $this->uploadDir = $args['uploadDir'] . DIRECTORY_SEPARATOR . $temp;

    }

    public function file($files) {

        $this->files     = $files;
        $this->fileCount = count($files['name']);

    }

    public function check($args) {
        // #TODO 파일검사
    }

    public function uploads($files) {

        $this->files = $files;
        $this->fileCount = count($files['name']);

        $this->files = $files;

        foreach($this->files['name'] as $key => $var) {

            $args = [
                'name'     => $this->files['name'][$key],
                'tmp_name' => $this->files['tmp_name'][$key],
                'type'     => $this->files['type'][$key],
                'size'     => $this->files['size'][$key]
                ];

            $check  = $this->check($args);
            $result = $this->upload($args);

        }

        return $result;

    }

    public function upload($file) {

        $return = [];
        $filename = $file['name'];

        $temp     = explode(".", $filename);
        $ext      = end($temp);
        $uniqid   = uniqid();
        $server_filename = date('Ymd-His') . '-' . $uniqid . '.' . $ext;
        $server_filename_thumb = date('Ymd-His') . '-' . $uniqid . '.thumb.' . $ext;

        $uploads_dir_real = $this->uploadDir . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR;
        // #TODO allowed_ext는 별도의 환경설정으로 만들것!!!!!!!!!!!
        $allowed_ext = array('jpg','jpeg','png','gif');

        if(! is_dir($uploads_dir_real)) {
            mkdir($uploads_dir_real, 0755, true);
        }

        if(move_uploaded_file($file['tmp_name'], $uploads_dir_real . DIRECTORY_SEPARATOR . $server_filename)) {

            // 파일 정보 출력
            $this->fileUrls[] = ROOT_URL . 'common/files/' . $server_filename . '?group=' . $this->group;
            if(function_exists('imageThumbnail')) {
                imageThumbnail (
                    $uploads_dir_real . $server_filename,
                    $uploads_dir_real . $server_filename_thumb
                );
            }
            $return = [
                'result' => true,
                'uploadedFilename' => $server_filename
            ];

        } else {

            $return['result'] = false;

        }

        return $return;

    }

}

// this is it
