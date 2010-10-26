<?php

class GDToolkit extends Toolkit {
    public static $qualityJPEG = 75;

    /**
     * Retrieve information about the toolkit.
     */
    public function toolkit_info() {
        return array('name' => 'gd', 'title' => t('GD2 image manipulation toolkit'));
    }

    /**
     * Verify GD2 settings (that the right version is actually installed).
     *
     * @return
     *   A boolean indicating if the GD toolkit is avaiable on this machine.
     */
    public function toolkit_check() {
        if ($check = get_extension_funcs('gd')) {
            if (in_array('imagegd2', $check)) {
                // GD2 support is available.
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * GD helper function to create an image resource from a file.
     *
     * @param $file
     *   A string file path where the iamge should be saved.
     * @param $extension
     *   A string containing one of the following extensions: gif, jpg, jpeg, png.
     * @return
     *   An image resource, or FALSE on error.
     */
    public function open($file, $extension) {
        $extension = str_replace('jpg', 'jpeg', $extension);
        $open_func = 'imageCreateFrom'. $extension;
        if (!function_exists($open_func)) {
            return FALSE;
        }
        return $open_func($file);
    }

    /**
     * GD helper to write an image resource to a destination file.
     *
     * @param $res
     *   An image resource created with open().
     * @param $destination
     *   A string file path where the iamge should be saved.
     * @param $extension
     *   A string containing one of the following extensions: gif, jpg, jpeg, png.
     * @return
     *   Boolean indicating success.
     */
    public function close($res, $destination, $extension) {
        $extension = str_replace('jpg', 'jpeg', $extension);
        $close_func = 'image'. $extension;
        if (!function_exists($close_func)) {
            return FALSE;
        }
        if ($extension == 'jpeg') {
            return $close_func($res, $destination, self::$qualityJPEG);
        }
        else {
            return $close_func($res, $destination);
        }
    }


    /**
     * Scale an image to the specified size using GD.
     */
    public function resize($source, $destination, $width, $height) {
        if (!file_exists($source)) {
            return FALSE;
        }

        $info = $this->getInfo($source);
        if (!$info) {
            return FALSE;
        }

        $im = $this->open($source, $info['extension']);
        if (!$im) {
            return FALSE;
        }

        $res = imagecreatetruecolor($width, $height);
        if ($info['extension'] == 'png') {
            $transparency = imagecolorallocatealpha($res, 0, 0, 0, 127);
            imagealphablending($res, FALSE);
            imagefilledrectangle($res, 0, 0, $width, $height, $transparency);
            imagealphablending($res, TRUE);
            imagesavealpha($res, TRUE);
        }
        elseif ($info['extension'] == 'gif') {
            // If we have a specific transparent color.
            $transparency_index = imagecolortransparent($im);
            if ($transparency_index >= 0) {
                // Get the original image's transparent color's RGB values.
                $transparent_color = imagecolorsforindex($im, $transparency_index);
                // Allocate the same color in the new image resource.
                $transparency_index = imagecolorallocate($res, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                // Completely fill the background of the new image with allocated color.
                imagefill($res, 0, 0, $transparency_index);
                // Set the background color for new image to transparent.
                imagecolortransparent($res, $transparency_index);
                // Find number of colors in the images palette.
                $number_colors = imagecolorstotal($im);
                // Convert from true color to palette to fix transparency issues.
                imagetruecolortopalette($res, TRUE, $number_colors);
            }
        }
        imagecopyresampled($res, $im, 0, 0, 0, 0, $width, $height, $info['width'], $info['height']);
        $result = $this->close($res, $destination, $info['extension']);

        imagedestroy($res);
        imagedestroy($im);

        return $result;
    }

    /**
     * Rotate an image the given number of degrees.
     */
    public function rotate($source, $destination, $degrees, $background = 0x000000) {
        if (!function_exists('imageRotate')) {
            return FALSE;
        }

        $info = $this->getInfo($source);
        if (!$info) {
            return FALSE;
        }

        $im = $this->open($source, $info['extension']);
        if (!$im) {
            return FALSE;
        }

        $res = imageRotate($im, $degrees, $background);
        $result = $this->close($res, $destination, $info['extension']);

        return $result;
    }

    /**
     * Crop an image using the GD toolkit.
     */
    public function crop($source, $destination, $x, $y, $width, $height) {
        $info = $this->getInfo($source);
        if (!$info) {
            return FALSE;
        }

        $im = $this->open($source, $info['extension']);
        $res = imageCreateTrueColor($width, $height);
        imageCopy($res, $im, 0, 0, $x, $y, $width, $height);
        $result = $this->close($res, $destination, $info['extension']);

        imageDestroy($res);
        imageDestroy($im);

        return $result;
    }

    /**
     * Water marks a file
     */
    function watermark($source, $destination, $pngWatermark, $x=0, $y=0) {
        $sourceInfo = $this->getInfo($source);
        $sourceImage = $this->open($source, $sourceInfo['extension']);
        $waterInfo = $this->getInfo($pngWatermark);
        $waterImage = $this->open($pngWatermark, $waterInfo['extension']);

        $target = imageCreateTrueColor($sourceInfo['width'], $sourceInfo['height']);
        imageCopy($target, $sourceImage, 0, 0, 0, 0, $sourceInfo['width'], $sourceInfo['height']);
        imageAlphaBlending($target, true);
        
        imageCopy($target, $waterImage, $x, $y, 0, 0, $waterInfo['width'], $waterInfo['height']);
        imageAlphaBlending($target, true);
        $result = $this->close($target, $destination, $sourceInfo['extension']);

        imageDestroy($target);
        imageDestroy($sourceImage);
        imageDestroy($waterImage);

        return $result;
    }
}