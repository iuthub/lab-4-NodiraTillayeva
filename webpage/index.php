
<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>
<div id="listarea">
    <?php
    if(isset($_REQUEST["playlist"]))
    {
        $playlist = $_REQUEST["playlist"];
        $songtitles = file("songs/$playlist");
        foreach ($songtitles as $songtitle)
        {
            $givensongs = array();
            array_push($givensongs, "songs/$songtitle");
            foreach ($givensongs as $givensong){
                ?>
                <ul id="musiclist">
                    <li class="mp3item">
                        <a href="<?= $givensong ?>"><?= $songtitle ?></a>
                    </li>
                </ul>
            <?php }}}
    else{
        $giventracks = glob("songs/*.mp3");
        foreach ($giventracks as $giventrack)
        { $tracktitle = basename($giventrack);
            ?>
            <ul id="musiclist">
                <li class="mp3item">
                    <a href="<?= $giventrack ?>"><?= $tracktitle ?></a>
                    <?php
                    if(filesize($giventrack) <= 1023 )
                        echo "(" . filesize($giventrack) . " b)";
                    else if (filesize($giventrack) >= 1023 && filesize($giventrack) <= 1048575)
                        echo "(" . round(filesize($giventrack)/1024, 2) . " kb)";
                    else
                        echo "(" . round(filesize($giventrack)/(1024*1024), 2) . " mb)"; ?>
                </li>
            </ul>
        <?php } ?>
        <?php
        $playlists = glob("songs/*.txt");
        foreach ($playlists as $playlist)
        { $playlisttitle = basename($playlist);
            ?>
            <ul id="musiclist">
                <li class="playlistitem">
                    <a href="<?= $playlist ?>"><?= $playlisttitle ?></a>
                </li>
            </ul>
        <?php } } ?>
</div>
</body>
</html>