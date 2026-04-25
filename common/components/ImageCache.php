<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\imagine\Image;

/**
 * Builds thumbnail paths under the public cache tree and generates missing files from the store.
 */
class ImageCache extends Component
{
    /** @var string Filesystem alias or path to originals (relative paths from DB are resolved here). */
    public $storePath = '@webroot/images/store';

    /** @var string Filesystem alias or path where generated thumbnails are written. */
    public $cachePath = '@webroot/images/cache';

    /** @var string URL prefix for cached images (no trailing slash). */
    public $publicBaseUrl = '/images/cache';

    /**
     * Ensures a cached thumbnail exists and returns its public URL and leaf filename.
     *
     * @param string $relativeStorePath Path under the store (e.g. from image.filePath).
     * @param array $options Optional keys: quality (int), filenamePrefix (string), fallbackSource (absolute path if original is missing).
     * @return array{url: string, filename: string}
     */
    public function getThumbnail(string $relativeStorePath, int $width, int $height, array $options = []): array
    {
        $quality = isset($options['quality']) ? (int) $options['quality'] : 90;
        $filenamePrefix = isset($options['filenamePrefix']) ? (string) $options['filenamePrefix'] : '';
        $fallbackSource = isset($options['fallbackSource']) ? (string) $options['fallbackSource'] : null;

        $parsed = $this->splitStorePath($relativeStorePath);
        $leaf = $width . 'x' . $height . '-' . $filenamePrefix . $parsed['basename'];
        $cacheRelative = ($parsed['dir'] !== '' ? $parsed['dir'] . '/' : '') . $leaf;
        $fullCache = Yii::getAlias($this->cachePath) . '/' . $cacheRelative;

        if (!is_file($fullCache)) {
            $primary = Yii::getAlias($this->storePath) . '/' . ltrim(str_replace('\\', '/', $relativeStorePath), '/');
            $source = is_file($primary) ? $primary : $fallbackSource;
            if ($source !== null && $source !== '' && is_file($source)) {
                FileHelper::createDirectory(dirname($fullCache));
                try {
                    Image::thumbnail($source, $width, $height)->save($fullCache, ['quality' => $quality]);
                } catch (\Throwable $e) {
                    Yii::warning($e->getMessage(), __METHOD__);
                }
            }
        }

        return [
            'url' => rtrim($this->publicBaseUrl, '/') . '/' . $cacheRelative,
            'filename' => $leaf,
        ];
    }

    /**
     * @see getThumbnail()
     */
    public function getThumbnailUrl(string $relativeStorePath, int $width, int $height, array $options = []): string
    {
        return $this->getThumbnail($relativeStorePath, $width, $height, $options)['url'];
    }

    /**
     * @return array{dir: string, basename: string}
     */
    private function splitStorePath(string $relativeStorePath): array
    {
        $normalized = str_replace('\\', '/', $relativeStorePath);
        $parts = explode('/', $normalized);
        $basename = (string) array_pop($parts);
        $dir = implode('/', $parts);

        return ['dir' => $dir, 'basename' => $basename];
    }
}
