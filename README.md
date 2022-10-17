# videocms
This is a one page video CMS built in PHP that will allow the displaying of videos and descriptions in a masonry layout. The script includes search functionality and code to create thumbnails via FFMPEG. For best results, your video files should be descriptively named as the searchable video description is based on the name of the video file. It works really well with videos ripped from YouTube via a video downloader app.

This commit includes all the relevant css and js files and the proper structure of the directories for the addition of video files.

Add your video files to /assets/video

run the ffmpeg.php file to locate your video files and create thumbnails. 

this system wants you to run the ffmpeg commands three times to populate three folders of thumbnails for randomizing the viewing experience.

I have tested this system with over 400 videos and it works flawlessly.
