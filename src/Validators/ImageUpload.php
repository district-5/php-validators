<?php

/**
 * District5 Validators Library
 *
 * @author      District5 <hello@district5.co.uk>
 * @copyright   District5 <hello@district5.co.uk>
 * @link        https://www.district5.co.uk
 *
 * MIT LICENSE
 *
 *  Permission is hereby granted, free of charge, to any person obtaining
 *  a copy of this software and associated documentation files (the
 *  "Software"), to deal in the Software without restriction, including
 *  without limitation the rights to use, copy, modify, merge, publish,
 *  distribute, sublicense, and/or sell copies of the Software, and to
 *  permit persons to whom the Software is furnished to do so, subject to
 *  the following conditions:
 *
 *  The above copyright notice and this permission notice shall be
 *  included in all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *  LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace District5\Validators;

use \District5\Validator\AbstractValidator;

/**
 * Validates whether a value is a string of a certain length
 *
 * @author District5
 * @package District5\Validator
 */
class ImageUpload extends AbstractValidator
{
    /**
     * @var int|null
     */
    protected $_width = null;

    /**
     * @var int|null
     */
    protected $_height = null;

    /**
     * @var string[]
     */
    protected $_extensions = ['jpg', 'JPG', 'gif', 'png'];

    /**
     * @var string[]
     */
    protected $_contentTypes = [];

    /**
     * ImageUpload constructor. Valid options are:
     *  extensions => array of extensions
     *  contentTypes => array of extensions
     *  width => dimension of width
     *  height => dimension of height
     *
     * @param array $options
     */
    public function __construct($options = array())
    {
        if (array_key_exists('extensions', $options) && is_array($options['extensions']))
        {
            $this->_extensions = $options['extensions'];
            unset($options['extensions']);
        }

        if (array_key_exists('width', $options))
        {
            $this->_width = $options['width'];
            unset($options['width']);
        }

        if (array_key_exists('height', $options))
        {
            $this->_height = $options['height'];
            unset($options['height']);
        }

        if (array_key_exists('contentTypes', $options) && is_array($options['contentTypes']))
        {
            $this->_contentTypes = $options['contentTypes'];
            unset($options['contentTypes']);
        }

        parent::__construct($options);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validators\I::isValid()
     */
    public function isValid($value): bool
    {
        $this->_lastErrorMessageKey = 0;
        if ($value === null)
        {
            $this->_errorMessages = ['The file you tried to upload failed.'];
            return false;
        }

        $requiredKeys = ['error', 'name', 'tmp_name', 'size', 'type'];
        foreach ($requiredKeys as $requiredKey)
        {
            if (!array_key_exists($requiredKey, $value))
            {
                $this->_errorMessages = ['The file you tried to upload failed.'];
                return false;
            }
        }

        if ($value['error'] !== UPLOAD_ERR_OK)
        {
            $this->__processErrorCode($value['error']);
            return false;
        }

        if (count($this->_extensions) > 0)
        {
            if ($this->__validateExtensions($value['name']) === false)
            {
                return false;
            }
        }

        if (count($this->_contentTypes) > 0)
        {
            if (!in_array($value['type'], $this->_contentTypes))
            {
                $this->_errorMessages = [
                    sprintf(
                        'The file you upload was an invalid type. Only %s are allowed.',
                        implode(', ', $this->_contentTypes)
                    )
                ];
                return false;
            }
        }

        $fileInfo = @getimagesize($value['tmp_name']);
        if (!$fileInfo)
        {
            $this->_errorMessages = [
                sprintf(
                    'The file you upload was an invalid type. Only %s are allowed.',
                    implode(', ', $this->_contentTypes)
                )
            ];
        }

        if ($this->_width !== null)
        {
            if ((int)$fileInfo[0] !== (int)$this->_width)
            {
                $this->_errorMessages = [
                    sprintf(
                        'The image width must be %spx',
                        $this->_width
                    )
                ];
                return false;
            }
        }

        if ($this->_height !== null)
        {
            if ((int)$fileInfo[1] !== (int)$this->_height)
            {
                $this->_errorMessages = [
                    sprintf(
                        'The image height must be %spx',
                        $this->_height
                    )
                ];
                return false;
            }
        }

        return true;
    }

    /**
     * When the upload error code is not UPLOAD_ERR_OK, assign the necessary error message
     *
     * @param int $errorCode
     */
    private function __processErrorCode($errorCode)
    {
        switch ($errorCode)
        {
            case UPLOAD_ERR_INI_SIZE:
                $this->_errorMessages = ['The file you uploaded was too large'];
                return;
            case UPLOAD_ERR_FORM_SIZE:
                $this->_errorMessages = ['The file you uploaded was too large'];
                return;
            case UPLOAD_ERR_PARTIAL:
                $this->_errorMessages = ['The file you tried to upload failed.'];
                return;
            case UPLOAD_ERR_NO_FILE:
                $this->_errorMessages = ['The file you tried to upload failed.'];
                return;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->_errorMessages = ['An unexpected error occurred while uploading the file.'];
                return;
            case UPLOAD_ERR_CANT_WRITE:
                $this->_errorMessages = ['An unexpected error occurred while uploading the file.'];
                return;
            case UPLOAD_ERR_EXTENSION:
                $this->_errorMessages = ['An unexpected error occurred while uploading the file.'];
                return;
        }

        $this->_errorMessages = ['An unexpected error occurred while uploading the file.'];
        return;
    }

    /**
     * Does the file name match the format expected?
     *
     * @param string $fileName
     *
     * @return bool
     */
    private function __validateExtensions($fileName)
    {
        $foundMatch = false;
        foreach ($this->_extensions as $extension)
        {
            if (strlen($fileName) < strlen('.' . $extension))
            {
                continue;
            }
            if (substr($fileName, -4, strlen('.' . $extension)) === '.' . $extension)
            {
                $foundMatch = true;
                break;
            }
        }

        if ($foundMatch === false)
        {
            if (count($this->_extensions) === 1)
            {
                $this->_errorMessages = [sprintf(
                    'The file you uploaded was invalid. Only %s extension is allowed',
                    $this->_extensions[0]
                )];
            }
            else
            {
                $this->_errorMessages = [sprintf(
                    'The file you uploaded was invalid. Only %s extensions are allowed',
                    implode(', ', $this->_extensions)
                )];
            }

            return false;
        }

        return true;
    }
}
