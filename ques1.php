<?php

// To check member type can use session to trace member memberships.
// To identify non member downloads we can trace their ip address so that there is no excessive download from the same user.

function checkDownload($memberType) {
    $downloadWindow = 5; 

    $currentTime = microtime(true); 

    // Simulate member download history (replace with actual storage mechanism)
    static $lastDownloadTimes = array(
        "member" => null,
        "nonmember" => null,
    );

    static $downloadCountByIP = array();

    $ip = $_SERVER['REMOTE_ADDR'];

    $lastDownloadTime = $lastDownloadTimes[$memberType];
    if ($lastDownloadTime !== null && ($currentTime - $lastDownloadTime) < $downloadWindow) {
        return "Too many downloads";
    }

    // Update download history for the member type
    $lastDownloadTimes[$memberType] = $currentTime;

    // Allow download based on member type
    if ($memberType === "member") {
        return ($lastDownloadTimes["member"] - $currentTime) < (2 * $downloadWindow) ? "Your download is starting..." : "Too many downloads";
    } else {
        // Non-members can download only once within the window
        // Check download count per IP address
        if (!isset($downloadCountByIP[$ip])) {
            $downloadCountByIP[$ip] = 1;
        } else {
            $downloadCountByIP[$ip]++;
        }

        if ($downloadCountByIP[$ip] <= 2) {
            return "Your download is starting...";
        } else {
            return "You have reached the maximum number of downloads.";
        }
    }
}

echo checkDownload("nonmember");
echo checkDownload("nonmember");
echo checkDownload("nonmember"); 

echo checkDownload("member"); 
echo checkDownload("member"); 
echo checkDownload("member"); 
