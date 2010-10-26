<?php
class CImage extends CApplicationComponent {
    public $toolkit;
    public $presets=array();

    public function init() {
        parent::init();

        Yii::import('ext.imageapi.Toolkit');
        Yii::import('ext.imageapi.GDToolkit');
        $this->toolkit = new GDToolkit;
    }

    public function getInfo($file) {
        return $this->toolkit->getInfo($file);
    }


    /**
     * Basic function for create a derived image from a file using a preset declared in
     * configuration
     * @param $presetName Name of the preset declared in configuration under presets array
     * in the way:
     * <pre>
     *    '640x480'=>array(
     *      'cacheIn'=>'webroot.repository.640x480',
     *      'actions'=>array( 'scaleAndCrop'=>array('width'=>640, 'height'=>480) ),
     *    ),
     * </pre>
     * @param $file origin image file to create the derived image
     * @return the path to the cached derived image (if it does not exist it'll be generated
     *   transparently)
     */
    public function createPath($presetName, $file) {
        if (!file_exists($file)) return false;

        $preset = $this->presets[$presetName];
        if (isset($preset)) {
            $basename = basename($file);
            $targetPath = Yii::getPathOfAlias($preset['cacheIn']);
            $targetFile = $targetPath .'/'. $basename;
            if (!file_exists($targetPath)) mkdir($targetPath, 0777, true); // mkdir recursive

            if (file_exists($targetFile)) {
                return $targetFile;
            } else {
                copy($file, $targetFile);
                foreach($preset['actions'] as $action=>$params) {
                    switch($action) {
                        case 'scaleAndCrop':
                            $this->scaleAndCrop($targetFile, $targetFile, $params['width'], $params['height']);
                            break;
                        case 'scale':
                            $this->scale($targetFile, $targetFile, $params['width'], $params['height']);
                            break;
                        case 'resize':
                            $this->resize($targetFile, $targetFile, $params['width'], $params['height']);
                            break;
                        case 'rotate':
                            $this->rotate($targetFile, $targetFile, $params['degrees'], $params['background']);
                            break;
                        case 'crop':
                            $this->crop($targetFile, $targetFile, $params['x'], $params['y'], $params['width'], $params['height']);
                            break;
                        case 'watermark':
                            $this->waterMark($targetFile, $targetFile, 
                                    Yii::getPathOfAlias('webroot').$params['pngWatermark'],
                                    isset($params['x'])? $params['x']: 0,
                                    isset($params['y'])? $params['y']: 0);
                            break;
                    }
                }
                return $targetFile;
            }
        } else {
            return false;
        }
    }
    /**
     * Basic function for create a derived image from a file using a preset declared in
     * configuration
     * @param $presetName Name of the preset declared in configuration under presets array
     * in the way:
     * <pre>
     *    '640x480'=>array(
     *      'cacheIn'=>'webroot.repository.640x480',
     *      'actions'=>array( 'scaleAndCrop'=>array('width'=>640, 'height'=>480) ),
     *    ),
     * </pre>
     * @param $file origin image file to create the derived image
     * @return the URL to the cached derived image (if it does not exist it'll be generated
     *   transparently)
     */
    public function createUrl($presetName, $file) {
        if (!file_exists($file)) return false;

        $preset = $this->presets[$presetName];
        if (isset($preset)) {
            $targetPath = Yii::getPathOfAlias($preset['cacheIn']);
            $generatedPath = $this->createPath($presetName, $file);

            $webrootPath = Yii::getPathOfAlias('webroot');
            if(strpos($generatedPath, $webrootPath) !== FALSE) {
                $generatedPath = substr($generatedPath, strlen($webrootPath));
            }
            $generatedUrl = str_replace('\\', '/', Yii::app()->urlManager->getBaseUrl().$generatedPath);
            return $generatedUrl;
        } else {
            return false;
        }
    }

    /** Scales and crops an image to the desired size */
    public function scaleAndCrop($source, $destination, $width, $height) {
        $info = self::getInfo($source);

        $scale = max($width / $info['width'], $height / $info['height']);
        $x = round(($info['width'] * $scale - $width) / 2);
        $y = round(($info['height'] * $scale - $height) / 2);

        if ($this->toolkit->resize($source, $destination, $info['width'] * $scale, $info['height'] * $scale)) {
            return $this->toolkit->crop($destination, $destination, $x, $y, $width, $height);
        }
        return FALSE;
    }

    /** Scales and crops an image to the desired size keeping the aspect ratio */
    public function scale($source, $destination, $width, $height) {
        $info = self::getInfo($source);

        // Don't scale up.
        if ($width >= $info['width'] && $height >= $info['height']) {
            return FALSE;
        }

        $aspect = $info['height'] / $info['width'];
        if ($aspect < $height / $width) {
            $width = (int)min($width, $info['width']);
            $height = (int)round($width * $aspect);
        }
        else {
            $height = (int)min($height, $info['height']);
            $width = (int)round($height / $aspect);
        }

        return $this->toolkit->resize($source, $destination, $width, $height);
    }

    /** Resizes and crops an image to the exact desired size */
    public function resize($source, $destination, $width, $height) {
        return $this->toolkit->resize($source, $destination, $width, $height);
    }

    /** Rotates the image to the specified angle in degres */
    public function rotate($source, $destination, $degrees, $background = 0x000000) {
        return $this->toolkit->rotate($source, $destination, $degrees, $background);
    }

    /** Crops a part of an image */
    public function crop($source, $destination, $x, $y, $width, $height) {
        return $this->toolkit->crop($source, $destination, $x, $y, $width, $height);
    }

    /** Marks an image with a PNG based watermark image */
    public function watermark($source, $destination, $pngWatermark, $x=0, $y=0) {
       return $this->toolkit->watermark($source, $destination, $pngWatermark, $x, $y);
    }

}
