<?php

interface FilesInterface {
    public function createUploadFiles();
    public function showFiles();
}

interface FileInterface {
    public function save();
    public function upload();
    public function download();
}