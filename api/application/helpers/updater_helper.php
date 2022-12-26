<?php
/**
 * Created by PhpStorm.
 * User: danadrianlutescu
 * Date: 30/01/2019
 * Time: 13:15
 */
class FileInfo{
    public $LocalPath = '';
    public $Name      = '';
    public $IsFile    = true;
    public $IsFolder  = false;
    public $Content   = '';

    public function __construct($full_path='')
    {
        if( $full_path != '' ) {
            $this->LocalPath = $full_path;
            $this->Name = basename($full_path);

            $this->IsFile = is_file($full_path);
            $this->IsFolder = !$this->IsFile;

            if ($this->IsFile) {
                $this->Content = urlencode( file_get_contents($full_path) );
            }
        }
    }

    public static function create_from_json($json)
    {
        $f = new FileInfo();
        $f->LocalPath   = $json->LocalPath;
        $f->Name        = $json->Name;
        $f->IsFile      = $json->IsFile;
        $f->IsFolder    = $json->IsFolder;
        $f->Content     = $json->Content;
        return $f;
    }

    public function write_local()
    {
        if($this->IsFile) {
            if(!empty($this->Content) )
            {
                file_put_contents($this->LocalPath, urldecode($this->Content) );
            }
        }
        if($this->IsFolder)
        {
            if(!is_dir($this->LocalPath)) mkdir( $this->LocalPath, 0777, true );
        }
    }
}