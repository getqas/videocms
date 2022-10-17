<?php

//ffmpeg script run once to obtain thumbnails, this system relies on randomly showing one of three thumbnails to users. 

//for best results to use the search functionality, your video files should be descriptive and clean text no special characters

$arrFiles = array();
$arrFiles = glob('assets/video/*.mp4');//main folder
$newFiles = glob('assets/video/new/*.mp4'); // new folder

//create thumbnails for videos in new folder
foreach ($newFiles as $file) {


    $fileName = str_replace('.mp4', '', $file);

    $fileName = str_replace('assets/video/new/', '', $fileName);
    $thumbnail = "path-to/assets/thumbs/1/$fileName.jpg"; //change to 2 or 3 for more thumbnails 
    $video = "path-to/assets/video/new/$file";

        
    shell_exec("ffmpeg -ss 00:02:25.000 -i $video -vframes 1 $thumbnail");
    //shell_exec("ffmpeg -ss 00:03:33.000 -i $video -vframes 1 $thumbnail"); // used for 2
    //shell_exec("ffmpeg -ss 00:04:32.000 -i $video -vframes 1 $thumbnail"); //used for 3

}

//create thumbnails for videos in regular folder
foreach ($arrFiles as $file) {


    $fileName = str_replace('.mp4', '', $file);

    $fileName = str_replace('assets/video/', '', $fileName);
    $thumbnail = "path-to/assets/thumbs/1/$fileName.jpg"; //change to 2 or 3 for more thumbnails 
    $video = "path-to/assets/video/$file";

        
    shell_exec("ffmpeg -ss 00:02:25.000 -i $video -vframes 1 $thumbnail");
    //shell_exec("ffmpeg -ss 00:03:33.000 -i $video -vframes 1 $thumbnail"); // used for 2
    //shell_exec("ffmpeg -ss 00:04:32.000 -i $video -vframes 1 $thumbnail"); //used for 3

}