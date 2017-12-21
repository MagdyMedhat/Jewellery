<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mylib
{

    var $CI;

    function Mylib()
    {
        $this->CI = &get_instance();
    }

    function sqlGetMultipleRows($sql)
    {
        $query = $this->CI->db->query($sql);
        $result;

        if($query->num_rows() > 0)
            $result = $query->result_array();
        else
            $result = FALSE;

        return $result;
    }

    function sqlGetSingleRow($sql)
    {
        $query = $this->CI->db->query($sql);
        $result;

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = FALSE;

        return $result;
    }
    
    function get_current_date()
    {
        //date_default_timezone_set("Africa/Cairo");
        //http://www.php.net/manual/en/timezones.php
        return date('Y-m-d');
    }
    function get_current_time()
    {
        return date('H:i:s');
    }
    
    function setTimeFormat($time)
    {
        return date('h:i A', strtotime($time));
    }

    function setDateFormat($date)
    {
        return date("d M, Y", strtotime($date));
    }

    function validateMail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;

        return false;
    }

    public function upload($path, $field)
    {
        if($_FILES[$field]['name'] != '')
        {
            $ext = pathinfo($_FILES [$field]['name'], PATHINFO_EXTENSION);
            $filename = time() . '.' . strtolower($ext);
            if(move_uploaded_file($_FILES[$field]['tmp_name'], realpath($path) . '/' . $filename))
                return $filename;
            return FALSE;
        }
        return FALSE;
    }

    function sendMail($recipients_arr, $title, $body, $from)
    {
        $recipients = implode(",", $recipients_arr);
        $content_type = "Content-Type: text/html; charset=ISO-8859-1";
        $headers = sprintf("From: %s \r\n%s \r\n", $from, $content_type);
        return mail($recipients, $title, $body, $headers);
    }

    function resizeImage($filename, $width, $height)
    {
        list($image["Width"], $image["Height"], $image["Type"]) = getimagesize($filename);
        if($image["Type"] == IMG_JPG || $image["Type"] == IMG_JPEG)
        {
            //load orginal image
            $im_image = ImageCreateFromJPEG($filename);
        }
        if($image["Type"] == IMG_GIF)
        {
            $im_image = ImageCreateFromGIF($filename);
        }
        if($image["Type"] == IMG_PNG)
        {
            $im_image = ImageCreateFromPNG($filename);
        }
        //determine new size of thumbnail
        if($image["Width"] > $image["Height"])
        {
            $scale = $width / $image["Width"];
            $thumb_width = $width;
            $thumb_height = floor($image["Height"] * $scale);
            $thumb_height = $height; //added to force given size
        }
        else
        {
            $scale = $height / $image["Height"];
            $thumb_height = $height;
            $thumb_width = floor($image["Width"] * $scale);
            $thumb_width = $width; //added to force given size
        }
        //create thumbnail
        $im_thumb = @ImageCreateTrueColor($thumb_width, $thumb_height) or die("Cannot Initialize new GD image stream");
        ImageCopyResampled($im_thumb, $im_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $image["Width"], $image["Height"]);
        ImageDestroy($im_image);
        ImagePNG($im_thumb, $filename);
        ImageDestroy($im_thumb);
        return true;
    }

    function getCitiesAt($lat, $long)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false";
        $json = file_get_contents($url);
        $info = json_decode($json, true); // associative array
        $cities = array();
        foreach($info['results'] as $element)
        {
            foreach($element['address_components'] as $component)
            {
                if($component['types'][0] == 'administrative_area_level_1')
                {
                    if(empty($cities) ||
                            !array_search($component['long_name'], $cities) && $cities[0] != $component['long_name']
                    )
                        array_push($cities, $component['long_name']);
                }
            }
        }
        return $cities;
    }

    function calcDistanceStraightLine($lat1, $lon1, $lat2, $lon2)
    {
        $delta_lat = $lat2 - $lat1;
        $delta_lon = $lon2 - $lon1;
        $earth_radius = 6373.00;
        $distance = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($delta_lon));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        $distance = round($distance, 4);

        return $distance * 1.609344;
    }
    
    function popUpMsg($msg)
    {
        echo "<script> alert('" . $msg . "'); </script>";
    }
    
    function securityFilter($str)
    {
        //tip1: always use SHA1 to encrypt passwords to 40 characters
        //tip2: load the 'encrypt' library, give it a new key, use encode/decode whenever possible
        //tip3: use a new encryption key when using sessions.
        //tip4: set PHP ERROR reporting level to 0 at the config file.
        //tip5: dont allow url special characters, from the regex at the config file.
        //tip6: always make both javascript and php validation to only allow specific characters.
	//tip7: use _privateFunction() whenever possible        
        
        $str = $this->CI->security->xss_clean($str);
        $str = mysql_escape_string($str);
        //$str = $this->CI->db->escape($str);
        ////strip_tags($str);
        //$str = htmlspecialchars($str, ENT_QUOTES);
        //htmlspecialchars_decode($str)
        
        return $str;
    }
    
    /**
     * Helperfunc::GetCountryName()
     * 
     * @param mixed $ip ip of Device
     * @return Standard Country Name
     */
    function GetCountryName($ip)
    {
        $uri = 'http://ip2.cc/?api=cc&ip=' . urlencode($ip);
        $stdname = file_get_contents($uri);
        return $stdname;
    }

    /**
     * Helperfunc::CutForTweet()
     * 
     * @param mixed $str to Cut
     * @param integer $length Approximate Length to cut
     * @return string Cut
     */
    function CutForTweet($str, $length=90)
    {
        if(strlen($str) <= $length)
        {
            return $str . '...';
        }
        else
        {
            do
            {
                $t = substr($str, 0, $length);
                //echo $t .'</br>';
                $length--;
                if($length < 0)
                    break;
            }
            while($t[strlen($t) - 1] != ' ');
        }
        return $t . '...';
    }

    /**
     * Helperfunc::MultipleUpload()
     * 
     * @param mixed $path Path To Upload File
     * @param mixed $field Input Field Name To Upload From
     * @return array Name of Uploaded Files
     */
    public function MultipleUpload($path, $field)
    {
        $images = $_FILES[$field]['name'];
        $files = $_FILES[$field] ['tmp_name'];
        $filenames = array();

        foreach($files as $key => $value)
        {
            if($images[$key] != '')
            {
                $ext = pathinfo($images[$key], PATHINFO_EXTENSION);
                $folder = realpath($path);
                $filename = time() . rand(0, 1000) . '.' . $ext;
                $des = $folder . '/' . $filename;
                if(move_uploaded_file($value, $des))
                    $filenames[] = $filename;
            }
        }
        return $filenames;
    }

    /**
     * GetYoutubeVideo()
     * 
     * @param mixed $url Any Youtube url 
     * @param string $width Width of Embeded Video
     * @param string $height Height of Embeded Video
     * @param integer $rel Show Related Videos after End of Video
     * @return Associative array of id , embed , large_img , small_img
     */
    /**
     * Helperfunc::GetYoutubeVideo()
     * 
     * @param mixed $url
     * @param string $width
     * @param string $height
     * @param integer $rel
     * @return
     */
    function GetYoutubeVideo($url, $width='560', $height='345', $rel=0)
    {

        $urls = parse_url($url);

        $youtube = array();

        //expect url is http://youtu.be/id
        if($urls['host'] == 'youtu.be')
        {
            $id = ltrim($urls['path'], '/');
        }
        //expect  url is http://www.youtube.com/embed/id 
        else if(strpos($urls['path'], 'embed') == 1)
        {
            $id = end(explode('/', $urls['path']));
        }
        //expect url is id only 
        else if(strpos($url, '/') === false)
        {
            $id = $url;
        }
        //expect url is http://www.youtube.com/watch?v=id 
        else
        {
            parse_str($urls['query']);
            $id = $v;
        }


        $youtube['vid'] = $id;

        $youtube['embed'] = '<iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?rel=' . $rel . '" frameborder="0" allowfullscreen></iframe>';

        $youtube['small_img'] = 'http://img.youtube.com/vi/' . $id . '/default.jpg';

        $youtube['large_img'] = 'http://img.youtube.com/vi/' . $id . '/hqdefault.jpg';

        return $youtube;
    }
}

?>