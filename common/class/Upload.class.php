<?php

namespace Cms\common;
class Upload
{
    public $allow_type;
    public $upload_dir;
    public $upload_dir_;
    public $result;
    public $error;

    public function __construct()
    {
        global $G;
        $this->allow_type = $G['config']['app']['allow_upload_type'];
        $this->upload_dir = rtrim(WEBROOT, DIRECTORY_SEPARATOR) . DATA_FILE;

        if (is_dir($this->upload_dir)) {
            $this->upload_dir_ = date('Ym') . DIRECTORY_SEPARATOR;
            $this->upload_dir .= $this->upload_dir_;
            if (!is_dir($this->upload_dir)) {
                if (!mkdir($this->upload_dir)) {
                    $this->error = 'mkdir ' . $this->upload_dir . 'error';
                }
            }
        } else {
            $this->error = 'file dir not exist';
        }
    }

    public function upfiles()
    {
        if (count($_FILES) < 1) {
            $this->error = 'file is unset';
        }

        foreach ($_FILES as $key => $file) {
            if ($file['size'] > 0 && $file['error'] == 0) {
                $filepath = $this->upfile($file);
                if (is_file($this->upload_dir . str_replace($this->upload_dir_, '', $filepath))) {
                    $this->result[$key] = array(
                        'file_id' => 1,
                        'name' => $file['name'],
                        'path' => $filepath,
                        'type' => $this->get_extension($file['name'])
                    );
                }
            } else {
                $this->error = 'file is empty or upload to system error';
            }
        }
        $this->getFileid();
        return $this->result;
    }

    public function upfile($file)
    {
        $extension = $this->get_extension($file['name']);
        if (!in_array($extension, $this->allow_type)) {
            $extension = 'attach';
        }
        $file_hash = sha1_file($file['tmp_name']);
        if (move_uploaded_file($file['tmp_name'], $this->upload_dir . $file_hash . '.' . $extension)) {
            return $this->upload_dir_ . $file_hash . '.' . $extension;
        } else {
            $this->error = 'move file to upload error';
        }
    }

    public function get_extension($file)
    {
        return strtolower(end(explode('.', $file)));
    }

    public function getFileid()
    {
        foreach ((array)$this->result as $key => $file) {
            T('files')->add(
                array(
                    'name' => addslashes($file['name']),
                    'path' => $file['path'],
                    'type' => $file['type']
                ));
            $this->result[$key]['file_id'] = T('files')->getLastId();
        }
    }

    public function download($fileurl)
    {
        $filename = $this->getFileName($fileurl);
        $extention = $this->get_extension($filename);
        $extention_ = $extention;
        if (!in_array($extention, $this->allow_type)) {
            $extention = 'attach';
        }
        $file_content = get($fileurl);
        $save_filename = sha1($file_content) . '.' . $extention;


        if ($file_content) {
            if (file_put_contents($this->upload_dir . $save_filename, $file_content)) {
                $this->result[0] = array(
                    'file_id' => 1,
                    'name' => $filename,
                    'path' => $this->upload_dir_ . $save_filename,
                    'type' => $extention_
                );
            } else {
                $this->error = 'can\'t creat file ' . $this->upload_dir . $save_filename;
            }
        } else {
            $this->error = 'cant connect to remote host' . $fileurl;
            return 0;
        }
        $this->getFileid();
        return $this->result;
    }

    public function getFileName($filename)
    {
        return end(explode('/', $filename));
    }
}

?>