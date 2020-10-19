<?php

interface FilesInterface {
    public function createUploadFiles();
    public function displayLinks();
}

interface FileInterface {
    public function save();
    public function upload();
    public function download();
}