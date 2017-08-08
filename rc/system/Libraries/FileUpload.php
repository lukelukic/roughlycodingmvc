<?php

/*
    Biblioteka za upload fajla.

    Od podesivih parametara ima :
    fileTypes - niz podrzanih tipova fajla
    uploadDirectory - direktorijum za upload fajla
    maxSize - maksimalna velicina fajla
    fileToUpload - fajl koji treba uploadovati ($_FILE['name'])

    Javni metodi :
    upload() - izvrsavanje upload-a, vraca true | false, ako vrati false, u uploadErrors se upisuje greska
    getErrorMessages() - vraca niz gresaka nastalih pri uploadu

*/

namespace rc\system\Libraries;

class FileUpload
{
    public $fileTypes;
    public $uploadDirectory;
    public $maxSize = 2000000;
    public $fileToUpload;
    private $uploadErrors = array();

    public function upload()
    {
        $fullpath = $this->uploadDirectory . "/" . basename($this->fileToUpload['name']);
        if (file_exists($fullpath)) {
            array_push($this->uploadErrors, "Sorry, file already exists.");
        } elseif ($this->fileToUpload['size']>$this->maxSize) {
            array_push($this->uploadErrors, "Sorry, file is too large.");
        } elseif (!$this->checkFileType()) {
            array_push($this->uploadErrors, "Sorry, file format is invalid.");
        } elseif (move_uploaded_file($this->fileToUpload['tmp_name'], $fullpath)) {
            return true;
        }

        return false;
    }

    public function getErrorMessages()
    {
        return $this->uploadErrors;
    }

    private function checkFileType()
    {
        if ($this->fileTypes)
        {
            foreach ($this->fileTypes as $ft)
            {
                if (mime_content_type($this->fileToUpload['tmp_name']) == $ft)
                return true;
            }
        } else {
            array_push($this->uploadErrors,"Please define file type.");
            return false;
        }
        return false;
    }
}
