<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Upload form
 */
class UploadForm extends Model
{

     /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }
}
