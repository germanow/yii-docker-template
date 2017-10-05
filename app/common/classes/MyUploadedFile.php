<?php

namespace common\classes;

use Yii;
use yii\web\UploadedFile;

class MyUploadedFile extends UploadedFile
{
    const level = 2;
    public $md5;
    
    
    public function saveAs($file, $deleteTempFile = true)
    {
        $dir = dirname($file);
        if(!is_dir($dir)){
            mkdir($dir, 0777, true);
        }
        return parent::saveAs($file, $deleteTempFile = true);
    }
    
    
    public static function deleteFileByHash(string $hash, string $extension){
        $pathToFile = Yii::getAlias('@uploads') . static::hashToPath($hash) . '.' . $extension;
        return unlink($pathToFile);
    }
    
    public static function hashToPath($hash)
    {
        $path = '/';
        for($i=0, $j=0; $i < static::level; $i+=1, $j+=2){
            $path .= substr($hash, $j, 2) . '/';
        }
        $path .= $hash;
        return $path;
    }
    
    
    public function getFilePathWithSubdir(){
        return Yii::getAlias('@uploads') . static::hashToPath($this->getMD5()) . '.' . $this->getExtension();
    }
    
    public static function getFilePathWithSubdirByHash(string $hash, string $extension){
        return Yii::getAlias('@uploads') . static::hashToPath($hash) . '.' . $extension;
    }
    
    
    public function getMD5(){
        if(!isset($this->md5)){
            $this->md5 = md5_file($this->tempName);
        }
        return $this->md5;
    }
    
    
    public static function hashToUrl(string $hash, string $extension)
    {
        $baseUrl = YII_ENV == 'dev' ? 'http://file' : 'http://' . Yii::$app->params['domainFile'];
        return $baseUrl . static::hashToPath($hash) . '.' . $extension;
    }
}