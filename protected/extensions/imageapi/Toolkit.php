<?php
abstract class Toolkit extends CComponent {

    /** Extracts info from an image file */
    public function getInfo($file) {
        if (!is_file($file)) {
            return FALSE;
        }

        $details = FALSE;
        $data = @getimagesize($file);
        $file_size = @filesize($file);

        if (isset($data) && is_array($data)) {
            $extensions = array('1' => 'gif', '2' => 'jpg', '3' => 'png');
            $extension = array_key_exists($data[2], $extensions) ?  $extensions[$data[2]] : '';
            $details = array(
                'width'     => $data[0],
                'height'    => $data[1],
                'extension' => $extension,
                'file_size' => $file_size,
                'mime_type' => $data['mime']
            );
        }

        return $details;
    }

    /**
     * Metadata of the toolkit
     */
    abstract public function toolkit_info();
    /**
     * Checks if the toolkit is operative with the actual configuration
     * @return boolean whether the toolkit is operative
     */
    abstract public function toolkit_check();

    /**
     * Create an image resource from a file.
     *
     * @param $file
     *   A string file path where the image should be saved.
     * @param $extension
     *   A string containing one of the following extensions: gif, jpg, jpeg, png.
     * @return
     *   An image resource, or FALSE on error.
     */
    abstract public function open($file, $extension);
    /**
     * Write an image resource to a destination file.
     *
     * @param $res
     *   An image resource created with image_gd_open().
     * @param $destination
     *   A string file path where the iamge should be saved.
     * @param $extension
     *   A string containing one of the following extensions: gif, jpg, jpeg, png.
     * @return
     *   Boolean indicating success.
     */
    abstract public function close($res, $destination, $extension);

    /**
     * Scales an image to the given width and height while maintaining aspect
     * ratio.
     */
    abstract public function resize($source, $destination, $width, $height);
    /**
     * Rotate an image the given number of degrees.
     */
    abstract public function rotate($source, $destination, $degrees, $background = 0x000000);
    /**
     * Crop an image using the GD toolkit.
     */
    abstract public function crop($source, $destination, $x, $y, $width, $height);

    /**
     *
     */
    abstract function watermark($source, $destination, $pngWatermark, $x=0, $y=0);
}