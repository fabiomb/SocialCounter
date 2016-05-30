<?php
// Social Counter 1.0
// https://github.com/fabiomb/SocialCounter
// Copyleft 2016 Fabio Baccaglioni

require("config.php");

// Youtube
$url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$channel_id."&key=".$key_google;
echo "URL:".$url."<br /><br />";
$youtube = get_CURL ($url);

if ($youtube <> "")
{
    $youtube = json_decode($youtube);
    $shareyoutube = $youtube->items[0]->statistics->subscriberCount;
    $viewCount = $youtube->items[0]->statistics->viewCount;
    $videoCount  = $youtube->items[0]->statistics->videoCount;
    echo "subscriberCount: ". $shareyoutube."<br /><br />";
    echo "viewCount: ". $viewCount."<br /><br />";
    echo "videoCount: ". $videoCount."<br /><br />";
}

// Facebook
$url = "https://api.facebook.com/method/links.getStats?urls=".$fanpage."&format=json";
echo "URL:".$url."<br /><br />";
$facebook = get_CURL ($url);

if ($facebook <> "")
{
    $facebook = json_decode($facebook);
    $sharefacebook = $facebook[0]->like_count;
    echo "Fans: ". $sharefacebook."<br /><br />";
}

// Twitter
$url = "https://cdn.syndication.twimg.com/widgets/followbutton/info.json?lang=en&screen_names=".$twitteruser;
echo "URL:".$url."<br /><br />";
$twitter = get_CURL ($url);

if ($twitter <> "")
{
    $twitter = json_decode($twitter);
    $sharetwitter = $twitter[0]->followers_count;
    $formatted_followers_count = $twitter[0]->formatted_followers_count;
    $name = $twitter[0]->name;
    echo "Followers: ". $sharetwitter."<br /><br />";
    echo "Formatted: ". $formatted_followers_count."<br /><br />";
    echo "Full Name: ". $name."<br /><br />";
}



// Instagram
$url = "https://www.instagram.com/".$instagramuser."/?__a=1";
echo "URL:".$url."<br /><br />";
$instagram = get_CURL ($url);

if ($instagram <> "")
{
    $instagram = json_decode($instagram);

    $shareinstagram = $instagram->user->followed_by->count;
    $follows = $instagram->user->follows->count;
    $profile_pic_url = $instagram->user->profile_pic_url;
    $full_name = $instagram->user->full_name;
    $counter = $instagram->user->media->count;
    echo "Followers IG: ". $shareinstagram."<br /><br />";
    echo "Follows IG: ". $follows."<br /><br />";
    echo "Pic: ". $profile_pic_url."<br /><br />";
    echo "Full name: ". $full_name."<br /><br />";
    echo "Pictures: ". $counter."<br /><br />";

}


function get_CURL ($url)
{
    $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';

    $ch = curl_init();

    $curl_opt = array(
        CURLOPT_FOLLOWLOCATION  => 1,
        CURLOPT_HEADER      => 0,
        CURLOPT_RETURNTRANSFER  => 1,
        CURLOPT_USERAGENT   => $curlopt_useragent,
        CURLOPT_URL       => $url,
        CURLOPT_TIMEOUT         => 3,
        CURLOPT_CONNECTTIMEOUT  => 2,
        CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
    );

    
    curl_setopt_array($ch, $curl_opt);

    $content = curl_exec($ch);

        if($content === false)
    {
        echo 'Curl error: ' . curl_error($ch);
    }

    if (!is_null($curl_info)) {
        $curl_info = curl_getinfo($ch);
        echo $curl_info;
    }

    curl_close($ch);
    return $content;
}
    
